<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CommentListPost extends Component
{   
    public $comments;
    public $post;
    public $content;
    public $parent_id;
    protected $rules = [
        'content' => 'required|string|max:1000',
        'parent_id' => 'nullable|integer',
    ];
    protected $listeners = ['commentAdded' => 'refreshComments'];

    public function mount()
    {
        $this->comments = $this->post->comments->whereNull('parent_id')->reverse();
    }
    public function refreshComments()
    {
        $this->comments = $this->post->comments->whereNull('parent_id')->reverse();
    }

    public function store($parentId)
    {
        $this->validate();

        Comment::create([
            'content' => $this->content,
            'parent_id' => $parentId,
            'post_id' => $this->post->id,
            'user_id' => Auth::id()
        ]);

        $this->reset(['content', 'parent_id']);
        $this->refreshComments();
    }

    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        $this->refreshComments();
    }

    public function render()
    {
        return view('livewire.comment-list-post');
    }
}
