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

    public $barcode;  // Menampung barcode input
    public $inventoryIn;  // Menampung data inventory_in berdasarkan batch_code
    public $product;  // Menampung data produk berdasarkan inventory_in
    public $inventoryOut;  // Menampung data inventory_out

    public function mount()
    {
        $this->barcode = '';
        $this->inventoryIn = null;
        $this->product = null;
        $this->inventoryOut = null;
    }

    // Fungsi untuk mencari produk berdasarkan batch_code
    public function searchProduct()
    {
        // Cari InventoryIn berdasarkan batch_code
        $this->inventoryIn = InventoryIn::where('batch_code', $this->barcode)->first();

        if ($this->inventoryIn) {
            // Ambil data produk berdasarkan product_id dari inventory_in
            $this->product = $this->inventoryIn->product;
            // Ambil data terakhir dari inventory_out
            $this->inventoryOut = $this->inventoryIn->inventoryOut()->latest()->first();
        } else {
            $this->product = null;
            $this->inventoryOut = null;
        }
    }

    public function render()
    {
        return view('livewire.manage-product.product-barcode-scanner');
    }
}
