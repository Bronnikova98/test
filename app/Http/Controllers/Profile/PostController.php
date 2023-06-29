<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $userPosts = Post::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(2);
        return view('profile.index', compact('userPosts'));
    }

    public function create()
    {
        return view('profile.create');
    }

    public function store(CreatePostRequest $request)
    {
        $data = $request->all();
        $post = new Post();
        $post->createOrUpdate($data);
        $post->save();
        return redirect()->back();
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('profile.edit', [
            'post' => $post,
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->all();
        $post->createOrUpdate($data);
        $post->save();
        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
