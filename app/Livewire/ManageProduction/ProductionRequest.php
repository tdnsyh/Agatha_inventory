<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ProductionRequest as ProductionRequestModel;

#[Title('Production Request List')]
class ProductionRequest extends Component
{

    public $title = "Production Request List";
    public $text_subtitle = "Production Request List is used to display, manage, and monitor production data in the system";

    public $productionRequests;

    public function getStatusBadgeClass($status)
    {
        switch ($status) {
            case 'Waiting For Response':
                return 'secondary';
            case 'In Progress':
                return 'warning';
            case 'Cancelled':
                return 'danger';
            case 'Completed':
                return 'info';
            default:
                return 'primary';
        }
    }

    public function mount()
    {
        $this->productionRequests = ProductionRequestModel::with('user', 'product')->get();
    }

    public function render()
    {
        return view('livewire.manage-production.production-request');
    }
}
