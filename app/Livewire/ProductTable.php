<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\HtmlString;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductTable extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $tableId = 'data-table';
    public $columns = [];
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $showActions = true;
    public $editAction = null;
    public $deleteAction = null;
    public $paginated = true;
    public $emptyStateTitle = null;
    public $emptyStateDescription = null;
    public $model = null;
    public $queryParams = [];
    
    protected $queryString = ['sortField', 'sortDirection'];
    
    public function mount($tableId = null, $columns = [], $model = null, $showActions = true, $editAction = null, $deleteAction = null, $search = '', $sortField = null, $sortDirection = null, $paginated = true, $emptyStateTitle = null, $emptyStateDescription = null, $queryParams = [])
    {
        $this->tableId = $tableId ?? $this->tableId;
        $this->columns = $columns;
        $this->model = $model;
        $this->search = $search;
        $this->sortField = $sortField ?? $this->sortField;
        $this->sortDirection = $sortDirection ?? $this->sortDirection;
        $this->showActions = $showActions;
        $this->editAction = $editAction;
        $this->deleteAction = $deleteAction;
        $this->paginated = $paginated;
        $this->emptyStateTitle = $emptyStateTitle;
        $this->emptyStateDescription = $emptyStateDescription;
        $this->queryParams = $queryParams;
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    #[On('search-updated')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }
    
    public function formatValue($column, $item)
    {
        $key = $column['key'];
        $value = $item->$key;
        
        // If there's a format specified, apply formatting
        if (isset($column['format'])) {
            switch ($column['format']) {
                case 'currency':
                    return new HtmlString('$' . number_format($value, 2));
                
                case 'badge':
                    $color = isset($column['badgeColors']) ? $this->getBadgeColor($value, $column['badgeColors']) : 'primary';
                    return new HtmlString('<span class="badge bg-' . $color . '">' . $value . '</span>');
                
                case 'date':
                    return new HtmlString(date('M d, Y', strtotime($value)));
                
                case 'boolean':
                    return new HtmlString($value ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-x-circle-fill text-danger"></i>');

                default:
                    return $value;
            }
        }
        
        return $value;
    }
    
    protected function getBadgeColor($value, $config)
    {
        foreach ($config as $threshold => $color) {
            if ($value >= $threshold) {
                return $color;
            }
        }
        
        return 'secondary';
    }
    
    public function render()
    {
        $items = collect([]);
        
        if ($this->model) {
            // Create a new query from the model
            $modelClass = $this->model;
            $query = new $modelClass;
            $query = $query->query();
            
            // Apply search if provided
            if ($this->search) {
                $query->where(function($q) {
                    foreach ($this->columns as $column) {
                        if (isset($column['searchable']) && $column['searchable']) {
                            $q->orWhere($column['key'], 'like', "%{$this->search}%");
                        }
                    }
                });
            }
            
            // Apply any additional query parameters
            foreach ($this->queryParams as $method => $params) {
                if (is_callable([$query, $method])) {
                    if (is_array($params)) {
                        $query->{$method}(...$params);
                    } else {
                        $query->{$method}($params);
                    }
                }
            }
            
            // Apply sorting
            $query->orderBy($this->sortField, $this->sortDirection);
            
            // Paginate if required
            if ($this->paginated) {
                $items = $query->paginate(10);
            } else {
                $items = $query->get();
            }
        }
            
        return view('livewire.product-table', [
            'items' => $items
        ]);
    }
} 