<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\ModeloEquipo;

use Livewire\WithPagination;

class ModeloEquipoIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'modelo_equipo';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $modelo_equipos = ModeloEquipo::where('modelo_equipo', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.modelo-equipo-index', compact('modelo_equipos'));
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
