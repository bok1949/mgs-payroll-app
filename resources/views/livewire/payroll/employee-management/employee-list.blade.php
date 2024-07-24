<div>
    <div class="card p-2">
        <div class="card-header">
            <h4 class="card-title text-center">{{ $workingSiteNameCardHeader }}</h4>
        </div>
        <div class="card-content">
            <div class="row">
                <div class="col-xl-4 col-md-4 col-sm-12">
                    <div class="input-group">
                        <select class="choices form-select" wire:model="workingSiteFilter">
                            <option value="0">Filter by site...</option>
                            @forelse ($sites as $site)
                                <option value="{{$site->id}}">{{ $site->site_name }}</option>
                            @empty
                                <option class="text-danger">No data available!</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="form-group has-icon-left">
                        <div class="position-relative">
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="Search product name..."
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top"
                                title="i.e. (Last name, First name, or both)"
                                wire:model.lazy="searchString"
                            >
                            <div class="form-control-icon">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-2 col-sm-12">
                    <a class="btn btn-danger " href="#" wire:click.prevent="clearFilter()">
                        Clear Filter
                        <i class="bi bi-x-diamond"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-3 col-sm-12">
                    <div class="form-group has-icon-right">
                        <div class="position-relative">
                            <button type="submit" class="btn btn-primary form-control">Add Employee</button>
                            <div class="form-control-icon">
                                <i class="bi bi-plus-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Sites Assigned</th>
                                    <th scope="col">Action</th>
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

                                @forelse ($employees as $employee)
                                    <tr>
                                        <th scope="row">{{ $counter }}</th>
                                        <td>
                                            {{ Str::ucfirst(Str::lower($employee->last_name)) }}, {{ Str::ucfirst(Str::lower($employee->first_name)) }} 
                                        </td>
                                        <td>{{ Str::ucfirst(Str::lower($employee->gender)) }}</td>
                                        <td>
                                            @php
                                                $employeeWorkingSites = DB::table('working_sites')
                                                    ->join('employee_working_sites', 'employee_working_sites.working_site_id', '=', 'working_sites.id')
                                                    ->where('employee_working_sites.employee_information_id', $employee->employee_id);

                                                $employeeWorkingSites->select('employee_working_sites.job_title');
                                                $jobTitles = $employeeWorkingSites->get();
                                            @endphp
                                            <ol class="">
                                                @forelse ($jobTitles as $jobTitle)
                                                    <li class="{{ $jobTitle->job_title ?? 'text-danger' }}">
                                                        {{ $jobTitle->job_title ?? 'Not set' }}
                                                    </li>
                                                @empty
                                                    <p class="text-warning">Not available</p>
                                                @endforelse
                                            </ol>
                                        </td>
                                        <td>
                                            @php
                                                $employeeWorkingSites->select('employee_working_sites.job_title_rate');
                                                $rates = $employeeWorkingSites->get();
                                            @endphp
                                            <ol class="">
                                                @forelse ($rates as $rate)
                                                    <li class="{{ $rate->job_title_rate ?? 'text-danger' }}">
                                                        {{ $rate->job_title_rate ?? 'Not set' }}
                                                    </li>
                                                @empty
                                                    <p class="text-warning">Not available!</p>
                                                @endforelse
                                            </ol>
                                        </td>
                                        <td>
                                            @php
                                                $employeeWorkingSites->select('working_sites.site_name');
                                                $sites = $employeeWorkingSites->get();
                                            @endphp
                                            <ol class="">
                                                @forelse ($sites as $site)
                                                    <li class="{{ $site->site_name ?? 'text-danger' }}">
                                                        {{ $site->site_name ?? 'Not set' }}
                                                    </li>
                                                @empty
                                                    <p class="text-warning">Not available!</p>
                                                @endforelse
                                            </ol>
                                        </td>
                                        <td>
                                            <a 
                                                href="#" 
                                                wire:click.stop="openModalToViewEmployeeInformation({{$employee->employee_id}})" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewEmployeeInformationModal"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a> |
                                            <a 
                                                href="#" 
                                                wire:click.stop="openModalToUpdateEmployeeInformation({{$employee->employee_id}})" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateEmployeeInformationkModal"
                                            >
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $counter++;
                                    @endphp
                                @empty
                                    <tr>
                                        <th colspan="7">
                                            <div class="alert alert-warning" role="alert">
                                                No result found! <br>
                                                <a href="{{ route('employees.create') }}" class="alert-link">Click here to add employees</a>
                                            </div>
                                        </th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> {{-- end of table container --}}
                </div>
            </div> {{-- end of row of table container --}}

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

        </div> {{-- end of card container --}}
    </div>
    @livewire('payroll.employee-management.modal-update-employee-info')
    @livewire('payroll.employee-management.modal-view-employee-info')
</div>
