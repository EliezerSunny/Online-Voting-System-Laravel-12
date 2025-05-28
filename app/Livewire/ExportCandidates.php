<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Position;
use App\Models\Candidate;
use App\Exports\CandidatesExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportCandidates extends Component
{


    public $sortBy = 'All Candidates';

    public function export()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        return Excel::download(new CandidatesExport($this->sortBy),  $this->sortBy . ' - ' . 'Candidates.xlsx');
    
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}

    public function render()
    {
        $candidates = Candidate::orderByDesc('created_at')->paginate(10);

        $positions = Position::all();

        return view('livewire.export-candidates', ['candidates' => $candidates, 'positions' => $positions]);
    }
}
