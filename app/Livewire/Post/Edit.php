<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;

class Edit extends Component
{
    public $title;
    public $content;
    public $data;
    public $postId;
    public $empty = false;
    public function mount(){
        $this->data = Post::find($this->postId);
        if(!empty($this->data)){
            $this->title = $this->data->title;
            $this->content = $this->data->content;
        }else{
            $this->empty = true;
            session()->flash('msg', __('Data Not Found'));
            session()->flash('alert', 'danger');
        }
    }
    public function render()
    {
        return view('livewire.post.edit');
    }
    public function save(){
        $input = $this->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $post = $this->data;
        $post->title = $this->title;
        $post->content = $this->content;
        try {
            $post->save();
            session()->flash('msg',__('Post Saved Successfully'));
            session()->flash('alert','success');
        }catch (\Throwable $th){
            session()->flash('msg',$th);
            session()->flash('alert','danger');
        }
    }
}
