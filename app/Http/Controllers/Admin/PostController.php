<?php
/**
 * @var \App\Models\Post $post
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.index', compact('posts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.show', compact('post'));
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        $post->delete();
        return redirect()->back();
    }
}