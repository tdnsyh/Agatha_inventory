<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Carbon;
use App\Models\Sales;

#[Title('Priority Analysis')]
class PriorityAnalysis extends Component
{

    public $title = "Priority Analysis";
    public $text_subtitle = "Product Priority Analysis Makes it Easier for You to Make Decisions";

    public $startDate;
    public $endDate;
    public $products = [];

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->toDateString();
        $this->endDate = Carbon::now()->toDateString();
    }

    public function render()
    {
        $this->loadProductData();
        return view('livewire.priority-analysis', [
            'title' => 'Product Priority Analysis',
            'products' => $this->products
        ]);
    }

    public function loadProductData()
    {
        $salesData = Sales::whereBetween('transaction_date', [$this->startDate, $this->endDate])
            ->with('details.product')
            ->get();

        $productSales = [];
        foreach ($salesData as $sale) {
            foreach ($sale->details as $detail) {
                $productId = $detail->product_id;
                if (!isset($productSales[$productId])) {
                    $productSales[$productId] = [
                        'totalAmount' => 0,
                        'totalQuantity' => 0,
                        'product' => $detail->product,
                    ];
                }

                $productSales[$productId]['totalAmount'] += $detail->sub_total;
                $productSales[$productId]['totalQuantity'] += $detail->quantity;
            }
        }

        $totalSalesAmount = array_sum(array_column($productSales, 'totalAmount'));
        $totalQuantity = array_sum(array_column($productSales, 'totalQuantity'));

        foreach ($productSales as $productId => $data) {
            $productSales[$productId]['percentageAmount'] = ($data['totalAmount'] / $totalSalesAmount) * 100;
            $productSales[$productId]['percentageQuantity'] = ($data['totalQuantity'] / $totalQuantity) * 100;
            $productSales[$productId]['totalPercentage'] = $productSales[$productId]['percentageAmount'] + $productSales[$productId]['percentageQuantity'];

            $totalPercentage = $productSales[$productId]['totalPercentage'];
            if ($totalPercentage >= 51) {
                $productSales[$productId]['priorityGroup'] = 'A';
            } elseif ($totalPercentage >= 31) {
                $productSales[$productId]['priorityGroup'] = 'B';
            } else {
                $productSales[$productId]['priorityGroup'] = 'C';
            }
        }

        $this->products = $productSales;
    }
}
