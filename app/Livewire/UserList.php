<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use App\Models\User;
use Livewire\withPagination;

class UserList extends Component
{
    use WithPagination;

    public $query;

    #[On('user-updated')]
    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function placeholder()
    {
        return view('livewire.placeholder.skeleton');
    }

    #[Computed]
    public function users()
    {
        return User::latest()
            ->where('name', 'like', '%' . $this->query . '%')
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.user-list');
    }
}
