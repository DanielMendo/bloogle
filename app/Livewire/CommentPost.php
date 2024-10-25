<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use App\Notifications\NewComment;
use Illuminate\Support\Facades\Auth;

class CommentPost extends Component
{
    public $post;
    public $content;
    public $parent_id;
    protected $rules = [
        'content' => 'required|string|max:1000',
        'parent_id' => 'nullable|integer',
    ];

    public function comment()
    {
        $this->validate();

        Comment::create([
            'content' => $this->content,
            'parent_id' => $this->parent_id,
            'post_id' => $this->post->id,
            'user_id' => Auth::id()
        ]);

        $this->post->user->notify(new NewComment(Auth::user(), $this->post));

        $this->dispatch('commentAdded');

        $this->reset(['content', 'parent_id']);
    }

    public function render()
    {
        return view('livewire.comment-post');
    }
}
