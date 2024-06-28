<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SearchUsers extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.search-users', [
            'users' => User::query()
                ->withTrashed()
                ->search($this->search)
                ->orderBy('name')
                ->paginate(10),
            'search' => $this->search,
        ]);
    }
}
