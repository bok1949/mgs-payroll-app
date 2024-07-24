<div>
    <div 
        wire:ignore.self 
        class="modal fade" 
        data-bs-backdrop="static" 
        data-bs-keyboard="false" 
        tabindex="-2"
        id="viewEmployeeInformationModal" 
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="white mx-2"><i class="bi bi-pencil-square"></i></h5>
                    <h5 class="modal-title white">
                        About
                        <span class="text-decoration-underline">
                            {{ $last_name }}, {{ $first_name }}
                        </span>
                    </h5>
                    <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Contact info:</h5>
                                    <p class="card-text">
                                        {{ $contact_number }}
                                    </p> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Address:</h5>
                                    <p class="card-text">
                                        {{ $address }}
                                    </p> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h5 class="card-title">Date of employment:</h5>
                                        <p class="card-text">
                                            {{ $employment_date }}
                                        </p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> {{-- end of employee address info --}}

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Assigned to</th>
                                        <th scope="col">Job title</th>
                                        <th scope="col">Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!is_null($employeeSiteInfo))
                                    @forelse ($employeeSiteInfo as $item)
                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td>{{$item->site_name ?? 'not set'}}</td>
                                            <td>{{$item->job_title ?? 'not set'}}</td>
                                            <td>{{$item->job_title_rate ?? 'not set'}}</td>
                                        </tr>
                                        @php
                                            $counter++;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="3">
                                                <div class="alert alert-warning text-center" role="alert">
                                                    No available data yet, add products to the stock level list.
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" data-bs-dismiss="modal" class="btn btn-secondary">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>