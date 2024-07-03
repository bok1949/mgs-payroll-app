<div>
    <div 
        wire:ignore.self 
        class="modal fade" 
        data-bs-backdrop="static" 
        data-bs-keyboard="false" 
        tabindex="-2"
        id="createSite" 
        role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="white mx-2"><i class="bi bi-pencil-square"></i></h5>
                    <h5 class="modal-title text-white">
                        Create Working site
                    </h5>
                    <button 
                        type="button" 
                        wire:click="cancelCreate" 
                        class="btn-close" 
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    @session('message')
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="alert alert-light-success color-success alert-dismissible show fade"
                                role="alert">
                                <i class="bi bi-check-circle"></i>
                                <strong>{{ $siteNameValue }}</strong>
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                                <input 
                                    type="text" 
                                    wire:model.defer="site_name" 
                                    class="form-control @error('site_name') is-invalid @enderror" 
                                >
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
                    <a href="#" data-bs-dismiss="modal" wire:click="cancelCreate" class="btn btn-secondary">Cancel</a>
                    <a href="#" class="btn btn-primary" wire:click="createSiteName">
                        Create
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>