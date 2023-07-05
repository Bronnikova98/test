<?php
/**
 * @var \App\Models\Post $post
 */
namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $userPosts = $user->posts()->orderBy('created_at', 'desc')->with('media')->paginate(4);
        return view('profile.index', compact('userPosts'));
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('profile.create');
    }

    public function store(CreatePostRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $post = new Post();
        $post->createOrUpdate($data);
        $post->save();
        $image = Arr::get($data, 'image');
        $post->uploadFile($image);
        return redirect()->back();
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('profile.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $post->createOrUpdate($data);
        $post->save();
        return redirect()->back();
    }

    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        $post->delete();
        return redirect()->back();
    }
}
