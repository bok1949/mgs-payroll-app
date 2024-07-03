<div>
    <section class="row">
        <div class="col-12 col-lg-12">
            
            <div class="card">
                <div class="card-header">
                    <h6 class="text-end">{{\Carbon\Carbon::now()->toFormattedDateString()}}</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-1"></div>
                        <div class="col-md-8 align-items-center">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        placeholder="Site name..." 
                                        wire:model.debounce.3000="searchString"
                                    >
                                    <div class="form-control-icon">
                                        <i class="bi bi-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 align-items-center">
                            <div class="input-group">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#createSite">
                                    Create site
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Site name</th>
                                            <th scope="col">Employees count</th>
                                            <th scope="col">Action</th>
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
                                        @foreach ($sites as $site)
                                        <tr>
                                            <th scope="row">{{ $counter }}</th>
                                            <td class="col-auto">{{ $site->site_name }}</td>
                                            <td class="col-auto">{{ $site->emp_count ?? 0 }}</td>
                                            <td class="col-auto">
                                                <div class="dropdown">
                                                    <a class="" 
                                                        href="#"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </a>
                                                
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <li>
                                                            <div class="dropdown-item text-center bg-info">
                                                                {{ $site->site_name }}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a 
                                                                href="#" 
                                                                class="dropdown-item"
                                                                wire:click.stop="openModalToShowEmployeesInSite({{$site->id}}, '{{$site->site_name}}')"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#showEmployeesAssignedToSite"
                                                            >
                                                                <i class="bi bi-person-fill-gear"></i> Show all employees
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a 
                                                                class="dropdown-item" 
                                                                href="#"
                                                                wire:click.stop="openModalToAddEmployeeInSite({{$site->id}}, '{{$site->site_name}}')"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#addEmployeeToSite"
                                                            >
                                                                <i class="bi bi-person-plus-fill"></i> Add employees
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a 
                                                                class="dropdown-item" 
                                                                href="#"
                                                                wire:click.prevent="openModalToUpdateSite({{$site->id}}, '{{$site->site_name}}')"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalToEdit"
                                                            >
                                                                <i class="bi bi-pencil-square"></i> Edit site name
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li>
                                                            <a 
                                                                class="dropdown-item text-danger" 
                                                                href="#"
                                                                wire:click.stop="openModalToDeleteSite({{$site->id}}, '{{$site->site_name}}')"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#confirmDelete"
                                                            >
                                                                <i class="bi bi-trash"></i> Delete this site
                                                            </a>
                                                        </li>
                                                    </ul>
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
                    </div>
                    <div class="row my-3">
                        <div class="col d-flex justify-content-start align-items-center">
                            Showing &nbsp;<strong>{{ $from }}</strong>
                            &nbsp;to&nbsp; <strong>{{ $to }}</strong>
                            &nbsp;of&nbsp; <strong>{{ $total }}</strong>&nbsp; entries
                        </div>
                        <div class="col d-flex justify-content-end">
                            {{ $sites->links() }}
                        </div>
                    </div>
                </div> {{-- end of card body --}}
                
            </div> {{-- end of card --}}
        </div>
    </section>

    @livewire('payroll.working-site-management.modal-create-site')
    @livewire('payroll.working-site-management.modal-update-site')
    @livewire('payroll.working-site-management.modal-delete-site')
    @livewire('payroll.working-site-management.modal-add-employee-to-site')
    @livewire('payroll.working-site-management.modal-show-employees-assigned-to-site')

    <script>
        window.addEventListener('site-deleted', event => {
            Toastify({
                text: event.detail.deleteMessage,
                duration: 5000,
                close:true,
                gravity:"top",
                position: "center",
                style: {
                    background: "#198754"
                }
            }).showToast();
        });

        window.addEventListener('error-adding-employee-to-site', event => {
            window.setTimeout(function() {
                $(".alert-danger").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove();
                });
            }, 5000);
        });

        window.addEventListener('db-update-error', event => {
            alert(event.detail.errormessage);
        });
        
    </script>


</div>
