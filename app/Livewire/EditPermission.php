<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Permission;

class EditPermission extends Component
{
    
    


    public $name, $guard_name,
    $permissionID;
 
    #[On('edit-permission')] //livewire laravel com/docs/events#dispatching-events
 
    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {


        //dd("edit permission id {$id}");
 
        $permission = Permission::findOrFail($id);
        $this->permissionID = $id;
        $this->name = $permission->name;
        $this->guard_name = $permission->guard_name;
        Flux::modal('edit-permission')->show();
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

 
        $permission = Permission::find($this->permissionID);
        $permission->name = $this->name;
        $permission->guard_name = $this->guard_name;
        $permission->save();
 
        //display flash message
        session()->flash("success", "Permission successfully updated");
         
        //redirect to user
        $this->redirectRoute('add-permission', navigate: true);
        Flux::modal('edit-permission')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}





    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        $permissions = Permission::orderByDesc('created_at')->paginate(10);

        return view('livewire.edit-permission', ['permissions' => $permissions]);
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}





}
