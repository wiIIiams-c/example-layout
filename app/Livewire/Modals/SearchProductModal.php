<?php

namespace App\Livewire\Modals;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;

class SearchProductModal extends Component
{
    public $searchId = '';
    public $searchName = '';
    public $isOpen = false;
    
    #[On('openSearchModal')]
    public function open()
    {
        $this->resetFields();
        $this->isOpen = true;
        
        // Add a debug message
        session()->flash('debug', 'Open modal triggered at ' . date('H:i:s'));
    }
    
    public function closeModal()
    {
        $this->isOpen = false;
    }
    
    public function resetFields()
    {
        $this->searchId = '';
        $this->searchName = '';
    }
    
    public function search()
    {
        $query = Product::query();
        
        if (!empty($this->searchId)) {
            $query->where('id', $this->searchId);
        } elseif (!empty($this->searchName)) {
            $query->where('name', 'like', '%' . $this->searchName . '%');
        } else {
            return;
        }
        
        $product = $query->first();
        
        if ($product) {
            // Send the product data back to the parent component
            $this->dispatch('productSelected', [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category,
                'price' => $product->price,
                'stock' => $product->stock
            ]);
            
            // Use event-based notification (primary approach for Livewire components)
            $this->dispatch('showNotification', [
                'type' => 'success',
                'title' => 'Success',
                'message' => "Product '{$product->name}' selected successfully."
            ]);
            
            // Close the modal
            $this->closeModal();
        } else {
            // Create a clear error message based on search criteria
            $searchTerm = !empty($this->searchId) 
                ? "ID: {$this->searchId}" 
                : "Name: {$this->searchName}";
                
            $errorMsg = "No product found matching {$searchTerm}. Please try another search.";
            
            // Use event-based notification (primary approach for Livewire components)
            $this->dispatch('showNotification', [
                'type' => 'error',
                'title' => 'Product Not Found',
                'message' => $errorMsg
            ]);
            
            // Debug log
            $this->dispatch('debug', ['message' => 'Error message flashed: ' . $errorMsg]);
            
            // Close the modal
            $this->closeModal();
        }
    }
    
    public function render()
    {
        return view('livewire.modals.search-product-modal');
    }
} 