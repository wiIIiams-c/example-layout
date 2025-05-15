<div>
    <!-- Notification component is already included in the main layout -->
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('product.create') }}" class="btn btn-sm btn-outline-primary me-2">
                <i class="bi bi-plus"></i> Add Product
            </a>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Print</button>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Search products...">
                @if($search)
                    <button wire:click="$set('search', '')" class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-x"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <livewire:product-table 
                tableId="products-table"
                :columns="[
                    ['key' => 'id', 'label' => 'ID', 'searchable' => true],
                    ['key' => 'name', 'label' => 'Name', 'searchable' => true],
                    ['key' => 'category', 'label' => 'Category', 'searchable' => true],
                    ['key' => 'price', 'label' => 'Price', 'searchable' => false, 'format' => 'currency'],
                    [
                        'key' => 'stock', 
                        'label' => 'Stock',
                        'searchable' => true,
                        'format' => 'badge',
                        'badgeColors' => [
                            50 => 'success',
                            20 => 'warning',
                            0 => 'danger'
                        ]
                    ]
                ]"
                :model="$modelClass"
                :search="$search"
                :sortField="$sortField"
                :sortDirection="$sortDirection"
                :showActions="true"
                editAction="edit-product"
                deleteAction="delete-product"
                :paginated="true"
                emptyStateTitle="No products found"
                emptyStateDescription="Try changing your search terms"
            />
        </div>
    </div>
</div>
