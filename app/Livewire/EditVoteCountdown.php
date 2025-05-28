<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use App\Models\VoteSession;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class EditVoteCountdown extends Component
{



    public string $vote_ends_at = '';

    public string $created_by = '';

    public $active = '';

    public $voteendsID;
 
    #[On('edit-votesession')] //livewire laravel com/docs/events#dispatching-events
 
    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {


        //dd("edit position id {$id}");
 
        $votesession = VoteSession::findOrFail($id);
        $this->voteendsID = $id;
        $this->vote_ends_at = $votesession->vote_ends_at;
        $this->created_by = $votesession->created_by;
        $this->active = $votesession->active;
        Flux::modal('edit-votesession')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function update() 
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

            $created_by = Auth::user()->username;

        $this->validate(([
            'vote_ends_at' => ['required'],
            'created_by' => ['required', 'string'],
            'active' => ['required'],
        ]));

 
        $votesession = VoteSession::find($this->voteendsID);
        $votesession->vote_ends_at = $this->vote_ends_at;
        $votesession->created_by = $created_by;
        $votesession->active = $this->active;
        $votesession->save();
 
        //display flash message
        session()->flash("success", "Vote Session Successfully Updated");
         
        //redirect to user
        $this->redirectRoute('vote-countdown', navigate: true);
        Flux::modal('edit-votesession')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}




    public function render()
    {       
        
        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

            $voteSessions = VoteSession::orderByDesc('created_at')->paginate(10);

        return view('livewire.edit-vote-countdown', ['voteSessions' => $voteSessions]);
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}




}
