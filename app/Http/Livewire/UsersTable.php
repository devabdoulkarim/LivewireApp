<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    public string $search = "";
    public string $orderField = 'name';
    public string $orderDirection = 'ASC';

    protected $queryString = [
        'search' => ['except' => ''],
        'orderField' => ['except' => 'name'],
        'orderDirection' => ['except' => 'ASC'],
    ];

    public function setOrderField(string $name)
    {
       if ($name == $this->orderField) {
            $this->orderDirection = $this->orderDirection == 'ASC' ? 'DESC' : 'ASC';
       } else {
            $this->orderField = $name;
            $this->reset('orderDirection');
            // $this->orderDirection = 'ASC';
       }

    }

    public function render()
    {
        return view('livewire.users-table',[
            'users' => User::where('name', 'LIKE', "%{$this->search}%")
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(5)
        ]);
    }
}
