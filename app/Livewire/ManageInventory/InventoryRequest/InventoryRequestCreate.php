<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use App\Models\Products;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use App\Models\Production;
use App\Models\DetailProduction;

#[Title('Create Request Production')]
class InventoryRequestCreate extends Component
{

    public $title = "Create Request Production";
    public $text_subtitle = "This page displays for create data request production.";

    public $request_date;
    public $status = 'waiting for response';
    public $products = [];
    public $quantities = [];
    public $inventory_user_id;
    public $selectedProductId = null;
    public $selectedQuantity = null;

    protected $rules = [
        'request_date' => 'required|date',
        'products' => 'required|array',
        'quantities' => 'required|array',
        'quantities.*' => 'required|integer|min:1',
    ];

    public function mount()
    {
        $this->inventory_user_id = Auth::id();
    }

    public function addProduct()
    {
        if (!$this->selectedProductId || !$this->selectedQuantity) {
            session()->flash('error', 'Please select a product and enter a quantity.');
            return;
        }

        $productKey = array_search($this->selectedProductId, $this->products);

        if ($productKey !== false) {

            $this->quantities[$productKey] += $this->selectedQuantity;
        } else {
            $this->products[] = $this->selectedProductId;
            $this->quantities[] = $this->selectedQuantity;
        }

        $this->selectedProductId = null;
        $this->selectedQuantity = null;
    }

    public function removeProduct($index)
    {
        unset($this->products[$index]);
        unset($this->quantities[$index]);

        $this->products = array_values($this->products);
        $this->quantities = array_values($this->quantities);
    }

    public function saveProduction()
    {
        $this->validate();

        $status = 'waiting for response';

        $production = Production::create([
            'inventory_user_id' => $this->inventory_user_id,
            'request_date' => $this->request_date,
            'status' => $status,
        ]);

        foreach ($this->products as $key => $product_id) {
            DetailProduction::create([
                'production_id' => $production->id,
                'product_id' => $product_id,
                'quantity_produced' => $this->quantities[$key],
            ]);
        }

        $this->reset();

        session()->flash('message', 'Production created successfully!');
    }

    public function render()
    {
        $allProducts = Products::all();
        return view('livewire.manage-inventory.inventory-request.inventory-request-create', compact('allProducts'));
    }
}
