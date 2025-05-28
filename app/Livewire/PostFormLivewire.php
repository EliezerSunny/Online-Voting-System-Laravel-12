<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use App\Models\PostForm;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PostFormLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $title;
    public $content;
    public $photo;

    public $postID;


    protected function rules() {
        return [
            'title' => 'required',
            'content' => 'required',
            'photo' => 'required|image|max:10024', // validate that it's an image and set max size
        ];
    }

    public function save() {


        if (auth()->check() && auth()->user()->hasPermissionTo('Create')) {

        $this->validate();

        // dd($this->title);

        // Store the file and get its path
        $photoPath = $this->photo->store('photos', 'public');

        
        PostForm::create([
            'title' => $this->title,
            'content' => $this->content,
            'photo' => $photoPath
        ]);

        // Reset form fields after successful submission
        $this->reset(['title', 'content', 'photo']);

        // close modal
        Flux::modal('post-form')->close();

        // Use session flash for message
        session()->flash('success', 'Saved successfully!');
        
        
        
        // For debugging - you can add this to see if the save method is being called
        // Redirect
        $this->redirectRoute('post-form', navigate: true);
    
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        //dd($id);
        $this->dispatch('edit-post', $id); //livewire laravel com/docs/events#dispatching-events
    
        } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}



 
    public function delete($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {

        //dd($id);
        $this->postID = $id;
        Flux::modal('delete-post')->show();
    
        } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}
 
    public function deletePost()
    {
        if (auth()->check() && auth()->user()->hasPermissionTo('Delete')) {

        PostForm::find($this->postID)->delete();
        //display flash message
        session()->flash("success", "Post successfully Deleted");
        //redirect to post
        $this->redirectRoute('post-form', navigate: true);
 
        Flux::modal('delete-post')->close();

} else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}






    public function render()
    {
        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

       $postform = PostForm::orderByDesc('created_at')->paginate(10);

        return view('livewire.post-form', ['postform' => $postform]);

} else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}




}