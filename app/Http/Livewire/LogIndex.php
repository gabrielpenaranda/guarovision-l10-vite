<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Log;

use Livewire\WithPagination;

class LogIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'created_at';
    public $direction = 'desc';
    public $pagination = 5;

    public function render()
    {
        $logs = Log::where('created_at', 'like', '%' . $this->search . '%')
            ->orWhere('table_name', 'like', '%' . $this->search . '%')
            ->orWhere('user_name', 'like', '%' . $this->search . '%')
            ->orWhere('identification', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->orderBy('created_at', 'desc')
            ->paginate($this->pagination);

        return view('livewire.log-index', compact('logs'));
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
