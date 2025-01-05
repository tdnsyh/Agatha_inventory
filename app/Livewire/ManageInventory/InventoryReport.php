<?php

namespace App\Livewire\ManageInventory;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\InventoryIn;
use App\Models\InventoryOut;
use Illuminate\Support\Carbon;

#[Title('Inventory Report')]
class InventoryReport extends Component
{

    public $title = "Inventory Report";
    public $text_subtitle = "Generate Inventory Reports instantly";
    public $startDate;
    public $endDate;

    public function render()
    {
        $inventoryInReports = InventoryIn::with('product')
            ->when($this->startDate, function ($query) {
                return $query->where('inventory_date', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                return $query->where('inventory_date', '<=', $this->endDate);
            })
            ->get();

        $inventoryOutReports = InventoryOut::with('product')
            ->when($this->startDate, function ($query) {
                return $query->where('inventory_date', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                return $query->where('inventory_date', '<=', $this->endDate);
            })
            ->get();

        foreach ($inventoryInReports as $report) {
            $report->inventory_date = Carbon::parse($report->inventory_date)->format('d-m-Y');
            $report->expiration_date = Carbon::parse($report->expiration_date)->format('d-m-Y');
        }

        foreach ($inventoryOutReports as $report) {
            $report->inventory_date = Carbon::parse($report->inventory_date)->format('d-m-Y');
        }

        return view('livewire.manage-inventory.inventory-report', [
            'inventoryInReports' => $inventoryInReports,
            'inventoryOutReports' => $inventoryOutReports,
            'title' => 'Inventory Report',
        ]);
    }

    public function updatedStartDate($value)
    {
        $this->startDate = Carbon::parse($value)->format('Y-m-d');
    }

    public function updatedEndDate($value)
    {
        $this->endDate = Carbon::parse($value)->format('Y-m-d');
    }
}
