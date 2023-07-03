<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userPosts = $user->posts()->orderBy('created_at', 'desc')->paginate(4);

//        $urlSmallImage = $userPosts->getFirstMediaUrl('preview', 'small');
//        $urlSmallImage=$userPosts->getFirstMediaUrl('preview', 'small');




        return view('profile.index', compact('userPosts'));
    }

    public function create()
    {
        return view('profile.create');
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(CreatePostRequest $request)
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
