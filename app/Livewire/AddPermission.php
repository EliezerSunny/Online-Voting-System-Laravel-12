<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class AddPermission extends Component
{
    
    

    public string $name = '';
    public string $guard_name = '';

    public $permissionID;

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'guard_name' => 'required|string',
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Create')) {
        

      
        // dd($created_by);

        

        $validated = $this->validate([
            'name' => ['required', 'string'],
            'guard_name' => ['required', 'string'],
        ]);



        Permission::create($validated);

        // Reset form fields after successful submission
        // $this->reset($validated);

        // close modal
        Flux::modal('add-permission')->close();

        $this->redirectIntended(route('add-permission', absolute: false), navigate: true);

        session()->flash("success", "Permission successfully Created!!!");
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }


}






public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        //dd($id);
        $this->dispatch('edit-permission', $id); //livewire laravel com/docs/events#dispatching-events
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



 
    public function delete($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {


        //dd($id);
        $this->permissionID = $id;
        Flux::modal('delete-permission')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function deletePermission()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {

        Permission::find($this->permissionID)->delete();
        //display flash message
        session()->flash("success", "Permission successfully Deleted");
        //redirect to user
        $this->redirectRoute('add-permission', navigate: true);
 
        Flux::modal('delete-permission')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

    }





    
    public function render()
    {
        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

            $permissions = Permission::orderByDesc('created_at')->paginate(10);

        return view('livewire.add-permission', ['permissions' => $permissions]);
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }
    }





}
