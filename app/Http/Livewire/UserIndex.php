<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;

use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'name';
    public $direction = 'asc';
    public $pagination = 5;

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('identification', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->orderBy('created_at', 'asc')
            ->paginate($this->pagination);


        return view('livewire.user-index', compact('users'));
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
