<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Cliente;

use Livewire\WithPagination;

class ClienteIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'apellidos';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        if (auth()->user()->otro) {
            $clientes = Cliente::where('otro', true)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        } else {
            $clientes = Cliente::where('apellidos', 'like', '%' . $this->search . '%')
                ->orWhere('nombres', 'like', '%' . $this->search . '%')
                ->orWhere('cedula', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->with('ciudad')
                ->with('plan')
                ->with('zona')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        }

        return view('livewire.cliente-index', compact('clientes'));
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