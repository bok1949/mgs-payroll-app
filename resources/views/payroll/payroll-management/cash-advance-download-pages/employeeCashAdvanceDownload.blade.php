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
            <div class="col border border-1">
                <h5 class="border-bottom text-center org-name">MGSAMIDAN CONSTRUCTION AND DEVELOPMENT CORPORATION</h5>
                <p class="text-center fw-bold">Cash Advance Form</p>
                <p class="text-center">Office Copy</p>
                <div class="border-top py-2 px-4">
                    <p><strong>Date today:</strong> <span class="border-bottom">{{ Carbon\Carbon::now()->format('F j,
                            Y') }}</span></p>
                    <p><strong>Date requested:</strong> <span class="border-bottom">{{ $cashAdvances &&
                            $cashAdvances->cash_advanced_date ?
                            Carbon\Carbon::parse($cashAdvances->cash_advanced_date)->format('F j, Y') : '' }}</span></p>
                    <p><strong>Name:</strong> <span class="border-bottom">{{$fullName}}</span></p>
                    <p><strong>Amount of Cash Advance:</strong> <span class="border-bottom"> {{ $cashAdvances &&
                            $cashAdvances->amount ? number_format($cashAdvances->amount, 2) : '' }} Php</span></p>
                    <p><strong>Purpose of Cash Advance:</strong> <span class="border-bottom">{{ $cashAdvances &&
                            $cashAdvances->purpose ? $cashAdvances->purpose : ''}}</span></p>
                </div>
                <table class="table">
                    <tr>
                        <td>
                            <p class="mb-4 pb-4 px-4">Approved by:</p>
                            <p class=""></p>
                        </td>
                        <td>
                            <p class="mb-4 pb-4 text-end px-5">Received by:</p>
                            <p class="text-end">Signature over printed name</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col border border-1">
                <h5 class="border-bottom text-center org-name">MGSAMIDAN CONSTRUCTION AND DEVELOPMENT CORPORATION</h5>
                <p class="text-center fw-bold">Cash Advance Form</p>
                <p class="text-center">Employees' copy</p>
                <div class="border-top py-2 px-4">
                    <p><strong>Date today:</strong> <span class="border-bottom">{{ Carbon\Carbon::now()->format('F j,
                            Y') }}</span></p>
                    <p><strong>Date requested:</strong> <span class="border-bottom">{{ $cashAdvances &&
                            $cashAdvances->cash_advanced_date ?
                            Carbon\Carbon::parse($cashAdvances->cash_advanced_date)->format('F j, Y') : '' }}</span></p>
                    <p><strong>Name:</strong> <span class="border-bottom">{{$fullName}}</span></p>
                    <p><strong>Amount of Cash Advance:</strong> <span class="border-bottom"> {{ $cashAdvances &&
                            $cashAdvances->amount ? number_format($cashAdvances->amount, 2) : '' }} Php</span></p>
                    <p><strong>Purpose of Cash Advance:</strong> <span class="border-bottom">{{ $cashAdvances &&
                            $cashAdvances->purpose ? $cashAdvances->purpose : ''}}</span></p>
                </div>
                <table class="table">
                    <tr>
                        <td>
                            <p class="mb-4 pb-4 px-4">Approved by:</p>
                            <p class=""></p>
                        </td>
                        <td>
                            <p class="mb-4 pb-4 text-end px-5">Received by:</p>
                            <p class="text-end">Signature over printed name</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>