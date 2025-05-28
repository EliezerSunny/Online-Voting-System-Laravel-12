<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Vote;
use Livewire\Component;

use App\Models\Position;
use App\Models\Candidate;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddCandidate extends Component
{


    use WithFileUploads;
    use WithPagination;
    
    public string $unique_id = '';
    public string $position_id = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $other_name = '';
    public string $username = '';
    public string $email = '';
    public string $gender = '';
    public string $phone_number = '';
    public string $image = '';
    public string $slug = '';
    public string $created_by = '';

    public $candidateID;

    protected function rules()
    {
        return [
            'unique_id' => 'string',
            'position_id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'other_name' => 'string',
            'username' => 'required|string|unique',
            'gender' => 'required|string',
            'email' => 'required|string|email',
            'phone_number' => 'required|string',
            'image' => 'string',
            'slug' => 'string',
            'created_by' => 'string',
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Create')) {

            
        $unique_id = rand(time(), 100000000);

        $created_by = Auth::user()->username;

        // dd($unique_id);

        

        $validated = $this->validate([
            'unique_id' => ['string'],
            'position_id' => ['string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'other_name' => ['string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . Candidate::class],
            'gender' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Candidate::class],
            'phone_number' => ['required', 'min:11', 'max:15'],
            'image' => ['string'],
            'slug' => ['string', 'max:255'],
            'created_by' => ['string'],
        ]);


        $validated['created_by'] = $created_by;


        $validated['slug'] = $validated['username'];

        $validated['image'] = 'candidates/avatar.png';

        $validated['unique_id'] = $unique_id;

        


        Candidate::create($validated);

        // Reset form fields after successful submission
        // $this->reset($validated);

        // close modal
        Flux::modal('add-candidate')->close();

        $this->redirectIntended(route('add-candidate', absolute: false), navigate: true);

        session()->flash("success", "Candidate successfully Created!!!");
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}





    public function edit($id)
    {
        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        //dd($id);
        $this->dispatch('edit-candidate', $id); //livewire laravel com/docs/events#dispatching-events
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}





 
    public function delete($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {

        //dd($id);
        $this->candidateID = $id;
        Flux::modal('delete-candidate')->show();
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function deleteCandidate()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {

        Candidate::find($this->candidateID)->delete();
        //display flash message
        session()->flash("success", "Candidate successfully Deleted");
        //redirect to user
        $this->redirectRoute('add-candidate', navigate: true);
 
        Flux::modal('delete-candidate')->close();
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}





    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        $candidates = Candidate::withCount('votes')->orderByDesc('created_at')->paginate(10);

        $candidate = Candidate::all();

        $positions = Position::all();

        return view('livewire.add-candidate', ['candidates' => $candidates, 'candidate' => $candidate, 'positions' => $positions]);
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }


}



    
}
