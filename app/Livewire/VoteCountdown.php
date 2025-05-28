<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use App\Models\VoteSession;
use Illuminate\Support\Facades\Auth;

class VoteCountdown extends Component
{

    public $remainingSeconds = 0;


    public string $vote_ends_at = '';

    public string $created_by = '';

    public $active = '';

    public $voteendsID;

    protected function rules()
    {
        return [
            'vote_ends_at' => 'required',
            'created_by' => 'string',
            'active' => '',
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function create()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Create')) {
        

        $created_by = Auth::user()->username;

        // dd($created_by);

        

        $validated = $this->validate([
            'vote_ends_at' => ['required'],
            'created_by' => ['string'],
            'active' => [],
        ]);


        // $validated['vote_ends_at'] = now()->addMinutes(5);
        $validated['created_by'] = $created_by;
        $validated['active'] = true;

        


        VoteSession::create($validated);

        // Reset form fields after successful submission
        // $this->reset($validated);

        // close modal
        Flux::modal('add-votesession')->close();

        $this->redirectIntended(route('vote-countdown', absolute: false), navigate: true);

        session()->flash("success", "Vote Session Successfully Created!!!");
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }


}






    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        //dd($id);
        $this->dispatch('edit-votesession', $id); //livewire laravel com/docs/events#dispatching-events
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



 
    public function delete($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {


        //dd($id);
        $this->voteendsID = $id;
        Flux::modal('delete-votesession')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function deleteVoteSession()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {

        VoteSession::find($this->voteendsID)->delete();
        //display flash message
        session()->flash("success", "Vote Session Successfully Deleted");
        //redirect to user
        $this->redirectRoute('vote-countdown', navigate: true);
 
        Flux::modal('delete-votesession')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

    }

    







    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

            $voteSessions = VoteSession::orderByDesc('created_at')->paginate(10);

        return view('livewire.vote-countdown', ['voteSessions' => $voteSessions]);
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

    }






}
