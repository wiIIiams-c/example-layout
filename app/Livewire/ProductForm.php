<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;

class ProductForm extends Component
{
    public $name = '';
    public $category = '';
    public $price = '';
    public $stock = 0;
    
    // Define available categories
    public function getCategoriesProperty()
    {
        return [
            'Electronics',
            'Clothing',
            'Food',
            'Home & Garden',
            'Books',
            'Sports',
            'Toys',
            'Health & Beauty',
            'Automotive'
        ];
    }
    
    // Validation rules
    protected $rules = [
        'name' => 'required|min:3',
        'category' => 'required',
        'price' => 'required|numeric|min:0.01',
        'stock' => 'required|integer|min:0',
    ];
    
    public function openSearchModal()
    {
        // In Livewire 3, dispatch event to the modal component
        $this->dispatch('openSearchModal');
    }
    
    public function save()
    {
        $this->validate();
        
        $product = Product::create([
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);
        
        // Create success message
        $message = "Product '{$this->name}' was created successfully!";
        
        // Set up notification for the next page using sessionStorage
        session()->flash('notification_script', "
            <script>
                window.setRedirectNotification('success', '{$message}', 'Success');
            </script>
        ");
        
        // Also use standard session flash for systems without JS
        return redirect()->route('products')
            ->with('message', $message);
    }
    
    #[On('productSelected')]
    public function productSelected($product)
    {
        // Directly populate the form with the selected product data
        $this->name = $product['name'];
        $this->category = $product['category'];
        $this->price = $product['price'];
        $this->stock = $product['stock'];
        
        // Add a confirmation message
        session()->flash('info', "Product '{$product['name']}' loaded successfully!");
    }
    
    #[On('productNotFound')]
    public function productNotFound()
    {
        session()->flash('error', 'Product not found. Please try another search.');
    }
    
    public function render()
    {
        return view('livewire.product-form', [
            'categories' => $this->categories
        ])->layout('layouts.app');
    }
} 