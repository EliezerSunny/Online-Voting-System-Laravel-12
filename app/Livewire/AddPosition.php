<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;

class AddPosition extends Component
{



    public string $code = '';
    public string $name = '';
    public string $party = '';
    public string $created_by = '';

    public $positionID;

    protected function rules()
    {
        return [
            'code' => 'required|string',
            'name' => 'required|string',
            'party' => 'required|string',
            'created_by' => 'string',
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Create')) {
        

        $created_by = Auth::user()->username;

        // dd($created_by);

        

        $validated = $this->validate([
            'code' => ['required', 'string'],
            'name' => ['required', 'string'],
            'party' => ['required', 'string', 'max:255'],
            'created_by' => ['string'],
        ]);


        $validated['created_by'] = $created_by;

        


        Position::create($validated);

        // Reset form fields after successful submission
        // $this->reset($validated);

        // close modal
        Flux::modal('add-position')->close();

        $this->redirectIntended(route('add-position', absolute: false), navigate: true);

        session()->flash("success", "Position successfully Created!!!");
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }


}






    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        //dd($id);
        $this->dispatch('edit-position', $id); //livewire laravel com/docs/events#dispatching-events
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



 
    public function delete($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {


        //dd($id);
        $this->positionID = $id;
        Flux::modal('delete-position')->show();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}


 
    public function deletePosition()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {

        Position::find($this->positionID)->delete();
        //display flash message
        session()->flash("success", "Position successfully Deleted");
        //redirect to user
        $this->redirectRoute('add-position', navigate: true);
 
        Flux::modal('delete-position')->close();
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

    }




    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

            $positions = Position::orderByDesc('created_at')->paginate(10);

        return view('livewire.add-position', ['positions' => $positions]);
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

    }





}
