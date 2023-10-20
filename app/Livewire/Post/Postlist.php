<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;

class Postlist extends Component
{
    public $keyword;
    public function render()
    {
        $post = $this->getData();
        return view('livewire.post.postlist',compact('post'));
    }
    public function getData(){
        $data = Post::where('title','like','%'.$this->keyword.'%')->paginate(12);
        return $data;
    }
    public function deletePost($id){
        $post = Post::find($id);
        if(!empty($post)){
            $post->delete();
            session()->flash('msg',__('Post Deleted Succesfully'));
            session()->flash('alert','success');
        }else{
            session()->flash('msg',__('Post Not Found'));
            session()->flash('alert','danger');
        }
    }
}
