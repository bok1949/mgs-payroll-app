<div>
    <div 
        wire:ignore.self 
        class="modal fade" 
        data-bs-backdrop="static" 
        data-bs-keyboard="false" 
        tabindex="-1"
        id="modalCreateEmployee"
        role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="white mx-2"><i class="bi bi-person-plus"></i></h5>
                    <h5 class="modal-title white">
                        Create Employee
                    </h5>
                    <button type="button" wire:click="cancelCreate" data-bs-dismiss="modal" class="btn-close btn-close-white" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    @session('message')
                    <div class="row alert-success-message">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="alert alert-light-success color-success alert-dismissible show fade" role="alert">
                                <i class="bi bi-check-circle"></i>
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    @endsession
    
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-end">First Name</p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left ">
                                <div class="position-relative">
                                    <input 
                                        type="text" 
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        placeholder="First Name..." 
                                        wire:model.defer="first_name" 
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top" 
                                        title="Enter first name">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
    
                            @error('first_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div> {{-- end of first name input --}}
    
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-end">Middle Name</p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left ">
                                <div class="position-relative">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        placeholder="Middle Name..."
                                        wire:model.defer="middle_name" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top"
                                        title="Enter middle name">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> {{-- end of middle name input --}}
    
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-end">Last Name</p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left ">
                                <div class="position-relative">
                                    <input 
                                        type="text" 
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        placeholder="Last Name..." 
                                        wire:model.defer="last_name" 
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top" 
                                        title="Enter last name">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                            @error('last_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div> {{-- end of last name input --}}
    
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-end">Gender</p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left ">
                                <div class="position-relative">
                                    <select 
                                        class="form-select form-control @error('gender') is-invalid @enderror"
                                        wire:model.defer="gender">
                                        <option value="">Select gender...</option>
                                        <option value='male'>Male</option>
                                        <option value='female'>Female</option>
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-gender-ambiguous"></i>
                                    </div>
                                </div>
                            </div>
                            @error('gender')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div> {{-- end of gender selection --}}
    
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-end">Address</p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left ">
                                <div class="position-relative">
                                    <textarea 
                                        wire:model.defer="address" 
                                        placeholder="Address..." 
                                        class="form-control">
                                    </textarea>
                                    <div class="form-control-icon">
                                        <i class="bi bi-house"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> {{-- end of address input --}}
    
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-end">Contact Number</p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left ">
                                <div class="position-relative">
                                    <input 
                                        type="number" 
                                        class="form-control @error('contact_number') is-invalid @enderror"
                                        placeholder="Contact Number..." 
                                        wire:model.defer="contact_number"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Enter contact number">
                                    <div class="form-control-icon">
                                        <i class="bi bi-phone"></i>
                                    </div>
                                </div>
                            </div>
                            @error('contact_number')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div> {{-- end of contact number input --}}
    
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-end">Employment Date</p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input 
                                        type="date" 
                                        class="form-control" 
                                        placeholder="Date of Employment..."
                                        wire:model.defer="employment_date" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top"
                                        title="Select date of employment">
                                    <div class="form-control-icon">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>{{-- end of date of employment --}}
    
                </div>
                <div class="modal-footer">
                    <a href="#" data-bs-dismiss="modal" wire:click="cancelCreate" class="btn btn-secondary">Cancel</a>
                    <a href="#" class="btn btn-primary" wire:click="saveEmployeeInformation">
                        Create
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
