<?php

namespace App\Livewire\ManageProduct;

use App\Models\Products;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Show Product')]
class ProductShow extends Component
{

    public $title = "Show Product";
    public $text_subtitle = "This page displays details of product data.";
    public $product;

    public function mount($id)
    {
        $this->product = Products::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.manage-product.product-show');
    }
}
