<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\DetailProduction;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

#[Title('Create Production Request ')]
class ProductionRequestCreate extends Component
{

    public $title = "Create Production Request";
    public $text_subtitle = "This page displays for create data production.";

    public $production;
    public $products;
    public $status;
    public $note;
    public $product_id;
    public $batch_code;
    public $shelf_name;
    public $quantity_produced;
    public $expiration_date;
    public $production_user_id;
    public $productionRequest = [];
    public $production_date;

    public function mount($productionId)
    {
        $this->production = Production::findOrFail($productionId);
        $this->products = Products::all();
        $this->status = $this->production->status;
        $this->note = $this->production->note;
        $this->production_user_id = Auth::id();
        $this->production_date = $this->production->production_date;
    }

    public function updatedStatus($status)
    {
        Log::info('Status updated: ' . $status);
        switch ($status) {
            case 'complete':
                $this->batch_code = 'BC-' . Str::upper(Str::random(4));
                break;

            case 'rejected':
                $this->batch_code = null;
                break;

            case 'in progress':
                $this->batch_code = null;
                break;

            default:
                $this->batch_code = null;
                break;
        }
    }

    public function save()
    {
        $detail = DetailProduction::where('production_id', $this->production->id)->first();

        if (!$detail) {
            session()->flash('error', 'Detail production tidak ditemukan.');
            return;
        }

        if ($this->status === "") {
            session()->flash('error', 'Please select a valid status.');
            return;
        }

        $this->product_id = $detail->product_id;
        $this->quantity_produced = $detail->quantity_produced;

        $this->production_user_id = Auth::id();

        Production::updateOrCreate(
            ['id' => $this->production->id],
            [
                'status' => $this->status,
                'note' => $this->note,
                'production_user_id' => Auth::id(),
                'production_date' => $this->production_date,
            ]
        );

        DetailProduction::updateOrCreate(
            ['production_id' => $this->production->id, 'product_id' => $this->product_id],
            [
                'batch_code' => $this->batch_code,
                'shelf_name' => $this->shelf_name,
                'quantity_produced' => $this->quantity_produced,
                'expiration_date' => $this->calculateExpirationDate(),
            ]
        );

        session()->flash('message', 'Production updated successfully!');
    }

    protected function calculateExpirationDate()
    {
        $product = Products::find($this->product_id);

        if ($product && $this->production_date) {
            return Carbon::parse($this->production_date)->addDays($product->expired_day);
        }

        return null;
    }

    public function render()
    {
        $details = DetailProduction::where('production_id', $this->production->id)->get();
        return view('livewire.manage-production.production-request-create', compact('details'));
    }
}
