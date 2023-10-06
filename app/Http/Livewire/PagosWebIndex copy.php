<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\PagoWeb;

use Livewire\WithPagination;

class PagosWebIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'created_at';
    public $direction = 'asc';
    public $pagination = 5;


    public function render()
    {
        $pago_webs = PagoWeb::where('pago_web', 'like', '%' . $this->search . '%')
            ->orWhere('realizado_por', 'like', '%' . $this->search . '%')
            ->orWhere('cedula', 'like', '%' . $this->search . '%')
            ->orWhere('telefono_celular', 'like', '%' . $this->search . '%')
            ->orWhere('num_referencia', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

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