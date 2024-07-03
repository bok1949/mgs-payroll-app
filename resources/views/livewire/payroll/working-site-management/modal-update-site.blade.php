<div>
    <div 
        wire:ignore.self 
        class="modal fade" 
        id="modalToEdit" 
        tabindex="-1" 
        aria-labelledby="addEmployeeToSite"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header alert alert-primary">
                    <h5 class="white mx-2"><i class="bi bi-pencil-square"></i></h5>
                    <h5 class="modal-title">
                        Updating {{$siteName}}
                    </h5>
                    <button type="button" wire:click="cancelUpdate" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    @session('message')
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="alert alert-light-success color-success alert-dismissible show fade" role="alert">
                                <i class="bi bi-check-circle"></i>
                                <strong>{{ $siteName }}</strong>
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    @endsession
                    
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3 text-end">
                                <label>
                                    Site name:
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                            <div class="col-md-9 form-group">
                                <input type="text" wire:model.defer="site_name"
                                    class="form-control @error('site_name') is-invalid @enderror">
                                @error('site_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.stop="cancelUpdate" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
                    
                    <button type="button" wire:click="saveChanges" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
