<?php

namespace App\Livewire;

use Livewire\Component;
use App\Exports\VotesExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportVotes extends Component
{

    public $sortBy = 'All users';

    public function export()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        return Excel::download(new VotesExport($this->sortBy), $this->sortBy . ' - ' . 'Result.xlsx');
    
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}

    
    public function render()
    {
        return view('livewire.export-votes');
    }
}
