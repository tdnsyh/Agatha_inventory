<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use App\Models\Products;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionRequest;

#[Title('Create Request Production')]
class InventoryRequestCreate extends Component
{

    public $title = "Create Request Production";
    public $text_subtitle = "This page displays for create data request production.";

    public $product_id;
    public $request_date;
    public $quantity_request;
    public $note;

    protected $rules = [
        'product_id' => 'required|exists:products,id',
        'request_date' => 'required|date',
        'quantity_request' => 'required|integer|min:1',
    ];

    public function submitRequest()
    {
        $this->validate();

        ProductionRequest::create([
            'id' => 'PR-' . now()->format('Ymd'),
            'user_id' => Auth::id(),
            'product_id' => $this->product_id,
            'request_date' => $this->request_date,
            'quantity_request' => $this->quantity_request,
            'status_request' => 'Waiting For Response',
            'note' => $this->note,
        ]);

        session()->flash('message', 'Production request submitted successfully!');
    }

    public function render()
    {
        $products = Products::all();
        return view('livewire.manage-inventory.inventory-request.inventory-request-create', compact('products'));
    }
}
