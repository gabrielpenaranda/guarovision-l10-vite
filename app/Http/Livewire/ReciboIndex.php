<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Recibo;
use App\Models\Cliente;

use Livewire\WithPagination;

class ReciboIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'numero';
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

        if ($this->desde == null || $this->hasta == null) {

            switch ($this->criterio) {
                case null:
                    $recibos = Recibo::orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '0':
                    $recibos = Recibo::orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '1':
                    $recibos = Recibo::where('numero', 'like', '%' . $this->search . '%')
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
                    $recibos = Recibo::whereIn('cliente_id', $a_clientes)
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '3':

                    $recibos = Recibo::where('monto_divisa', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '4':

                    $recibos = Recibo::where('saldo', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;
            }
        } elseif ($this->desde <= $this->hasta) {

            switch ($this->criterio) {

                case null:
                    $recibos = Recibo::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '0':
                    $recibos = Recibo::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '1':
                    $recibos = Recibo::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('numero', 'like', '%' . $this->search . '%')
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
                    $recibos = Recibo::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->whereIn('cliente_id', $a_clientes)
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '3':

                    $recibos = Recibo::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('monto_divisa', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '4':

                    $recibos = Recibo::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('saldo', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;
            }
        }

        /*  $recibos = Recibo::where('numero', 'like', '%' . $this->search . '%')
            ->with('cliente')
            ->with('divisa')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination); */

        return view('livewire.recibo-index', compact('recibos'));
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
