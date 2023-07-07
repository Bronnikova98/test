<?php
/**
 * @var \App\Models\Post $post
 */
namespace App\Http\Controllers;

use App\Enums\PostCommentParamEnum;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    public function index(SearchRequest $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $params = PostCommentParamEnum::PARAMS;
        $frd = $request->all();
        $posts = Post::filter($frd)->orderBy('created_at', 'desc')->paginate(4);
        return view('posts.index', compact('posts', 'params'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show(Post $post): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // тут изменить is_publish
        $comments = Comment::where('is_publish', 1)->where('post_id', $post->getKey())->orderBy('created_at', 'desc')->paginate(3);
        return view('posts.show', compact('post', 'comments'));
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }

    public function storeComment(CreateCommentRequest $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $comment = new Comment();
        $comment->createOrUpdate($data, $post);
        $comment->save();
        return redirect()->back();
    }

    public function destroyComment(Post $post, Comment $comment): \Illuminate\Http\RedirectResponse
    {
        $comment->delete();
        return redirect()->back();
    }

    public function updateComment(UpdateCommentRequest $request, Post $post, Comment $comment): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $post = $comment->post;
        if ($comment->getIsPublish() === 1) {
            $data = Arr::set($data, 'is_publish', 0);
        } else {
            $data = Arr::set($data, 'is_publish', 1);
        }
        $data = Arr::add($data, 'text', $comment->getText());
        $comment->createOrUpdate($data, $post);
        $comment->save();
        return redirect()->back();
    }
}