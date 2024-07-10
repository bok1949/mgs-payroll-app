<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('assets/css/pdfDownload.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="margin: auto;">
    <div class="container-fluid">
        <div class="row" style="margin: auto;">
            <div class="col">
                <div>
                    <h5 class="text-center org-name">MGSAMIDAN CONSTRUCTION AND DEVELOPMENT CORPORATION</h5>
                    <p class="text-center fw-bold">Salary Expenses Report</p>
                </div>
                <div class="border-top py-2 px-4">
                    <p>
                        <strong>Date generated:</strong> 
                        <span class="border-bottom">{{ Carbon\Carbon::now()->format('F j, Y') }}</span>
                    </p>
                    <p>
                        <strong>Sites salary expenses on:</strong> 
                        <span class="border-bottom">
                            {{ $date_filtered ? Carbon\Carbon::create($date_filtered)->format('F, Y') : '' }}
                        </span>
                    </p>
                    
                </div>
                <div class="table-responsive" style="width: 80%; margin: auto;">
                    <table class="table">
                        <thead class="border-bottom">
                            <tr>
                                <th>#</th>
                                <th>Site name</th>
                                <th>Total salary expenses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sumOfTotalSalaryPerSite = 0;
                                $totalData = count($data);
                                $counter = $totalData - $totalData + 1;
                            @endphp
                            @foreach ($data as $key => $item)
                            <tr class="border-bottom">
                                <td class="col-auto" @style(['width: 12px;'])>{{$counter}}</td>
                                <td class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <p class="font-bold ms-3 mb-0">
                                            {{$item['site_name']}}
                                        </p>
                                    </div>
                                </td>
                                <td class="col-auto">
                                    {{ number_format($item['salary_expenses'], 2) }}
                                    @php
                                        $sumOfTotalSalaryPerSite += $item['salary_expenses'];
                                    @endphp
                                </td>
                            </tr>
                                @php
                                    $counter++;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="row" colspan="2">Sum of all sites salaries</th>
                                <td>{{$total_salaries ? number_format($total_salaries, 2) : '0.00'}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>