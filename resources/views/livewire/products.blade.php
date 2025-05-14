<div>
    <!-- Include notification component -->
    <x-notification />
    
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
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" wire:click="sortBy('id')" style="cursor: pointer;">
                                ID
                                @if($sortField === 'id')
                                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th scope="col" wire:click="sortBy('name')" style="cursor: pointer;">
                                Name
                                @if($sortField === 'name')
                                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th scope="col" wire:click="sortBy('category')" style="cursor: pointer;">
                                Category
                                @if($sortField === 'category')
                                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th scope="col" wire:click="sortBy('price')" style="cursor: pointer;">
                                Price
                                @if($sortField === 'price')
                                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th scope="col" wire:click="sortBy('stock')" style="cursor: pointer;">
                                Stock
                                @if($sortField === 'stock')
                                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product['id'] }}</td>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['category'] }}</td>
                                    <td>${{ number_format($product['price'], 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $product['stock'] > 50 ? 'success' : ($product['stock'] > 20 ? 'warning' : 'danger') }}">
                                            {{ $product['stock'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-search display-5 mb-3"></i>
                                        <h5>No products found</h5>
                                        <p class="text-muted">Try changing your search terms</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
