<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    
    protected $queryString = ['search', 'sortField', 'sortDirection'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getProductsProperty()
    {
        // In a real application, you would fetch from database with filtering and sorting
        $products = [
            ['id' => 1, 'name' => 'Laptop', 'category' => 'Electronics', 'price' => 999.99, 'stock' => 50],
            ['id' => 2, 'name' => 'Smartphone', 'category' => 'Electronics', 'price' => 699.99, 'stock' => 100],
            ['id' => 3, 'name' => 'Headphones', 'category' => 'Audio', 'price' => 199.99, 'stock' => 75],
            ['id' => 4, 'name' => 'Monitor', 'category' => 'Electronics', 'price' => 299.99, 'stock' => 30],
            ['id' => 5, 'name' => 'Keyboard', 'category' => 'Accessories', 'price' => 89.99, 'stock' => 120],
            ['id' => 6, 'name' => 'Mouse', 'category' => 'Accessories', 'price' => 49.99, 'stock' => 150],
            ['id' => 7, 'name' => 'Speaker', 'category' => 'Audio', 'price' => 149.99, 'stock' => 40],
            ['id' => 8, 'name' => 'Tablet', 'category' => 'Electronics', 'price' => 399.99, 'stock' => 65],
        ];

        // Filter by search term
        if (!empty($this->search)) {
            $search = strtolower($this->search);
            $products = array_filter($products, function($product) use ($search) {
                return str_contains(strtolower($product['name']), $search) || 
                       str_contains(strtolower($product['category']), $search);
            });
        }

        // Sort products
        usort($products, function($a, $b) {
            $fieldA = is_numeric($a[$this->sortField]) ? $a[$this->sortField] : strtolower($a[$this->sortField]);
            $fieldB = is_numeric($b[$this->sortField]) ? $b[$this->sortField] : strtolower($b[$this->sortField]);
            
            if ($fieldA == $fieldB) {
                return 0;
            }
            
            $comparison = ($fieldA < $fieldB) ? -1 : 1;
            return $this->sortDirection === 'desc' ? -$comparison : $comparison;
        });

        return $products;
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => $this->products
        ])->layout('layouts.app');
    }
}
