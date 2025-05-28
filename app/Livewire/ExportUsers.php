<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
// use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportUsers extends Component
{
    public $sortBy = 'All users';

    public function export()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        return Excel::download(new UsersExport($this->sortBy), $this->sortBy . ' - ' . 'users.xlsx');
   
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}

    public function render()
    {
        return view('livewire.export-users');
    }
}
