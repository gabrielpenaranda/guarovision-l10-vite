<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Zona;

use Livewire\WithPagination;

class ZonaIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'zona';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $zonas = Zona::where('zona', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->orderBy('ciudad_id', 'asc')
            ->paginate($this->pagination);

        return view('livewire.zona-index', compact('zonas'));
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
