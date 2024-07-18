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
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="input-group">
                        <select class="choices form-select" wire:model="workingSite">
                            <option value="0">Filter by site...</option>
                            @foreach ($sites as $site)
                            <option value="{{$site->id}}">{{ $site->site_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <a href="#" wire:click.prevent="clearFilter">Clear all</a>
                </div>
            </div>
    
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
    
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $index => $employee)
                        <tr wire:key="emp-field-{{ $employee->id }}">
                            <th scope="row">{{ $counter }}</th>
                            <td class="col-auto">
                                <div class="d-flex align-items-center">
                                    <p class="font-bold ms-3 mb-0">
                                        {{ Str::ucfirst(Str::lower($employee->last_name)) }},
                                        {{ Str::ucfirst(Str::lower($employee->first_name )) }}
                                    </p>
                                </div>
                            </td>
                            <td class="col-auto">
                                {{$employee->total_amount ?? '0.00'}}
                            </td>
                            <td class="col-auto">
                                <div style="vertical-align: middle;">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Add cash advance">
                                        <a 
                                            href="#"
                                            wire:click.stop="modalToAddEmployeeCashAdvance({{$employee->id}}, '{{$employee->first_name}}', '{{$employee->last_name}}')"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#addCashAdvanced"
                                        >
                                            <i class="bi bi-plus-circle"></i>
                                        </a>
                                    </span> 
                                    &nbsp; |
                                    &nbsp;
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="View cash advances">
                                        <a href="{{route('view.cash.advances.index', ['employeeUuid' => $employee->employee_uuid])}}">
                                            <i class="bi bi-eye"></i> 
                                        </a>
                                    </span>
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
                    &nbsp;to&nbsp; <strong>{{ $to }}</strong>
                    &nbsp;of&nbsp; <strong>{{ $total }}</strong>&nbsp; entries
                </div>
                <div class="col d-flex justify-content-end">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>

    @livewire('payroll.payroll-management.modal-add-employee-cash-advance')


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
