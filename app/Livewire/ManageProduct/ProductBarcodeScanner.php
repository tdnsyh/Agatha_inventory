<?php

namespace App\Livewire\ManageProduct;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\InventoryIn;

#[Title('Barcode Scanner')]
class ProductBarcodeScanner extends Component
{

    public $title = "Barcode Scanner";
    public $text_subtitle = "Barcode Scanner is used to display product data in the system";

    public $barcode;
    public $inventoryIn;
    public $product;
    public $inventoryOut;

    public function mount()
    {
        $this->barcode = '';
        $this->inventoryIn = null;
        $this->product = null;
        $this->inventoryOut = null;
    }

    public function searchProduct()
    {
        $this->inventoryIn = InventoryIn::where('batch_code', $this->barcode)->first();

        if ($this->inventoryIn) {
            $this->product = $this->inventoryIn->product;
            $this->inventoryOut = $this->inventoryIn->inventoryOut()->latest()->first();
        } else {
            $this->product = null;
            $this->inventoryOut = null;
        }

        $this->barcode = '';
    }

    public function render()
    {
        return view('livewire.manage-product.product-barcode-scanner');
    }
}
