<?php
/**
 * @var \App\Models\Comment $comment
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CommentController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
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

    public function edit(Comment $comment): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $post = $comment->post;
        $data = Arr::add($data, 'text', $comment->getText());
        $comment->createOrUpdate($data, $post);
        $comment->save();
        return redirect()->back();
    }

    public function destroy(Comment $comment): \Illuminate\Http\RedirectResponse
    {
        $comment->delete();
        return redirect()->back();
    }
}