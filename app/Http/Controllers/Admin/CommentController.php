<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.comments.index', compact('comments'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $data = $request->all();
        $post = $comment->post;
        $data = Arr::add($data, 'text' , $comment->getText());
        $comment->createOrUpdate($data, $post);
        $comment->save();
        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
