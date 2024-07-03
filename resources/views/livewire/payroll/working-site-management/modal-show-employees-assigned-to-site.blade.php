<div>
    <div 
        wire:ignore.self 
        class="modal fade" 
        id="showEmployeesAssignedToSite" 
        tabindex="-1" 
        aria-labelledby="showEmployeesAssignedToSite"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header alert-info">
                    <h5 class="modal-title" id="showEmployeesAssignedToSite">
                        Assigned employees in {{$siteNameModalTitle}}
                    </h5>
                    <button type="button" wire:click="cancelShowEmployeesInSite" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        placeholder="Employee last name..." 
                                        wire:model.debounce.3000="searchString">
                                    <div class="form-control-icon">
                                        <i class="bi bi-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> {{-- end of search input --}}

                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-items-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Job title</th>
                                            <th>Daily Rate</th>
                                            <th data-bs-toggle="tooltip" title="Unassign employee">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = $siteEmployees->total();
                                            $currentPage = $siteEmployees->currentPage();
                                            $perPage = $siteEmployees->perPage();
                                            
                                            $from = ($currentPage - 1) * $perPage + 1;
                                            $to = min($currentPage * $perPage, $total);
                                            
                                            $counter = $from;
                                        @endphp
                                        @foreach ($siteEmployees as $employee)
                                            <tr>
                                                <td class="col-auto">
                                                    {{ $counter }}
                                                </td>
                                                <td class="col-auto">
                                                    <div class="d-flex align-items-center">
                                                        @php
                                                            $fullName = ucwords(strtolower($employee->lastname . ', ' . $employee->firstname));
                                                        @endphp
                                                        {{ $fullName }}
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <div 
                                                        wire:click.stop="showEditableInputJobTitle({{$employee->employee_information_id}}, 'jobTitle')"
                                                        role="button" class="d-flex align-items-center">
                                                        @if (
                                                            !empty($jobTitleColumn) && 
                                                            $jobTitleColumn === $jobTitleColumnConstant && 
                                                            $employee->employee_information_id === $employeeId
                                                        )
                                                            <input 
                                                                type="text" 
                                                                wire:keydown.escape="cancelCellEditing"
                                                                wire:keydown.enter="saveJobTitle($event.target.value)"
                                                                value="{{$employee->job_title ?? ''}}" 
                                                                class="form-control" 
                                                            />
                                                        @else
                                                            {{$employee->job_title ?? '-'}}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <div 
                                                        wire:click.stop="showEditableInputJobTitleRate({{$employee->employee_information_id}}, 'jobTitleRate')"
                                                        role="button"
                                                    >
                                                        @if (
                                                            !empty($jobTitleRateColumn) &&
                                                            $jobTitleRateColumn === $jobTitleRateColumnConstant &&
                                                            $employee->employee_information_id === $employeeId
                                                        )
                                                            <input 
                                                                type="text" 
                                                                wire:keydown.escape="cancelCellEditing"
                                                                wire:keydown.enter="saveJobTitleRate($event.target.value)"
                                                                value="{{$employee->job_title_rate ?? ''}}" 
                                                                class="form-control" 
                                                            />
                                                        @else
                                                            {{ $employee->job_title_rate ?? '-' }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <div class="d-flex align-items-center">
                                                        {{-- unassigned employee --}}
                                                        <a href="#"
                                                            wire:click.prevent="confirmDeletion({{$employee->employee_information_id}}, '{{$employee->working_site_id}}', '{{$fullName}}')"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDelete">
                                                            <span data-bs-toggle="tooltip" title="Delete">
                                                                <i class="bi bi-trash"></i>
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
                        </div>
                    </div> {{-- end of list of employees --}}

                    <div class="row my-3">
                        <div class="col d-flex justify-content-start align-items-center">
                            Showing &nbsp;<strong>{{ $from }}</strong>
                            &nbsp;to&nbsp; <strong>{{ $to }}</strong>
                            &nbsp;of&nbsp; <strong>{{ $total }}</strong>&nbsp; entries
                        </div>
                        <div class="col d-flex justify-content-end">
                            {{ $siteEmployees->links() }}
                        </div>
                    </div>

                </div> {{-- end of modal body --}}
    
                <div class="modal-footer">
                    <button 
                        type="button" 
                        wire:click="cancelShowEmployeesInSite" 
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
