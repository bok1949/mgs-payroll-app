<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                <img class="logo-in-pdf" src="{{ public_path('assets/images/svg/mgs-logo-2.svg') }}" alt="Logo" srcset="">
                <h5 class="text-center">
                    <span>MG-SAMIDAN CONSTRUCTION AND DEVELOPMENT CORPORATION</span>
                </h5>
                <p class="text-center fw-bold mb-0">Cash Advance Form</p>
                <p class="text-center text-secondary my-0">Office Copy</p>
                <div class="border-top py-2 px-4">
                    <p class="text-end">
                        <strong>Date generated:</strong> 
                        <span class="border-bottom text-secondary">{{ Carbon\Carbon::now()->format('F j, Y') }}</span>
                    </p>
                    <p>
                        <strong>Name:</strong> 
                        <span class="border-bottom text-secondary">{{$fullName}}</span>
                    </p>
                    <p>
                        <strong>Date requested:</strong> 
                        <span class="border-bottom text-secondary">
                            {{ $cashAdvances && $cashAdvances->cash_advanced_date 
                                ? Carbon\Carbon::parse($cashAdvances->cash_advanced_date)->format('F j, Y') 
                                : '' }}
                        </span>
                    </p>
                    <p>
                        <strong>Amount of Cash Advance:</strong> 
                        <span class="border-bottom text-secondary">
                            {{ $cashAdvances && $cashAdvances->amount 
                                ? number_format($cashAdvances->amount, 2) 
                                : '' }} Php.
                        </span>
                    </p>
                    <p>
                        <strong>Purpose of Cash Advance:</strong> 
                        <span class="border-bottom text-secondary">
                            {{ $cashAdvances && $cashAdvances->purpose ? $cashAdvances->purpose : ''}}
                        </span>
                    </p>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><p class="px-3">Approved by:</p></td>
                            <td>
                                <p class="text-center pe-5">Received by:</p>
                                <p class="text-end pe-3">Signature over printed name</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr class="copy-divider">

        <div class="row" style="margin: auto;">
            <div class="col">
                <img class="logo-in-pdf" src="{{ public_path('assets/images/svg/mgs-logo-2.svg') }}" alt="Logo" srcset="">
                <h5 class="text-center">
                    <span>MG-SAMIDAN CONSTRUCTION AND DEVELOPMENT CORPORATION</span>
                </h5>
                <p class="text-center fw-bold mb-0">Cash Advance Form</p>
                <p class="text-center text-secondary my-0">Office Copy</p>
                <div class="border-top py-2 px-4">
                    <p class="text-end">
                        <strong>Date generated:</strong>
                        <span class="border-bottom text-secondary">{{ Carbon\Carbon::now()->format('F j, Y') }}</span>
                    </p>
                    <p>
                        <strong>Name:</strong>
                        <span class="border-bottom text-secondary">{{$fullName}}</span>
                    </p>
                    <p>
                        <strong>Date requested:</strong>
                        <span class="border-bottom text-secondary">
                            {{ $cashAdvances && $cashAdvances->cash_advanced_date
                            ? Carbon\Carbon::parse($cashAdvances->cash_advanced_date)->format('F j, Y')
                            : '' }}
                        </span>
                    </p>
                    <p>
                        <strong>Amount of Cash Advance:</strong>
                        <span class="border-bottom text-secondary">
                            {{ $cashAdvances && $cashAdvances->amount
                            ? number_format($cashAdvances->amount, 2)
                            : '' }} Php.
                        </span>
                    </p>
                    <p>
                        <strong>Purpose of Cash Advance:</strong>
                        <span class="border-bottom text-secondary">
                            {{ $cashAdvances && $cashAdvances->purpose ? $cashAdvances->purpose : ''}}
                        </span>
                    </p>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <p class="px-3">Approved by:</p>
                            </td>
                            <td>
                                <p class="text-center pe-5">Received by:</p>
                                <p class="text-end pe-3">Signature over printed name</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>