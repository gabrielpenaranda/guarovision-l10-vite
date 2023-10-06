<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Ciudad;

use Livewire\WithPagination;

class CiudadIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'ciudad';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $ciudades = Ciudad::where('ciudad', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->orderBy('estado_id', 'asc')
            ->paginate($this->pagination);

        return view('livewire.ciudad-index', compact('ciudades'));
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
