<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class EditUser extends Component
{



    use WithFileUploads;
 
    public $username, $email, 
    // $image, 
    $userID;
 
    #[On('edit-user')] //livewire laravel com/docs/events#dispatching-events
 
    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

            
        //dd("edit user id {$id}");
 
        $user = User::findOrFail($id);
        $this->userID = $id;
        $this->username = $user->username;
        $this->email = $user->email;
        // $this->image = $user->image;
        Flux::modal('edit-user')->show();
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}
 
    public function update() 
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        $this->validate(([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required'],
            // 'image' => 'image|max:10024',
        ]));

        // Store the file and get its path
        // $imagePath = $this->image->store('users', 'public');
 
        $user = User::find($this->userID);
        $user->username = $this->username;
        $user->email = $this->email;
        // $user->image = $imagePath;
        $user->save();
 
        //display flash message
        session()->flash("success", "User successfully updated");
         
        //redirect to user
        $this->redirectRoute('register', navigate: true);
        Flux::modal('edit-user')->close();
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }


    }




    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        return view('livewire.edit-user');
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



}
