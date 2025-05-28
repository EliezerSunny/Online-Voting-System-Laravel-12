<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use App\Models\Position;
use App\Models\Candidate;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class EditCandidate extends Component
{


    use WithFileUploads;
 
    public $position_id, $first_name, $last_name, $other_name, $username, $email, 
    $image, 
    $candidateID;
 
    #[On('edit-candidate')] //livewire laravel com/docs/events#dispatching-events
 
    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

            
        //dd("edit candidate id {$id}");
 
        $candidate = Candidate::findOrFail($id);
        $this->candidateID = $id;
        $this->position_id = $candidate->position_id;
        $this->first_name = $candidate->first_name;
        $this->last_name = $candidate->last_name;
        $this->other_name = $candidate->other_name;
        $this->username = $candidate->username;
        $this->email = $candidate->email;
        $this->image = $candidate->image;
        Flux::modal('edit-candidate')->show();
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function update() 
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {


        $this->validate(([
            'position_id' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'other_name' => ['string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required'],
            'image' => 'image|max:10024',
        ]));

        // Store the file and get its path
        $imagePath = $this->image->store('candidates', 'public');
 
        $candidate = Candidate::find($this->candidateID);
        $candidate->position_id = $this->position_id;
        $candidate->first_name = $this->first_name;
        $candidate->last_name = $this->last_name;
        $candidate->other_name = $this->other_name;
        $candidate->username = $this->username;
        $candidate->email = $this->email;
        $candidate->image = $imagePath;
        $candidate->save();
 
        //display flash message
        session()->flash("success", "Candidate successfully updated");
         
        //redirect to user
        $this->redirectRoute('add-candidate', navigate: true);
        Flux::modal('edit-candidate')->close();
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}




    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {


        $candidate = Candidate::all();

        $positions = Position::all();

        return view('livewire.edit-candidate', ['candidate' => $candidate, 'positions' => $positions]);
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}




    
}
