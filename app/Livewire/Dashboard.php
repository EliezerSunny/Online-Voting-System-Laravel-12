<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\User;
use App\Models\Vote;
use Livewire\Component;
use App\Models\Candidate;
use Livewire\Attributes\On;

class Dashboard extends Component
{

    public $vote, $voteID;

    public $rvotes;

    public function mount(){

    if (!auth()->user()->is_admin) {

        return redirect('cast-vote');
        
    }

}
 
    #[On('edit-vote')] //livewire laravel com/docs/events#dispatching-events
 
    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {


        //dd("edit position id {$id}");
 
        $vote = Vote::findOrFail($id);
        $this->voteID = $id;
        $this->vote = $vote->vote;
        Flux::modal('edit-vote')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



 
    public function update() 
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {


        $this->validate(([
            'vote' => ['required', 'boolean'],
        ]));

 
        $vote = Vote::find($this->voteID);
        $vote->vote = $this->vote;
        $vote->save();
 
        //display flash message
        session()->flash("success", "Vote successfully updated");
         
        //redirect to user
        $this->redirectRoute('dashboard', navigate: true);
        Flux::modal('edit-vote')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



public function refresh(){

    $this->rvotes = Vote::count();

}



    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        $voted = Vote::find($this->voteID);

        // dd($voted);

        $votes = Vote::orderByDesc('created_at')->where('vote', true)->paginate(10);

        $votess = Vote::all();

        $users = User::all();

        $candidates = Candidate::all();

        $tvoters = Vote::distinct('user_id')->count('user_id');

        $voters = User::where('vote', true)->get();

        $cvoted = Vote::distinct('candidate_id')->count('candidate_id');

        
        // percentage

        $votersPercentage = ($tvoters / count($users)) * 100;

        $cPercentage = ($cvoted / count($candidates)) * 100;


        // percentage


        $this->refresh();


        return view('livewire.dashboard', ['votes' => $votes, 'votess' => $votess, 'voted' => $voted, 'candidates' => $candidates, 'voters' => $voters,  'votersPercentage' => $votersPercentage, 'cPercentage' => $cPercentage, 'users' => $users]);
    } else {

        session()->flash("error", "Unauthorized Access!");

        return;
    }

    }



}
