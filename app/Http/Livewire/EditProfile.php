<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class EditProfile extends Component
{
    public $idTo;
    public $name;
    public $username;
    public $password;

    public function rules()
    {
        return [
            'name' => 'required|string', //string
            'username' =>'required|max:80|unique:users,username,'.$this->idTo.',',
            'password' => 'nullable|string', //string
        ];
    }

    public function mount(){
        $this->idTo = auth()->user()->id;                    
        $this->name = auth()->user()->name;
        $this->username = auth()->user()->username;
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }

    public function save()
    {
        $this->validate();

        $user = User::find($this->idTo);
        $user->name = $this->name;
        $user->username = $this->username;
        if($this->password){
            $user->password = bcrypt($this->password);
        }
        $user->save();
        $this->emit('swalUpdated');
    }
}
