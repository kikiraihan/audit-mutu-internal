<?php

namespace App\Http\Livewire;

use App\Models\Auditee;
use App\Models\User;
use Livewire\Component;

class UserAdd extends Component
{
    public $name;
    public $username;
    // public $email;
    public $role;
    public $auditeelevel;

    public function mount()
    {
    }

    protected $rules = [
        'name' => 'required', //string
        'username' => 'required|unique:users,username', //string
        // 'email' => 'required|email|unique:users,email',//string
        'role' => 'required',
        'auditeelevel' => 'nullable|in:fakultas,jurusan,prodi',
    ];


    public function save()
    {
        $this->validate();
        $user = new User;
        $user->name = $this->name;
        $user->username = strtolower($this->username);
        // $user->email = $this->email;
        //password
        $user->password = bcrypt('password');
        $user->save();
        $user->assignRole($this->role);

        if ($this->role == "Auditee") {
            $auditee = new Auditee;
            $auditee->id_user = $user->id;
            // level
            $auditee->level = $this->auditeelevel;
            $auditee->save();
        }

        $this->mount();
        $this->emit('swalAdded');
    }

    public function render()
    {
        return view('livewire.user-add');
    }
}
