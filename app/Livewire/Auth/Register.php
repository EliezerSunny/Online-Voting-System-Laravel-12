<?php

namespace App\Livewire\Auth;

use Flux\Flux;
use App\Models\User;
use Livewire\Component;
use App\Mail\WelcomeUserMail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

    

class Register extends Component
{
    
    public string $unique_id = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $other_name = '';
    public string $username = '';
    public string $email = '';
    public string $gender = '';
    public string $phone_number = '';
    public string $image = '';
    public string $slug = '';
    public string $status = '';
    public string $created_by = '';
    public string $last_seen = '';
    public string $password = '';
    public string $password_confirmation = '';

    public $userID;

    protected function rules()
    {
        return [
            'unique_id' => 'string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'other_name' => 'string',
            'username' => 'required|string|unique',
            'gender' => 'required|string',
            'email' => 'required|string|email',
            'phone_number' => 'required|string',
            'image' => 'string',
            'slug' => 'string',
            'status' => 'string',
            'created_by' => 'string',
            'password' => 'string',
            'last_seen' => 'string',
            'password_confirmation' => 'string',
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Create')) {
            # code...
        
        $unique_id = rand(time(), 100000000);

        $created_by = Auth::user()->username;

        // dd($unique_id);

        

        $validated = $this->validate([
            'unique_id' => ['string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'other_name' => ['string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'gender' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'min:11', 'max:15'],
            'image' => ['string'],
            'slug' => ['string', 'max:255'],
            'status' => ['string', 'max:255'],
            'created_by' => ['string'],
            'last_seen' => ['string'],
            'password' => ['string', 'string', Rules\Password::defaults()],
        ]);

        $validated['password'] = $validated['username'];

        $validated['created_by'] = $created_by;

        $validated['last_seen'] = now();

        $validated['slug'] = $validated['username'];

        $validated['image'] = 'users/avatar.png';

        $validated['unique_id'] = $unique_id;

        $validated['status'] = 'Offline';

        

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        // Auth::login($user);

        $user->assignRole('User');

        $user->givePermissionTo(['Vote']);

        // Mail::to($user['email'])->send(new WelcomeUserMail($user));
        

        $this->redirectIntended(route('register', absolute: false), navigate: true);

        session()->flash("success", "User successfully Created!!!");
    } else {
        
        session()->flash("error", "Unauthorized Access!");

        return;
    }


}



    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        //dd($id);
        $this->dispatch('edit-user', $id); //livewire laravel com/docs/events#dispatching-events
    } else {
        session()->flash("error", "Unauthorized Access!");

        return;
    }

}



 
    public function delete($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {
        //dd($id);
        $this->userID = $id;
        Flux::modal('delete-user')->show();
    } else {
        session()->flash("error", "Unauthorized Access!");

        return;
    }

}

 
    public function deleteUser()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {


        User::find($this->userID)->delete();
        //display flash message
        session()->flash("success", "User successfully Deleted");
        //redirect to user
        $this->redirectRoute('register', navigate: true);
 
        Flux::modal('delete-user')->close();
    } else {
       session()->flash("error", "Unauthorized Access!");

        return;
    }


    }




    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        $users = User::orderByDesc('created_at')->paginate(10);

        return view('livewire.auth.register', ['users' => $users]);
    } else {
        

        session()->flash("error", "Unauthorized Access!");

        return;
    }
    
}




}
