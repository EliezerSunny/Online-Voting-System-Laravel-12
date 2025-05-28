<?php

namespace App\Livewire;

use Flux\Flux;
use Livewire\Component;
use App\Models\PostForm;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class EditPost extends Component
{

    use WithFileUploads;
 
    public $title, $content, $photo, $postID;
 
    #[On('edit-post')] //livewire laravel com/docs/events#dispatching-events
 
    public function edit($id)
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        //dd("edit post id {$id}");
 
        $post = PostForm::findOrFail($id);
        $this->postID = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->photo = $post->photo;
        Flux::modal('edit-post')->show();

    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}
 
    public function update() 
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Edit')) {

        $this->validate(([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'photo' => 'required|image|max:10024',
        ]));

        // Store the file and get its path
        $photoPath = $this->photo->store('photos', 'public');
 
        $post = PostForm::find($this->postID);
        $post->title = $this->title;
        $post->content = $this->content;
        $post->photo = $photoPath;
        $post->save();
 
        //display flash message
        session()->flash("success", "post successfully updated");
         
        //redirect to post
        $this->redirectRoute('post-form', navigate: true);
        Flux::modal('edit-post')->close();
    
    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}
 
    public function render()
    {

        if (auth()->check() && auth()->user()->hasPermissionTo('Read')) {

        return view('livewire.edit-post');

    } else {
        $this->redirectRoute('cast-vote', navigate: true);

        session()->flash("error", "Unauthorized Access!");
    }

}






}
