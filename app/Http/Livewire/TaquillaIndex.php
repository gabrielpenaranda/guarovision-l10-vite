<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Taquilla;

use Livewire\WithPagination;

class TaquillaIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'taquilla';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $taquillas = Taquilla::where('taquilla', 'like', '%' . $this->search . '%')
            ->orWhere('tipo_taquilla', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->orderBy('ciudad_id', 'asc')
            ->paginate($this->pagination);

        return view('livewire.taquilla-index', compact('taquillas'));
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
