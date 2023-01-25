<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    public $search;

    protected $listeners=[
        'FixHapusUser'=>'hapusUser',
        'FixResetPasswordUser'=>'resetPasswordUser',
    ];

    public function render()
    {
        $user=User::with('roles')->where('name', 'like', '%'.$this->search.'%')->orderBy('created_at', 'desc');

        return view('livewire.user-index', [
            'isiTabel' => $user->paginate(30),
        ]);
    }

    public function hapusUser($id)
    {
        User::find($id)->delete();
        return $this->emit('swalDeleted');
    }
    
    public function resetPasswordUser($id)
    {
        $user=User::find($id);
        $user->password=bcrypt('password');
        $user->save();
        return $this->emit('swalUpdated');
    }
}
