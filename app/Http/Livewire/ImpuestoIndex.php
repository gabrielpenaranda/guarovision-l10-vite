<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Impuesto;

use Livewire\WithPagination;

class ImpuestoIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'impuesto';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $impuestos = Impuesto::where('impuesto', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.impuesto-index', compact('impuestos'));
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
