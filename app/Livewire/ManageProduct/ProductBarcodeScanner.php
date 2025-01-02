<?php

namespace App\Livewire\ManageProduct;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Barcode Scanner')]
class ProductBarcodeScanner extends Component {

    public $title = "Barcode Scanner";
    public $text_subtitle = "Barcode Scanner is used to display product data in the system";

    public function render() {
        return view('livewire.manage-product.product-barcode-scanner');
    }
}
