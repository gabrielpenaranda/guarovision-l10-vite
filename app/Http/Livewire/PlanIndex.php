<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Plan;

use Livewire\WithPagination;

class PlanIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'plan';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $planes = Plan::where('plan', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.plan-index', compact('planes'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function order($algo)
    {
        if ($this->sort === $algo) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $algo;
            $this->direction = 'asc';
        }
    }
}
