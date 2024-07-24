<div>
    <div class="card">
        <div class="card-header">
            <h6 class="text-end">{{\Carbon\Carbon::now()->toFormattedDateString()}}</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3 align-items-center">
                <div class="col-lg-1 col-md-1 col-sm-1 text-end">
                    <strong>Filter</strong>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="input-group">
                        <input type="month" class="form-control" wire:model="filterByMonth"
                            value="{{$filterByMonth ?? ''}}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="form-group has-icon-left">
                        <div class="position-relative">
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="Site name..." 
                                wire:model.lazy="searchString">
                            <div class="form-control-icon">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <a href="#" wire:click.prevent="clearFilter()">Clear all</a>
                </div>
            </div>
            @php
                $sumOfTotalSalaryPerSite = 0;
                $data = [];
            @endphp
            @if ($filterByMonth)
                <div class="row my-2">
                    <div class="col">
                        <h5 class="border-bottom text-center">
                            {{$filterByMonthFormatted ?? ''}}
                        </h5>
                        <span class="float-end" wire:loading.remove>
                            <a 
                                href="#" 
                                wire:click="downLoadSummary" 
                                class="btn btn-primary"
                            >
                                Download Site Salary Expenses
                            </a>
                        </span>
                    </div>
                    <div class="alert alert-info text-center" wire:loading wire:target="downLoadSummary">
                        Processing Download...
                    </div>
                </div>
            @endif
    
            {{-- data table holder --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Site name</th>
                                    <th>Total salary expenses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = $sites->total();
                                    $currentPage = $sites->currentPage();
                                    $perPage = $sites->perPage();
                                    
                                    $from = ($currentPage - 1) * $perPage + 1;
                                    $to = min($currentPage * $perPage, $total);
                                    
                                    $counter = $from;
                                @endphp
                                @foreach ($sites as $index => $site)
                                    <tr wire:key={{$index}}>
                                        <th scope="row">{{ $counter }}</th>
                                        <td class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold ms-3 mb-0">
                                                    {{$site->site_name}}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                                
                                            @foreach ($totalSalaries as $siteId => $totalSalary)
                                                @if ($siteId === $site->id) 
                                                    @php $sumOfTotalSalaryPerSite += $totalSalary; @endphp
                                                    {{number_format($totalSalary, 2)}}
                                                @endif
                                            @endforeach
                                            
                                        </td>
                                    </tr>
                                    @php
                                        $counter++;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot class="table-success">
                                <tr>
                                    <th scope="row" >Sum of all sites salaries</th>
                                    <td colspan="2">{{number_format($sumOfTotalSalaryPerSite, 2)}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div> {{-- end of data table holder --}}
    
            <div class="row my-3">
                <div class="col d-flex justify-content-start align-items-center">
                    Showing &nbsp;<strong>{{ $from }}</strong>
                    &nbsp; to &nbsp; <strong>{{ $to }}</strong>
                    &nbsp; of &nbsp; <strong>{{ $total }}</strong>&nbsp; entries
                </div>
                <div class="col d-flex justify-content-end">
                    {{ $sites->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
