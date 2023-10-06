<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Equipo;

use Livewire\WithPagination;

class EquipoIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'serial';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $equipos = Equipo::where('serial', 'like', '%' . $this->search . '%')
            ->orWhere('pon', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.equipo-index', compact('equipos'));
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
