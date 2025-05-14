<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    
    protected $queryString = ['search', 'sortField', 'sortDirection'];
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    // Define the model class to use
    protected function getModelClass()
    {
        return Product::class;
    }

    public function render()
    {
        return view('livewire.products', [
            'modelClass' => $this->getModelClass()
        ])->layout('layouts.app');
    }
}
