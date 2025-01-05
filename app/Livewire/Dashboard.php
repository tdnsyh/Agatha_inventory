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
    public $latestSales = [];
    public $latestProductions = [];
    public $productionData = [];
    public $salesData = [];

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $this->totalProducts = Products::count();
        $this->totalTransactions = Sales::whereMonth('transaction_date', $currentMonth)
            ->whereYear('transaction_date', $currentYear)
            ->sum('total_amount');
        $this->totalUsers = User::count();

        $this->latestSales = Sales::with('user')
            ->whereMonth('transaction_date', $currentMonth)
            ->whereYear('transaction_date', $currentYear)
            ->latest()
            ->take(5)
            ->get();

        $this->latestProductions = Production::with('user')
            ->latest()
            ->take(5)
            ->get();

        $this->productionData = Production::select(DB::raw('DATE(production_date) as date'), DB::raw('count(*) as production_count'))
            ->groupBy(DB::raw('DATE(production_date)'))
            ->orderBy('date')
            ->get();

        logger($this->productionData);

        $this->salesData = Sales::select(DB::raw('DATE(transaction_date) as date'), DB::raw('sum(total_amount) as total_sales'))
            ->groupBy(DB::raw('DATE(transaction_date)'))
            ->orderBy('date')
            ->get();

        logger($this->salesData);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
