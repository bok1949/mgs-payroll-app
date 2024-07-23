<div>
    <div class="card">
        <div class="card-header">
            <h6 class="text-end">{{\Carbon\Carbon::now()->toFormattedDateString()}}</h6>
        </div>
        <div class="card-body">    
            
            <div class="row mb-3">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <span class="fw-bold align-middle">Filter by date:</span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <input 
                        type="date" 
                        wire:model.defer="filterDateFrom" 
                        class="form-control @error('filterDateFrom') is-invalid @enderror">
                        @error ('filterDateFrom')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <input 
                        type="date" 
                        wire:model.defer="filterDateTo" 
                        class="form-control @error('filterDateTo') is-invalid @enderror">
                        @error ('filterDateTo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <button type="submit" wire:click="filterCashAdvanceByDate" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <a href="#" wire:click.prevent="clearFilter" class="btn btn-success">Clear filter</a>
                </div>
            </div>
            
            <h5 class="card-title text-center my-2 border-top border-bottom">
                {{$fullName ?? ''}} Cash Advances
            </h5>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info text-center col-md-12" wire:loading wire:target="downloadEmployeeCashAdvance">
                        Processing Download...
                    </div>

                    <div class="table-responsive" wire:loading.remove>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Purpose</th>
                                    <th>Date assigned</th>
                                    <th>Date created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employeeCashAdvances as $index => $employeeCashAdvance)
                                    <tr wire:key="emp-field-{{ $employeeCashAdvance->id }}">
                                        <th scope="row">{{ $counter }}</th>
                                        <td class="col-auto">{{$employeeCashAdvance->amount}}</td>
                                        <td class="col-auto">{{$employeeCashAdvance->purpose}}</td>
                                        <td class="col-auto">
                                            {{
                                                \Carbon\Carbon::parse($employeeCashAdvance->cash_advanced_date)->toFormattedDateString()
                                            }}
                                        </td>
                                        <td class="col-auto">
                                            {{
                                                \Carbon\Carbon::parse($employeeCashAdvance->created_at)->toFormattedDateString()
                                            }}
                                        </td>
                                        <td class="col-auto">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Download cash advance">
                                                <a 
                                                    href="#"
                                                    wire:click.stop="downloadEmployeeCashAdvance({{$employeeCashAdvance->id}})"
                                                >
                                                    <i class="bi bi-box-arrow-down"></i>
                                                </a>
                                            </span>
                                             | 
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Edit cash advance">
                                                <a 
                                                    href="#"
                                                    wire:click.stop="modalToEditEmployeeCashAdvance({{$employeeCashAdvance->id}})"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editEmployeeCashAdvance"
                                                >
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                    @php
                                        $counter++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    
            <div class="row my-3" wire:loading.remove>
                <div class="col d-flex justify-content-start align-items-center">
                    Showing &nbsp;<strong>{{ $from }}</strong>
                    &nbsp;to&nbsp; <strong>{{ $to }}</strong>
                    &nbsp;of&nbsp; <strong>{{ $total }}</strong>&nbsp; entries
                </div>
                <div class="col d-flex justify-content-end">
                    {{ $employeeCashAdvances->links() }}
                </div>
            </div>
        </div>
    </div>
    @livewire('payroll.payroll-management.modal-edit-employee-cash-advance')
</div>
