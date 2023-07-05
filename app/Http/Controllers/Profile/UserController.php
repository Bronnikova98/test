<?php
/**
 * @var \App\Models\User $user
 */
namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        return view('users.profile.index', compact('user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('users.profile.edit', compact('user'));
    }

    public function update(UpdateProfileUserRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $user->createOrUpdate($data);
        $photo = Arr::get($data, 'photo');
        $user->uploadFile($photo);
        $user->save();
        return redirect()->back();
    }

    public function destroy(User $user)
    {
        //
    }

}
