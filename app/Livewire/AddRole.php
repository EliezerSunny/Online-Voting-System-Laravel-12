<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddRole extends Component
{



    public string $name = '';
    public string $guard_name = '';

    public $roleID;

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



        Role::create($validated);

        // Reset form fields after successful submission
        // $this->reset($validated);

        // close modal
        Flux::modal('add-role')->close();

        $this->redirectIntended(route('add-role', absolute: false), navigate: true);

        session()->flash("success", "Role successfully Created!!!");
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }


}






public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        //dd($id);
        $this->dispatch('edit-role', $id); //livewire laravel com/docs/events#dispatching-events
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



 
    public function delete($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {


        //dd($id);
        $this->roleID = $id;
        Flux::modal('delete-role')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function deleteRole()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {

        Role::find($this->roleID)->delete();
        //display flash message
        session()->flash("success", "Role successfully Deleted");
        //redirect to user
        $this->redirectRoute('add-role', navigate: true);
 
        Flux::modal('delete-role')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

    }





    
    public function render()
    {
        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

            $roles = Role::orderByDesc('created_at')->paginate(10);

        return view('livewire.add-role', ['roles' => $roles]);
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }
    }



    
}
