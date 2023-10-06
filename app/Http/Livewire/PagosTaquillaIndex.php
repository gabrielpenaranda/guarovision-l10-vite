<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\PagoTaquilla;
use App\Models\Cliente;

use Livewire\WithPagination;

class PagosTaquillaIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'created_at';
    public $direction = 'asc';
    public $pagination = 5;
    public $desde = null;
    public $hasta = null;
    public $criterio = null;


    public function render()
    {
        if ($this->desde > $this->hasta) {
            $this->hasta = null;
        }

        /* if ($this->desde == null && $this->hasta == null) {

            switch ($this->criterio) {
                case null:
                    $pago_taquillas = PagoTaquilla::orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '0':
                    $pago_taquillas = PagoTaquilla::orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '1':
                    $pago_taquillas = PagoTaquilla::where('pago_taquilla', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '2':
                    $clientes = Cliente::where('nombres', 'like', '%' . $this->search . '%')
                        ->orWhere('apellidos', 'like', '%' . $this->search . '%')
                        ->get();
                    $a_clientes = array();
                    foreach ($clientes as $c) {
                        $a_clientes[] = $c->id;
                    }
                    $pago_taquillas = PagoTaquilla::whereIn('cliente_id', $a_clientes)
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '3':

                    $pago_taquillas = PagoTaquilla::where('monto_total', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;
            }
        } else */
        
        if ($this->desde == null || $this->hasta == null) {

            switch ($this->criterio) {
                case null:
                    $pago_taquillas = PagoTaquilla::orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '0':
                    $pago_taquillas = PagoTaquilla::orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '1':
                    $pago_taquillas = PagoTaquilla::where('pago_taquilla', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '2':
                    $clientes = Cliente::where('nombres', 'like', '%' . $this->search . '%')
                        ->orWhere('apellidos', 'like', '%' . $this->search . '%')
                        ->get();
                    $a_clientes = array();
                    foreach ($clientes as $c) {
                        $a_clientes[] = $c->id;
                    }
                    $pago_taquillas = PagoTaquilla::whereIn('cliente_id', $a_clientes)
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '3':

                    $pago_taquillas = PagoTaquilla::where('monto_total', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;
            }
            
        } elseif ($this->desde <= $this->hasta) {

            switch ($this->criterio) {
                case null:
                    $pago_taquillas = PagoTaquilla::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '0':
                    $pago_taquillas = PagoTaquilla::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '1':
                    $pago_taquillas = PagoTaquilla::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('pago_taquilla', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '2':
                    $clientes = Cliente::where('nombres', 'like', '%' . $this->search . '%')
                        ->orWhere('apellidos', 'like', '%' . $this->search . '%')
                        ->get();
                    $a_clientes = array();
                    foreach ($clientes as $c) {
                        $a_clientes[] = $c->id;
                    }
                    $pago_taquillas = PagoTaquilla::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->whereIn('cliente_id', $a_clientes)
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '3':

                    $pago_taquillas = PagoTaquilla::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('monto_total', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;
            }
        }



        return view('livewire.pagos-taquilla-index', compact('pago_taquillas'));
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
