<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $totalUsers = 0;
    public $totalProducts = 0;
    public $totalRevenue = 0;
    public $activities = [];

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        // In a real application, you would fetch this data from the database
        $this->totalUsers = 256;
        $this->totalProducts = 128;
        $this->totalRevenue = 15487.65;

        $this->activities = [
            [
                'action' => 'Product Created',
                'user' => 'John Doe',
                'date' => now()->subHours(1)->format('M d, H:i'),
                'status' => 'Completed',
                'status_color' => 'success'
            ],
            [
                'action' => 'Order Placed',
                'user' => 'Jane Smith',
                'date' => now()->subHours(2)->format('M d, H:i'),
                'status' => 'Processing',
                'status_color' => 'warning'
            ],
            [
                'action' => 'Customer Registered',
                'user' => 'Sam Wilson',
                'date' => now()->subHours(3)->format('M d, H:i'),
                'status' => 'Completed',
                'status_color' => 'success'
            ],
            [
                'action' => 'Payment Received',
                'user' => 'Lisa Johnson',
                'date' => now()->subHours(5)->format('M d, H:i'),
                'status' => 'Completed',
                'status_color' => 'success'
            ],
            [
                'action' => 'Order Cancelled',
                'user' => 'Mike Brown',
                'date' => now()->subHours(8)->format('M d, H:i'),
                'status' => 'Cancelled',
                'status_color' => 'danger'
            ],
        ];

        // Add a flash message using Livewire's flash messaging
        session()->flash('message', 'Data refreshed successfully!');
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.app');
    }
}
