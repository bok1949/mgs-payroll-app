<div>
    <div 
        wire:ignore.self 
        class="modal fade" 
        id="confirmDelete" 
        tabindex="-1" 
        aria-labelledby="addEmployeeToSite"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header alert alert-warning">
                    <h5 class="white mx-2"><i class="bi bi-trash3"></i></h5>
                    <h5 class="modal-title">
                        Confirm action
                    </h5>
                    <button type="button" wire:click="cancelDelete" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" wire:init="init">
                        @if ($loadData)    
                            <div class="col-md-12">
                                <p class="text-center">
                                    {!! $deleteMessage !!}
                                </p>
                            </div>
                        @else
                            <div class="col-md-12 text-center">
                                Loading data....
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.stop="cancelDelete" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    @if ($employeeCount === 0)
                        <button type="button" wire:click="confirmDelete" class="btn btn-danger"
                        data-bs-dismiss="modal">Confirm</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>