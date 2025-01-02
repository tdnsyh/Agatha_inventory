<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Production;

#[Title('Production List')]
class ProductionIndex extends Component
{

    public $title = "Production List";
    public $text_subtitle = "Production List is used to display, manage, and monitor production data in the system";

    use WithPagination;

    public $search = '';
    public $sortField = 'production_date';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $productions = Production::with('user', 'details')
            ->where('production_status', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.manage-production.production-index', compact('productions'));
    }
}
