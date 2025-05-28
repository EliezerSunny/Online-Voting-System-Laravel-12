<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Vote;
use Livewire\Component;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\VoteSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CastVote extends Component
{


    

public $voting;

public function mount()
{
    $this->voting = VoteSession::where('active', true)->first();
}

public function checkVotingSession()
{
    $this->voting = VoteSession::where('active', true)->first();

    if ($this->voting && $this->voting->vote_ends_at <= now()) {
        $this->voting->active = false;
        $this->voting->save();

        DB::table("sessions")->truncate();

        Auth::logout();

        session()->flash("success", "Vote Session Successfully Ended!!!");

        return redirect()->route('login');
    }
}










    public array $selectedCandidates = []; // e.g. ['a' => 4, 'b' => 12, 'c' => 6]



    protected function rules()
    {
        return [
            'user_id' => 'required',
            'position_id' => 'required',
            'candidate_id' => 'required',
            'vote' => 'string',
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function vote()
{
    if (!auth()->check() || !auth()->user()->hasPermissionTo('Vote')) {
        session()->flash("error", "Unauthorized Access!");
        return $this->redirectRoute('cast-vote', navigate: true)->with("error", "Unauthorized Access!");
    }

    $userId = auth()->id();



    foreach ($this->selectedCandidates as $positionCode => $candidateId) {
        $position = Position::where('code', $positionCode)->first();

        if (!$position || !$candidateId) {
            continue; // skip if position not found or candidate not selected
        }

        // Optional: Check if this user already voted for this position
        $alreadyVoted = Vote::where('user_id', $userId)
                            ->where('position_id', $position->id)
                            ->exists();


        

     if ($alreadyVoted) {
        Auth::logout();
        return redirect()->route('login')->with('error', "You’ve already voted !!!");
    }


        if (!$alreadyVoted) {
           Vote::create([
                'user_id' => $userId,
                'position_id' => $position->id,
                'candidate_id' => $candidateId,
                'vote' => true,
            ]);

        } 

            
       

        
    }


    $user = Auth::user();
        $user->vote = true;
        $user->last_seen = now();
        $user->save();


    // Logout the user
    Auth::logout();

    // Redirect to login with success message
    session()->flash("success", "All votes submitted. You’ve been logged out.");
    return redirect()->route('login');

}






    public function render()
{
    if (!auth()->check() && !auth()->user()->hasPermissionTo('Read')) {
        session()->flash("error", "Unauthorized Access!");
        return;
    }




    $votes = Vote::orderByDesc('created_at')->paginate(10);

    // Define the order you want positions to appear
    $orderedCodes = ['a', 'b', 'c', 'd', 'e']; // 'a' = President, etc.

    $codeToLabel = [
        'a' => 'President',
        'b' => 'Vice President',
        'c' => 'Secretary',
        'd' => 'Assistant Secretary',
        'e' => 'Treasurer',
    ];

    $candidates = Candidate::with('position')->whereHas('position', function ($query) use ($orderedCodes) {
        $query->whereIn('code', $orderedCodes);
    })->get();

    $grouped = $candidates->groupBy(fn ($c) => $c->position->code);

    $sortedCandidates = collect($orderedCodes)
        ->filter(fn ($code) => isset($grouped[$code]))
        ->mapWithKeys(fn ($code) => [$code => $grouped[$code]]);

        $countDownTime = VoteSession::where('id', 1)->first();

    return view('livewire.cast-vote', [
        'votes' => $votes,
        'sortedCandidates' => $sortedCandidates,
        'codeToLabel' => $codeToLabel,
        'countDownTime' => $countDownTime,
    ]);
}







}
