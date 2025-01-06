<?php

namespace App\Livewire\ManageProduct;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use App\Models\Products;

#[Title('Create Product')]
class ProductCreate extends Component
{

    public $title = "Create Product";
    public $text_subtitle = "This page displays for create data product.";

    use WithFileUploads;

    public $code, $name, $image, $variant, $price, $expired_day, $stock;

    protected $rules = [
        'code' => 'required|unique:products,code',
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|max:1024',
        'variant' => 'nullable|string|max:255',
        'price' => 'required|numeric',
        'expired_day' => 'required|integer',
        'stock' => 'required|integer',
    ];

    public function save()
    {
        $this->validate([
            'code' => 'required|unique:products,code',
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'variant' => 'nullable|string',
            'price' => 'required|numeric',
            'expired_day' => 'required|integer',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        Products::create([
            'code' => $this->code,
            'name' => $this->name,
            'image' => $imagePath,
            'variant' => $this->variant,
            'price' => $this->price,
            'expired_day' => $this->expired_day,
            'stock' => 0,
        ]);

        session()->flash('message', 'Product successfully created.');
        $this->reset();
    }


    public function render()
    {
        return view('livewire.manage-product.product-create');
    }
}
