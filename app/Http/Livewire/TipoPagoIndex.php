<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Estado;

use Livewire\WithPagination;

class TipoPagoIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'estado';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $estados = Estado::where('estado', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.estado-index', compact('estados'));
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
