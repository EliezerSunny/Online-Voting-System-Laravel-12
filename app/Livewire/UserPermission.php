<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserPermission extends Component
{


public $name, $role_name, $userID;
 
    #[On('user-permission')] //livewire laravel com/docs/events#dispatching-events
 

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'role_name' => 'string',
        ];
    }





 public function assign($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Create')) {


 
        $user = User::findOrFail($id);
        $this->userID = $id;
        $this->name = $user->name;
        $this->role_name = $user->role_name;
        Flux::modal('user-permission')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 

public function assignPermission() 
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Create')) {


         $this->validate([
            'name' => ['required'],
            'role_name' => [],
        ]);

 
        $user = User::find($this->userID);


        $user->assignRole($this->role_name);
            $user->givePermissionTo($this->name);


 
        //display flash message
        session()->flash("success", "Permission Granted successfully");
         
        //redirect to user
        $this->redirectRoute('user-permission', navigate: true);
        Flux::modal('user-permission')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}
    

        



public function revoke($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {

            $user = User::findOrFail($id);
        $this->userID = $id;
        $this->name = $user->name;
        $this->role_name = $user->role_name;
        Flux::modal('revoke-user')->show();

        //dd($id);
        // $this->userID = $id;
        // Flux::modal('revoke-user')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function revokeUser()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {


        $this->validate([
            'name' => ['required'],
            'role_name' => [],
        ]);

 
        $user = User::find($this->userID);

        // $user->removeRole($this->role_name);
        $user->revokePermissionTo($this->name);

        //display flash message
        session()->flash("success", "Permission successfully Revoked");
        //redirect to user
        $this->redirectRoute('user-permission', navigate: true);
 
        Flux::modal('revoke-user')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

    }

        


       


    
    public function render()
    {
        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

            $userpermissions = User::orderByDesc('created_at')->paginate(10);

            $roles = Role::get();
            $permissions = Permission::get();

        return view('livewire.user-permission', ['userpermissions' => $userpermissions, 'roles' => $roles, 'permissions' => $permissions]);
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }
    }





}
