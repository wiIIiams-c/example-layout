<div>
    <!-- Debug info -->
    @if(session()->has('debug'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('debug') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Modal controlled by Livewire properties -->
    <div class="modal {{ $isOpen ? 'show d-block' : 'fade' }}" 
         id="searchProductModal" 
         tabindex="-1" 
         aria-labelledby="searchModalLabel" 
         aria-hidden="{{ $isOpen ? 'false' : 'true' }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Search Product</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="search">
                        <div class="mb-3">
                            <label for="searchId" class="form-label">Product ID</label>
                            <input type="number" class="form-control" id="searchId" 
                                wire:model="searchId" placeholder="Enter product ID" 
                                wire:change="$set('searchName', '')">
                        </div>
                        <div class="mb-3">
                            <label for="searchName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="searchName" 
                                wire:model="searchName" placeholder="Enter product name"
                                wire:change="$set('searchId', '')">
                            <div class="form-text">Search by ID or name, not both.</div>
                        </div>
                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Backdrop -->
    @if($isOpen)
    <div class="modal-backdrop fade show"></div>
    @endif
</div> 