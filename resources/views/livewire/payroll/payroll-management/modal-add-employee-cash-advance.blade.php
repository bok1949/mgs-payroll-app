<div>
    <div 
        wire:ignore.self 
        class="modal fade" 
        id="addCashAdvanced" 
        tabindex="-1" 
        aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">
                        Create cash advance to: &nbsp;
                        <small>{{$fullName}}</small>
                    </h5>
                    <button 
                        type="button" 
                        wire:click="cancelAddCashAdvance" 
                        class="btn-close btn-close-white" 
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    @if (session()->has('message'))
                    <div class="row my-2">
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('message') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                    </div>
                    @endif

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-2 text-end">
                                <label>Amount<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input 
                                    type="number" 
                                    wire:model.defer="amount" 
                                    class="form-control @error('amount') is-invalid @enderror"
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="this is required field"
                                >
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-end">
                                <label>Date<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input 
                                    type="date" 
                                    wire:model.defer="cash_advanced_date" 
                                    class="form-control @error('cash_advanced_date') is-invalid @enderror"
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="this is required field"
                                >
                                @error('cash_advanced_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-end"><label>Purpose</label></div>
                            <div class="col-md-8 form-group">
                                <textarea 
                                    wire:model.defer="purpose" 
                                    class="form-control"
                                >
                                </textarea>
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button 
                        type="button" 
                        wire:click="cancelAddCashAdvance"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                    
                    <button 
                        type="button" 
                        wire:click="saveCashAdvance" 
                        class="btn btn-primary"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
