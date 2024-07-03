<div>
    <div class="card p-2 py-5">
        <div class="card-header">
            <h4 class="card-title text-center">Fill-up Employee Information</h4>
        </div>
        <div class="card-content">
            @session('message')
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div 
                        class="alert alert-light-success color-success alert-dismissible show fade"
                        role="alert"
                    >
                        <i class="bi bi-check-circle"></i> 
                        <strong>{{ $fullName }}</strong>
                        information is created successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            @endsession

            <div class="row">
                <div class="col-md-2">
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
                                title="Enter first name"
                            >
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
                <div class="col-md-2">
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
                                title="Enter middle name"
                            >
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> {{-- end of middle name input --}}

            <div class="row">
                <div class="col-md-2">
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
                                title="Enter last name"
                            >
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
                <div class="col-md-2">
                    <p class="text-end">Gender</p>
                </div>
                <div class="col-md-8">
                    <div class="form-group has-icon-left ">
                        <div class="position-relative">
                            <select 
                                class="form-select form-control @error('gender') is-invalid @enderror" 
                                wire:model.defer="gender"
                            >
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
                <div class="col-md-2">
                    <p class="text-end">Address</p>
                </div>
                <div class="col-md-8">
                    <div class="form-group has-icon-left ">
                        <div class="position-relative">
                            <textarea 
                                wire:model.defer="address" 
                                placeholder="Address..."
                                class="form-control"
                            >
                            </textarea>
                            <div class="form-control-icon">
                                <i class="bi bi-house"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- end of address input --}}

            <div class="row">
                <div class="col-md-2">
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
                                title="Enter contact number"
                            >
                            <div class="form-control-icon" >
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
                <div class="col-md-2">
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

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" wire:click="storeEmployeeInformation()" class="btn btn-primary me-1 mb-1">Submit</button>
                </div>
            </div>

        </div> {{-- end of card content --}}
    </div>

    
    
</div>
