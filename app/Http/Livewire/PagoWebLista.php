<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use App\Models\PagoWeb;

class PagoWebLista extends Component
{
    use WithPagination;

    public $sort = 'num_referencia';
    public $search;
    public $inicio;
    public $final;
    public $direction = 'asc';
    public $pagination = 5;

    public function mount($inicio, $final)
    {
        $this->inicio = $inicio;
        $this->final = $final;
    }

    public function render()
    {
        if ($this->inicio < $this->final) {
            $pago_webs = PagoWeb::where('num_referencia', 'like', '%' . $this->search . '%')
                ->where('created_at', '=>', $this->inicio)
                ->where('created_at', '=<', $this->final)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        } else {
            $pago_webs = PagoWeb::where('num_referencia', 'like', '%' . $this->search . '%')
                ->where('created_at', '=', $this->inicio)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        }
        return view('livewire.pago-web-lista', compact('pago_webs'));
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