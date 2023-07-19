<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{
    public $idTo;

    public $name;
    public $username;
    // public $email;
    public $role;
    public $auditeelevel;

    public function mount($id)
    {
        $user = User::find($id);
        $this->name = $user->name;
        $this->username = $user->username;
        // $this->email = $user->email;
        $this->role = $user->roles->first()->name;
        $this->idTo = $id;
        
        if ($this->role == "Auditee") {
            $auditee = $user->auditee;
            $this->auditeelevel = $auditee->level;
        }
    }

    public function rules()
    {

        return [
            'name' => 'required',//string
            'username' =>'required|max:80|unique:users,username,'.$this->idTo.',',
            // 'email' => 'required|email|unique:users,email,'.$this->idTo.',',
            'role'=>'required',
        ];
    }

    public function save()
    {
        $this->validate();

        $user = User::find($this->idTo);
        $user->name = $this->name;
        $user->username = strtolower($this->username);
        // $user->email = $this->email;

        //if role is auditee update auditee level
        if ($this->role == "Auditee") {
            $auditee = $user->auditee;
            $auditee->level = $this->auditeelevel;
            $auditee->save();
        }
        
        $user->save();
        // $user->syncRoles([$this->role]);

        $this->mount($this->idTo);
        $this->emit('swalUpdated');
    }

    public function render()
    {
        return view('livewire.user-edit');
    }
}
