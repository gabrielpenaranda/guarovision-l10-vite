<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use App\Models\PagoTaquilla;

class PagoTaquillaLista extends Component
{
    use WithPagination;

    public $sort = 'pago_taquilla';
    public $search;
    public $inicio;
    public $final;
    public $taquilla_id;
    public $direction = 'asc';
    public $pagination = 5;

    public function mount($taquilla_id, $inicio, $final)
    {
        $this->taquilla_id = $taquilla_id;
        $this->inicio = $inicio;
        $this->final = $final;
    }

    public function render()
    {
        if ($this->inicio < $this->final) {
            $pago_taquillas = PagoTaquilla::where('taquilla_id', $this->taquilla_id)
                ->where('pago_taquilla', 'like', '%' . $this->search . '%')
                ->where('created_at', '=>', $this->inicio)
                ->where('created_at', '=<', $this->final)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        } else {
            $pago_taquillas = PagoTaquilla::where('taquilla_id', $this->taquilla_id)
                ->orderwhere('pago_taquilla', 'like', '%' . $this->search . '%')
                ->where('created_at', '=', $this->inicio)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        }

        return view('livewire.pago-taquilla-lista', compact('pago_taquillas'));
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