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
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="input-group">
                        <select class="choices form-select" wire:model="workingSiteFilter">
                            <option value="0">Filter by site...</option>
                            @foreach ($sites as $site)
                            <option value="{{$site->id}}">{{ $site->site_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <input type="month" class="form-control" wire:model="monthFilter" id="">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <a href="#" wire:click.prevent="clearFilter">Clear all</a>
                </div>
            </div>
    
            @if ($monthFilter)
            <div class="row my-1">
                <div class="col">
                    {{-- <a href="{{ route('download.payslip', ['monthFilter' => $monthFilter]) }}" class="btn btn-info float-end mx-4"> --}}
                    <a href="" class="btn btn-info float-end mx-4 text-white">
                        Download all employees salary for 
                        {{\Carbon\Carbon::create($monthFilter)->format('F')}}
                    </a>
                    {{-- <label for="" class="float-end">Generate a summary of employee payslips</label> --}}
                </div>
            </div>
            @endif

            <div class="row mb-1">
                <div class="col-lg-12 col-md-12 col-sm-12">
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
            <div class="row my-2">
                <div class="col text-center">
                    <h4>
                        {{$workingSiteName}}
                    </h4>
                </div>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Days</th>
                            <th>Accumulated OT</th>
                            <th>Gross</th>
                            <th>Cash Advance</th>
                            <th>Net</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $index => $employee)
                        <tr wire:key="emp-field-{{ $employee->employee_id }}">
                            <th scope="row">{{ $counter }}</th>
                            <td class="col-auto">
                                <div class="d-flex align-items-center">
                                    <p class="font-bold ms-3 mb-0">
                                        @php
                                            $fullName = Str::ucfirst(Str::lower($employee->last_name)) . ', ' .
                                            Str::ucfirst(Str::lower($employee->first_name))
                                        @endphp
                                        {{$fullName}}
                                    </p>
                                </div>
                            </td>
                            <td class="col-auto">
                                {{$employee->sumOfDaysPresent ?? '0.00'}}
                            </td>
                            <td class="col-auto">
                                {{$employee->sumOfOverTime ?? '0.00'}}
                            </td>
                            <td class="col-auto">
                                {{number_format($employeeGrossSalary[$employee->employee_id], 2)}}
                            </td>
                            <td class="col-auto">
                                {{number_format($employee->cashAdvanceSum, 2) ?? '0.00'}}
                            </td>
                            <td class="col-auto">
                                {{number_format($employeeNetSalary[$employee->employee_id], 2)}}
                            </td>
                            <td class="col-auto">
                                <a 
                                    href="#" 
                                    class="dropdown-item" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Download payslip"
                                    wire:click.stop="downloadEmployeePayroll()">
                                    <i class="bi bi-download point"></i>
                                </a>
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
                    &nbsp;to&nbsp; <strong>{{ $to }}</strong>
                    &nbsp;of&nbsp; <strong>{{ $total }}</strong>&nbsp; entries
                </div>
                <div class="col d-flex justify-content-end">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
    
    {{-- @livewire('payroll.payroll-management.modal-to-edit-pay-slip') --}}
    
    <script>
        window.addEventListener('success-message', event => {
            window.setTimeout(function() {
                $(".alert-success").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove();
                });
            }, 5000);
        });
        
        window.addEventListener('db-error', event => {
            alert(event.detail.errormessage);
        });
    
    </script>
</div>
