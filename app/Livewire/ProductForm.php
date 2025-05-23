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
        // Start with the base categories
        $categories = [
            'Electronics',
            'Clothing',
            'Food',
            'Home & Garden',
            'Books',
            'Sports',
            'Toys',
            'Health & Beauty',
            'Automotive',
            'Accessories'  // Add the missing category
        ];
        
        // If we have a category that's not in the list, add it
        if (!empty($this->category) && !in_array($this->category, $categories)) {
            $categories[] = $this->category;
        }
        
        return $categories;
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
        
        // Dispatch event for the select2 component to update
        $this->dispatch('categoryUpdated');
    }
    
    #[On('productNotFound')]
    public function productNotFound($data = null)
    {
        // Use message from data if available, otherwise use default
        $errorMsg = isset($data['message']) ? $data['message'] : 'Product not found. Please try another search.';
        
        // Flash error message for server-side notification
        session()->flash('error', $errorMsg);
        
        // The notification will be handled by the modal component's event listener
        // We don't need to dispatch additional events here to avoid duplicates
    }
    
    #[On('showNotification')]
    public function handleShowNotification($data)
    {
        // No need to handle this separately - the modal already dispatches notifyError
    }
    
    public function render()
    {
        return view('livewire.product-form', [
            'categories' => $this->categories
        ])->layout('layouts.app');
    }
} 