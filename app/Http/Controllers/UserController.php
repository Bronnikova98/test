<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {


        $data = $request->all();
        $user = new User();

        $user->createOrUpdate($data);


        $user->save();



        return redirect()->back();

    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $data = $request->all();

        $user->createOrUpdate($data);
        $user->save();

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
