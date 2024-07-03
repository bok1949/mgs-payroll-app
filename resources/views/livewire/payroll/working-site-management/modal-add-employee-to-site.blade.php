<div>
    <div 
        wire:ignore.self 
        class="modal fade" 
        id="addEmployeeToSite" 
        tabindex="-1" 
        aria-labelledby="addEmployeeToSite"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header alert-info">
                    <h5 class="modal-title" id="addEmployeeToSite">
                        Add employee to {{$siteNameModalTitle}}
                    </h5>
                    <button type="button" wire:click="cancelAddingEmployeeToSite" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div 
                        class="text-center"
                        wire:loading.delay.longest
                        wire:target="saveEmployeesToSite({{$workingSiteId}})"
                    >
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-center">Updating {{$siteNameModalTitle}}...</p>
                    </div>
                    
                    @session('error-adding-employee-to-site')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger d-flex  justify-content-between" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <p class="text-center">
                                        {{ session('error-adding-employee-to-site') }}
                                    </p>
                                    <i role="button" data-bs-dismiss="alert" class="bi bi-x"></i>
                                </div>
                            </div>
                        </div>
                    @endsession
                    
                    @session('success')
                        <div class="row">
                            <div class="alert alert-success d-flex  justify-content-between" role="alert">
                                <i class="bi bi-check-circle-fill"></i>
                                <div class="text-center">
                                    {{ session('success') }}
                                </div>
                                <i role="button" data-bs-dismiss="alert" class="bi bi-x"></i>
                            </div>
                        </div>
                    @endsession

                    <div class="row">
                        <div class="col-md-4">
                            <label>
                                Search employee:
                            </label>
                        </div>
                        <div class="col-md-8">

                            <div class="form-group has-icon-left mb-0">
                                <div class="position-relative">
                                    <input 
                                        type="text" 
                                        class="form-control"
                                        placeholder="Search employees..." 
                                        autocomplete="off"
                                        wire:model.debounce.3000="searchQueryString" 
                                        wire:keydown.escape="cancelAddingEmployeeToSite"
                                    >
                                    <div class="form-control-icon">
                                        <i class="bi bi-search"></i>
                                    </div>
                                </div>
                            </div>

                            @if ($searchQueryString)
                                <ul class="list-unstyled border-start border-end border-bottom with-scrollbar mt-0">
                                    @if (count($employees) > 0)
                                        @foreach ($employees as $employee)
                                            <li 
                                                class="px-3 py-2 list-item" 
                                                role="button"
                                                wire:click.stop="selectedEmployeesFromList(
                                                    {{$employee->id}},
                                                    '{{$employee->last_name}}', 
                                                    '{{$employee->first_name}}'
                                                    )">
                                                {{$employee->last_name}}, {{$employee->first_name}} 
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="px-3 py-2">No reslut!</li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div> {{-- end of search employees --}}

                    {{-- show list of selected employees --}}
                    @if (count($selectedEmployees) > 0)
                        <div class="row my-4">
                            <div class="col-md-12">
                                <ul class="list-group">
                                    <li class="list-group-item active" aria-current="true">
                                        List of employees to be added
                                    </li>
                                    @foreach ($selectedEmployees as $key=>$selectedEmployee)
                                    <li class="list-group-item">
                                        {{$selectedEmployee}}
                                        <span role="button" wire:click.stop="removeFromSelection({{$key}})" class="float-end">
                                            <i class="bi bi-trash"></i>
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @else
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="alert alert-warning text-center" role="alert">
                                    No employees to be added to this site!
                                </div>
                            </div>
                        </div>
                    @endif {{-- end of show selected employees --}}

                </div> {{-- end of modal body --}}

                <div class="modal-footer">
                    <button 
                        type="button" 
                        wire:click="cancelAddingEmployeeToSite" 
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                    @if (count($selectedEmployees) > 0)
                        <button 
                            type="button" 
                            wire:click="saveSelectedEmployeesToWorkingSite"
                            class="btn btn-primary"
                        >
                            Save selection
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
