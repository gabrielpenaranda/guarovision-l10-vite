<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\MarcaEquipo;

use Livewire\WithPagination;

class MarcaEquipoIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'marca_equipo';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $marca_equipos = MarcaEquipo::where('marca_equipo', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.marca-equipo-index', compact('marca_equipos'));
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
