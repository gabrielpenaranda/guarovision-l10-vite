<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Concepto;

use Livewire\WithPagination;

class ConceptoIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'concepto';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $conceptos = Concepto::where('concepto', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.concepto-index', compact('conceptos'));
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
