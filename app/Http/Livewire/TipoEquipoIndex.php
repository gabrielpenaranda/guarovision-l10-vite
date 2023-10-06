<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\TipoEquipo;

use Livewire\WithPagination;

class TipoEquipoIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'tipo_equipo';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $tipo_equipos = TipoEquipo::where('tipo_equipo', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.tipo-equipo-index', compact('tipo_equipos'));
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
