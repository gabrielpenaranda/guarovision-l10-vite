<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Banco;
use App\Models\MovimientoBanco;

use Livewire\WithPagination;

use Illuminate\Support\Carbon;

class BancoMovimiento extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'banco';
    public $inicio;
    public $final;
    public $direction = 'asc';
    public $pagination = 5;



    public function render()
    {

        $bancos = Banco::where('pago_movil', true)
            ->orWhere('transferencia', true)
            ->orderBy('banco', 'asc')
            ->get();
        /* try {

            $movimiento_bancos = MovimientoBanco::where('banco_id', $this->search)
                ->where('fecha', '=>', $this->inicio)
                ->where('fecha', '=<', $this->final)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        } */

        $movimiento_bancos = $this->busca_movimientos();

        return view('livewire.banco-movimiento', compact('bancos', 'movimiento_bancos'));
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

    public function busca_movimientos()
    {
        if ($this->inicio > $this->final) {
            session()->flash('error', 'La fecha de inicio no puede ser mayor que la fecha final');
        } else {
            $movimiento_bancos = MovimientoBanco::where('banco_id', $this->search)
                ->where('fecha', '=>', $this->inicio)
                ->where('fecha', '=<', $this->final)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        }

        return $movimiento_bancos;
    }
}