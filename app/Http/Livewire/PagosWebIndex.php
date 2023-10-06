<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\PagoWeb;
use App\Models\Cliente;

use Livewire\WithPagination;

class PagosWebIndex extends Component
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

        if ($this->desde == null || $this->hasta == null) {

            switch ($this->criterio) {
                case null:
                    $pago_webs = PagoWeb::orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '0':
                    $pago_webs = PagoWeb::orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '1':
                    $pago_webs = PagoWeb::where('pago_web', 'like', '%' . $this->search . '%')
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
                    $pago_webs = PagoWeb::whereIn('cliente_id', $a_clientes)
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '3':

                    $pago_webs = PagoWeb::where('monto', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '4':

                    $pago_webs = PagoWeb::where('num_referencia', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '5':

                    $pago_webs = PagoWeb::where('realizado_por', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '6':

                    $pago_webs = PagoWeb::where('cedula', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;
            }
        } elseif ($this->desde <= $this->hasta) {

            switch ($this->criterio) {
                case null:
                    $pago_webs = PagoWeb::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '0':
                    $pago_webs = PagoWeb::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '1':
                    $pago_webs = PagoWeb::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('pago_web', 'like', '%' . $this->search . '%')
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
                    $pago_webs = PagoWeb::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->whereIn('cliente_id', $a_clientes)
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '3':

                    $pago_webs = PagoWeb::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('monto', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '4':

                    $pago_webs = PagoWeb::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('num_referencia', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '5':

                    $pago_webs = PagoWeb::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('realizado_por', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;

                case '6':

                    $pago_webs = PagoWeb::where('created_at', '>=', $this->desde . 'T00:00:00.000000Z')
                        ->where('created_at', '<=', $this->hasta . 'T23:59:59.000000Z')
                        ->where('cedula', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->with('cliente')
                        ->paginate($this->pagination);
                    break;
            }
        }

        /* $pago_webs = PagoWeb::where('pago_web', 'like', '%' . $this->search . '%')
            ->orWhere('realizado_por', 'like', '%' . $this->search . '%')
            ->orWhere('cedula', 'like', '%' . $this->search . '%')
            ->orWhere('telefono_celular', 'like', '%' . $this->search . '%')
            ->orWhere('num_referencia', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination); */

        return view('livewire.pagos-web-index', compact('pago_webs'));
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
