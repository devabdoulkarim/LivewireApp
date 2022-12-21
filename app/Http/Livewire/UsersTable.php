<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    public string $search = "";
    public string $orderField = 'name';
    public string $orderDirection = 'ASC';
    public int $editId = 0;
    public array $selection = [];

    // Il permet de passer les requetes vers l'url
    protected $queryString = [
        'search' => ['except' => ''],
        'orderField' => ['except' => 'name'],
        'orderDirection' => ['except' => 'ASC'],
    ];

    public function deleteUsers(array $ids)
    {
       User::destroy($ids);
       session()->flash('success', "L'utilisateur a bien été Supprimer");
       $this->selection = [];
    }

    // Il permet d'actualiser un element editer dans le formulaire
    protected $listeners = [
        'userUpdated'=> 'onUserUpdated',
    ];

    public function onUserUpdated(){
        session()->flash('success', "L'utilisateur a bien été mis a jour");
        $this->reset('editId');
    }

    public function updating($name, $value)
    {
        if($name == 'search'){

            $this->resetPage();
        }
    }

    public function startEdit(int $id)
    {
        $this->editId = $id;
    }

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
