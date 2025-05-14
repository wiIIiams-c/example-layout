<div>
    <div class="table-responsive">
        <table class="table table-hover" id="{{ $tableId ?? 'data-table' }}">
            <thead>
                <tr>
                    @foreach($columns as $column)
                        <th scope="col" wire:click="sortBy('{{ $column['key'] }}')" style="cursor: pointer;">
                            {{ $column['label'] }}
                            @if($sortField === $column['key'])
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </th>
                    @endforeach
                    @if($showActions)
                        <th scope="col">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if(count($items) > 0)
                    @foreach($items as $item)
                        <tr>
                            @foreach($columns as $column)
                                <td>
                                    {!! $this->formatValue($column, $item) !!}
                                </td>
                            @endforeach

                            @if($showActions)
                                <td>
                                    <div class="btn-group" role="group">
                                        @if($editAction)
                                            <button type="button" class="btn btn-sm btn-outline-primary" wire:click="$dispatch('{{ $editAction }}', { id: {{ $item->id }} })">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        @endif
                                        @if($deleteAction)
                                            <button type="button" class="btn btn-sm btn-outline-danger" wire:click="$dispatch('{{ $deleteAction }}', { id: {{ $item->id }} })">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ count($columns) + ($showActions ? 1 : 0) }}" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-search display-5 mb-3"></i>
                                <h5>{{ $emptyStateTitle ?? 'No items found' }}</h5>
                                <p class="text-muted">{{ $emptyStateDescription ?? 'Try changing your search terms' }}</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    
    @if($paginated && method_exists($items, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $items->links() }}
        </div>
    @endif
</div> 