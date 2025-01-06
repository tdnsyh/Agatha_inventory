<?php

namespace App\Livewire\ManageInventory;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\InventoryIn;
use App\Models\InventoryOut;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

#[Title('Inventory Report')]
class InventoryReport extends Component
{

    public $title = "Inventory Report";
    public $text_subtitle = "Generate Inventory Reports instantly";

    use WithPagination;

    public $startDate;
    public $endDate;
    public $paginationCount = 10;

    protected $listeners = ['filterDate'];

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->toDateString();
        $this->endDate = Carbon::now()->endOfMonth()->toDateString();
    }

    public function filterDate($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function render()
    {
        $inventoryIn = InventoryIn::whereBetween('inventory_date', [$this->startDate, $this->endDate])
            ->with('product')
            ->paginate($this->paginationCount);

        $inventoryOut = InventoryOut::whereBetween('inventory_date', [$this->startDate, $this->endDate])
            ->with('inventoryIn')
            ->paginate($this->paginationCount);

        return view('livewire.manage-inventory.inventory-report', compact('inventoryIn', 'inventoryOut'));
    }
}
