<div>
    <!-- Include notification component -->
    <x-notification />
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Product</h1>
        <div>
            <button type="button" class="btn btn-primary" wire:click="openSearchModal">
                <i class="bi bi-search"></i> Search Product
            </button>
            <!-- Updated to use Livewire method -->
            <button type="button" class="btn btn-outline-secondary ms-2" wire:click="$dispatch('openSearchModal')">
                <i class="bi bi-search"></i> Direct Open Modal
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" wire:model="name" placeholder="Enter product name">
                    @error('name') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select @error('category') is-invalid @enderror" 
                            id="category" wire:model="category">
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                           id="price" wire:model="price" placeholder="0.00">
                    @error('price') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Initial Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                           id="stock" wire:model="stock" placeholder="0">
                    @error('stock') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('products') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include the search product modal component -->
    <livewire:modals.search-product-modal />
</div> 