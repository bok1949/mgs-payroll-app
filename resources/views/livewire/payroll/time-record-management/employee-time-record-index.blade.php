<div>
    <div class="card">
        <div class="card-header">
            <h6 class="text-end">{{\Carbon\Carbon::now()->toFormattedDateString()}}</h6>
    
        </div>
        <div class="card-body">
            <div class="row mb-3 align-items-center">
                <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                    <strong>Filter</strong>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="input-group">
                        <select class="choices form-select" wire:model="workingSiteFilter">
                            <option value="0">Filter by site...</option>
                            @foreach ($sites as $site)
                            <option value="{{$site->id}}">{{ $site->site_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="input-group">
                        <input type="month" wire:model="monthFilter" class="form-control">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <a href="#" wire:click.prevent="clearFilter()">Clear all</a>
                </div>
            </div>
    
            <div class="row mb-1">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="form-group has-icon-left">
                        <div class="position-relative">
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="Employee name..." 
                                wire:model.lazy="searchString">
                            <div class="form-control-icon">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($workingSiteName)
            <div class="row mb-2 my-3">
                <div class="col">
                    <h5 class="text-center border-bottom">
                        {{$workingSiteName}} Working site
                    </h5>
                </div>
            </div>
            @endif
    
            <div class="table-responsive ">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Total days</th>
                            <th>Total OT</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = $employees->total();
                            $currentPage = $employees->currentPage();
                            $perPage = $employees->perPage();
                            
                            $from = ($currentPage - 1) * $perPage + 1;
                            $to = min($currentPage * $perPage, $total);
                            
                            $counter = $from;
                        @endphp
                        @foreach ($employees as $index => $employee)
                            <tr wire:key="emp-field-{{$employee->id}}">
                                <th scope="row" class="col-auto">{{$counter}}</th>
                                <td class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <p class="font-bold ms-3 mb-0">
                                            {{ Str::ucfirst(Str::lower($employee->last_name)) }},
                                            {{ Str::ucfirst(Str::lower($employee->first_name )) }}
                                        </p>
                                    </div>
                                </td>
                                <td class="col-auto">
                                    @php
                                        $monthStart = $filterFrom ?? Carbon\Carbon::now()->startOfMonth();
                                        $monthEnd = $filterTo ?? Carbon\Carbon::now()->startOfMonth();
                                        $employeeTimeRecord = $employee->daysPresent()
                                            ->whereBetween('attendance_from', [
                                                $monthStart,
                                                $monthEnd
                                            ]);
                                        
                                    @endphp
                                    {{$employeeTimeRecord->sum('days_present')}}
                                </td>
                                <td class="col-auto">
                                    {{$employeeTimeRecord->sum('total_ot')}}
                                </td>
                                <td class="col-auto">
                                    {{$filterFrom ?? Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')}}
                                </td>
                                <td>
                                    {{$filterTo ?? Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')}}
                                </td>
                                <td class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <a 
                                            href="#" 
                                            wire:click.prevent="showInputEmployeeAttendance({{$employee->id}})"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#inputDtr"
                                        >
                                            <span data-bs-toggle="tooltip" title="Input/Edit DTR">
                                                <i class="bi bi-pencil-square"></i>
                                            </span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            <div class="row my-3">
                <div class="col d-flex justify-content-start align-items-center">
                    Showing &nbsp;<strong>{{ $from }}</strong>
                    &nbsp; to &nbsp; <strong>{{ $to }}</strong>
                    &nbsp; of &nbsp; <strong>{{ $total }}</strong>&nbsp; entries
                </div>
                <div class="col d-flex justify-content-end">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
    @livewire('payroll.time-record-management.modal-employee-input-time')
</div>
