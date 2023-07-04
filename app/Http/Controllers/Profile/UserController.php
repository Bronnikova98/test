<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
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
    public function edit(User $user)
    {
        return view('users.profile.edit', [
            'user' => $user,
        ]);
    }
    public function update(UpdateProfileUserRequest $request, User $user)
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
