<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Banco;

use Livewire\WithPagination;

class BancoIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'banco';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $bancos = Banco::where('banco', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.banco-index', compact('bancos'));
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
