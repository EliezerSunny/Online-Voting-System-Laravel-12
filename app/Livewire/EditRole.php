<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

class EditRole extends Component
{
    
    

    public $name, $guard_name,
    $roleID;
 
    #[On('edit-role')] //livewire laravel com/docs/events#dispatching-events
 
    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {


        //dd("edit role id {$id}");
 
        $role = Role::findOrFail($id);
        $this->roleID = $id;
        $this->name = $role->name;
        $this->guard_name = $role->guard_name;
        Flux::modal('edit-role')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function update() 
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {


        $this->validate(([
            'name' => ['required', 'string', 'max:255'],
            'guard_name' => ['required', 'string', 'max:255'],
        ]));

 
        $role = Role::find($this->roleID);
        $role->name = $this->name;
        $role->guard_name = $this->guard_name;
        $role->save();
 
        //display flash message
        session()->flash("success", "Role successfully updated");
         
        //redirect to user
        $this->redirectRoute('add-role', navigate: true);
        Flux::modal('edit-role')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}





    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        $roles = Role::orderByDesc('created_at')->paginate(10);

        return view('livewire.edit-role', ['roles' => $roles]);
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}




}
