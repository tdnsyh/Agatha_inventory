<?php

namespace App\Livewire\ManageProduct;

use App\Models\Products;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Title('Update Product')]
class ProductUpdate extends Component
{

    public $title = "Update Product";
    public $text_subtitle = "This page displays the product data to be changed.";
    use WithFileUploads;

    public $product;
    public $code, $name, $variant, $price, $expired_day, $stock, $image;
    public $imagePath;

    public function mount($id)
    {
        $this->product = Products::findOrFail($id);

        $this->code = $this->product->code;
        $this->name = $this->product->name;
        $this->variant = $this->product->variant;
        $this->price = $this->product->price;
        $this->expired_day = $this->product->expired_day;
        $this->stock = $this->product->stock;
        $this->imagePath = $this->product->image;
    }

    public function updateProduct()
    {
        $validatedData = $this->validate([
            'code' => 'required|unique:products,code,' . $this->product->id,
            'name' => 'required|string',
            'variant' => 'nullable|string',
            'price' => 'required|numeric',
            'expired_day' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($this->image) {

            if ($this->imagePath) {
                Storage::delete($this->imagePath);
            }

            $imageName = time() . '.' . $this->image->extension();
            $this->imagePath = $this->image->storeAs('public/products', $imageName);
        }

        $this->product->update([
            'code' => $this->code,
            'name' => $this->name,
            'variant' => $this->variant,
            'price' => $this->price,
            'expired_day' => $this->expired_day,
            'stock' => $this->stock,
            'image' => $this->imagePath,
        ]);

        session()->flash('message', 'Product updated successfully!');
    }
    public function render()
    {
        return view('livewire.manage-product.product-update');
    }
}
