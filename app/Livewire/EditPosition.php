<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use App\Models\Position;
use Livewire\Attributes\On;

class EditPosition extends Component
{



    public $code, $name, $party,
    $positionID;
 
    #[On('edit-position')] //livewire laravel com/docs/events#dispatching-events
 
    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {


        //dd("edit position id {$id}");
 
        $position = Position::findOrFail($id);
        $this->positionID = $id;
        $this->code = $position->code;
        $this->name = $position->name;
        $this->party = $position->party;
        Flux::modal('edit-position')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function update() 
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {


        $this->validate(([
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'party' => ['required', 'string', 'max:255'],
        ]));

 
        $position = Position::find($this->positionID);
        $position->code = $this->code;
        $position->name = $this->name;
        $position->party = $this->party;
        $position->save();
 
        //display flash message
        session()->flash("success", "Position successfully updated");
         
        //redirect to user
        $this->redirectRoute('add-position', navigate: true);
        Flux::modal('edit-position')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}





    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        $positions = Position::orderByDesc('created_at')->paginate(10);

        return view('livewire.edit-position', ['positions' => $positions]);
    }  else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



}
