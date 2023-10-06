<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Divisa;

use Livewire\WithPagination;

class DivisaIndex extends Component
{

    use WithPagination;

    public $search;
    public $sort = 'divisa';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $divisas = Divisa::where('divisa', 'like', '%' . $this->search . '%')
            ->orWhere('descripcion', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.divisa-index', compact('divisas'));
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
