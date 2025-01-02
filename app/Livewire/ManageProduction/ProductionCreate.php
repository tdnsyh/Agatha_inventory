<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\DetailProduction;
use App\Models\ProductionRequest;

#[Title('Create Production')]
class ProductionCreate extends Component
{

    public $title = "Create Production";
    public $text_subtitle = "This page displays for create data production.";

    public $production_requests;
    public $selected_production_request_id;
    public $production_date;
    public $production_status = 'In Progress';
    public $note;
    public $selected_product;
    public $quantity_produced;
    public $shelf_name;
    public $detail_productions = [];
    public $products;

    public function mount()
    {
        $this->products = Products::all();
        $this->production_requests = ProductionRequest::with('product')->get();
    }

    public function saveProduction()
    {
        $this->validate([
            'selected_production_request_id' => 'required|exists:production_request,id',
            'production_date' => 'required|date',
            'production_status' => 'required|string',
            'note' => 'nullable|string',
            'detail_productions' => 'required|array|min:1',
        ]);

        $production = Production::create([
            'user_id' => Auth::id(),
            'production_request_id' => $this->selected_production_request_id,
            'production_date' => $this->production_date,
            'production_status' => $this->production_status,
            'note' => $this->note,
        ]);

        foreach ($this->detail_productions as $detail) {
            $product = Products::find($detail['product_id']);

            $expiration_date = now()->addDays($product->expired_day);

            DetailProduction::create([
                'production_id' => $production->id,
                'product_id' => $detail['product_id'],
                'batch_code' => $this->generateBatchCode($detail, $this->production_date),
                'shelf_name' => $detail['shelf_name'],
                'quantity_produced' => $detail['quantity_produced'],
                'expiration_date' => $expiration_date,
            ]);
        }

        session()->flash('message', 'Production and details successfully saved.');
        $this->reset();
    }

    protected function generateBatchCode($detail, $productionDate)
    {
        $date = \Carbon\Carbon::parse($productionDate)->format('dm');
        $randomNumber = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        return strtoupper($detail['product_code'] . '-' . $date . $randomNumber);
    }

    public function addDetailProduction()
    {
        $this->validate([
            'selected_product' => 'required|exists:products,id',
            'quantity_produced' => 'required|integer|min:1',
            'shelf_name' => 'nullable|string|max:255',
        ]);

        $product = $this->products->find($this->selected_product);

        $this->detail_productions[] = [
            'product_id' => $product->id,
            'product_code' => $product->code,
            'product_name' => $product->name,
            'variant' => $product->variant,
            'quantity_produced' => $this->quantity_produced,
            'shelf_name' => $this->shelf_name,
        ];

        $this->reset('selected_product', 'quantity_produced', 'shelf_name');
    }


    public function removeDetailProduction($index)
    {
        unset($this->detail_productions[$index]);
        $this->detail_productions = array_values($this->detail_productions);
    }

    public function render()
    {
        return view('livewire.manage-production.production-create');
    }
}
