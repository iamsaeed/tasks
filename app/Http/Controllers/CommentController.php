<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $type = ("App\\Models\\" . Str::studly($request->input('model')))::find($request->input('id'));

        $comment = $type->comments()->create([
            'description' => $request->input('description'),
            'status' => 'active',
            'parent_id' => $request->input('comment_id') ?? null,
            'created_id' => Auth::id()
        ]);

        $message = $request->input('comment_id')
            ? 'Reply added successfully!'
            : 'Comment added successfully!';

        return $this->processResponse('comment', $comment, $message);
    }

    public function destroy(Request $request)
    {
        $comments = Comment::where('id', $request->input('id'))
        ->orWhere('parent_id', $request->input('id'))->delete();

        return $this->processResponse('comment', $comments, 'Comment deleted!');
    }
}
