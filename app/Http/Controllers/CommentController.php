<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        $comment = new Comment();
        $comment->content = $request->input('reply_content');
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->parent_id = $request->input('parent_id');
        $comment->save();

        Notification::create([
            'user_id' => auth()->id(),
            'subject_id' => $post->user_id,
            'post_id' => $postId,
            'type' => 'comment',
            'message' => 'Mengomentari postingan anda'
        ]);

        return redirect()->route('seePost', $postId);
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id == auth()->id()) {
            $comment->delete();
        }

        return back();
    }

    public function toggleCommentLike($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $user = Auth::user();

        $hasLiked = $comment->likes()->where('user_id', $user->id)->exists();

        if ($hasLiked) {
            $comment->likes()->where('user_id', $user->id)->delete();
        } else {
            $comment->likes()->create(['user_id' => $user->id]);
        }

        return redirect()->back();
    }

    public function replyComment(Request $request, $commentId)
{
    $parentComment = Comment::findOrFail($commentId);

    $reply = new Comment();
    $reply->user_id = auth()->id(); 
    $reply->post_id = $parentComment->post_id; 
    $reply->content = $request->input('reply_content'); 
    $reply->parent_id = $parentComment->id; 

    
    $reply->save();

    
    return redirect()->back()->with('reply_comment_id', $reply->id);
}




}
