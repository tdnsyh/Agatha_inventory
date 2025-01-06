<?php

namespace App\Livewire;

use App\Models\Production;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Products;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Support\Facades\DB;

#[Title('Dashboard')]
class Dashboard extends Component
{

    public $title = "Dashboard";
    public $text_subtitle = "Get an overview of the latest data and information";

    public $totalProducts;
    public $totalTransactions;
    public $totalUsers;
    public $latestSales;
    public $latestProductions;
    public $productions;
    public $salesChartData;
    public $productionChartData;

    public function mount()
    {
        $salesData = Sales::selectRaw('DATE(transaction_date) as date, SUM(total_amount) as total_sales')
            ->groupBy('date')
            ->orderBy('date')
            ->take(5)
            ->get();

        $productionData = Production::selectRaw('DATE(production_date) as date, COUNT(*) as total_productions')
            ->groupBy('date')
            ->orderBy('date')
            ->take(5)
            ->get();

        $this->salesChartData = $salesData;
        $this->productionChartData = $productionData;

        $this->totalProducts = Products::count();
        $this->totalTransactions = Sales::sum('total_amount');
        $this->totalUsers = User::count();
        $this->latestSales = Sales::with('user')->latest()->take(5)->get();
        $this->latestProductions = Production::with('user')->latest()->take(5)->get();
        $this->productions = Production::with('user')->get();
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
