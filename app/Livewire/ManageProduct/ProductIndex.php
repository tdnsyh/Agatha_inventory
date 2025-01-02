<?php

namespace App\Livewire\ManageProduct;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Products;
use Livewire\WithPagination;

#[Title('Product List')]
class ProductIndex extends Component
{

    public $title = "Product List";
    public $text_subtitle = "Product List is used to display, manage, and monitor product data in the system";
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function builder()
    {
        return Products::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%');
    }

    public function columns()
    {
        return [
            'Code' => 'code',
            'Name' => 'name',
            'Variant' => 'variant',
            'Price' => 'price',
            'Expired Day' => 'expired_day',
            'Stock' => 'stock',
            'Updated At' => 'updated_at',
            'Actions' => 'actions',
        ];
    }

    public function actions($row)
    {
        return view(
            'livewire.manage-product.product-index',
            ['product' => $row]
        );
    }

    public function destroy(Products $product)
    {
        $product->delete();
        return back()->with('message', 'Product deleted successfully.');
    }

    public function render()
    {
        return view('livewire.manage-product.product-index', [
            'products' => $this->builder()->paginate(10),
        ]);
    }
}
