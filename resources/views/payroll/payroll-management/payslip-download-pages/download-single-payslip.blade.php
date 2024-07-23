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
    <div class="container-fluid printing-page">
        <div class="row" style="margin: auto;">
            <div class="col">
                <h5 class="border-bottom text-center ">MGSAMIDAN CONSTRUCTION AND DEVELOPMENT CORPORATION</h5>
                <p class="text-center fw-bold">
                    EMPLOYEE PAYSLIP for {{ $monthFilter }}
                    <span class="text-secondary"> || <i>Office Copy</i> </span>
                </p>
                <div class="border-top p-0 m-0 text-start">
                    <p><strong>Date Generated:</strong> <span class="border-bottom">{{ Carbon\Carbon::now()->format('F j, Y') }}</span></p>
                </div>
                <div class="container-fluid m-0 p-0 col col-12 w-100">
                    <table class="table table-bordered col col-12 w-100 payslip-print-data">
                        <tr class="border border-dark">
                            <td class="fw-bold">Employee Name:</td>
                            <td class="border border-dark">{{ Str::title($emp_name) }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Site Location:</td>
                            <td class="border border-dark">{{ $emp_site }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Job Title:</td>
                            <td class="border border-dark">{{ $emp_job_title }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Rate:</td>
                            <td class="border border-dark">{{ $emp_rate }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Days number of days:</td>
                            <td class="border border-dark">{{ $emp_days }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Total Overtime:</td>
                            <td class="border border-dark">{{ $emp_total_ot }} hrs</td>
                        </tr class="border border-dark">
                        <tr class="border border-dark">
                            <td class="fw-bold">Gross Total:</td>
                            <td class="border border-dark">{{ $emp_gross_total }} Php.</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Deductions:</td>
                            <td class="border border-dark">{{ $emp_deductions }} Php.</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Net Total:</td>
                            <td class="border border-dark">{{ $emp_final_pay }} Php.</td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td colspan="">
                                    <p class="px-3">Approved by:</p>
                                <td colspan="">
                                    <p class="text-center pe-5">Received by:</p>
                                    <p class="text-end pe-3">Signature over printed name</p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <hr class="copy-divider">
    <div class="container-fluid">
        <div class="row" style="margin: auto;">
            <div class="col">
                <h5 class="border-bottom text-center ">MGSAMIDAN CONSTRUCTION AND DEVELOPMENT CORPORATION</h5>
                <p class="text-center fw-bold">
                    EMPLOYEE PAYSLIP for {{ $monthFilter }}
                    <span class="text-secondary"> || <i>Personal Copy</i> </span>
                </p>
                <div class="border-top p-0 m-0 text-start">
                    <p><strong>Date Generated:</strong> <span class="border-bottom">{{ Carbon\Carbon::now()->format('F j, Y') }}</span></p>
                </div>
                <div class=" container-fluid m-0 p-0 col col-12 w-100">
                    <table class="table table-bordered col col-12 w-100 payslip-print-data">
                        <tr class="border border-dark">
                            <td class="fw-bold">Employee Name:</td>
                            <td class="border border-dark">{{ $emp_name }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Site Location:</td>
                            <td class="border border-dark">{{ $emp_site }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Job Title:</td>
                            <td class="border border-dark">{{ $emp_job_title }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Rate:</td>
                            <td class="border border-dark">{{ $emp_rate }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Days number of days:</td>
                            <td class="border border-dark">{{ $emp_days }}</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Total Overtime:</td>
                            <td class="border border-dark">{{ $emp_total_ot }} hrs</td>
                        </tr class="border border-dark">
                        <tr class="border border-dark">
                            <td class="fw-bold">Gross Total:</td>
                            <td class="border border-dark">{{ $emp_gross_total }} Php.</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Deductions:</td>
                            <td class="border border-dark">{{ $emp_deductions }} Php.</td>
                        </tr>
                        <tr class="border border-dark">
                            <td class="fw-bold">Net Total:</td>
                            <td class="border border-dark">{{ $emp_final_pay }} Php.</td>
                        </tr>
                    </table>

                </div>

                {{-- Table start --}}
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="">
                                <p class="px-3">Approved by:</p>
                            <td colspan="">
                                <p class="text-center pe-5">Received by:</p>
                                <p class="text-end pe-3">Signature over printed name</p>
                            </td>
                        </tr>

                    </tbody>
                </table>


                {{--
            </div> --}}
        </div>
    </div>

    </div>
</body>

</html>