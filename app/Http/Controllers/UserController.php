<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all()->pluck('name');
        return view('users.create', compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->all();
        $dataRole = $request->get('role');

        $user = new User();

        $user->createOrUpdate($data);

        $user->assignRole($dataRole);

        $user->save();

        return redirect()->back();

    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {

        $roles = Role::all()->pluck('name', 'id');


        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        $user->createOrUpdate($data);
        $user->save();
        return redirect()->back();

//        if ($user->hasRole('user')) {
//            $user->save();
//            return redirect()->back();
//        }
//
//        if ($user->hasRole('admin')) {
//
//            $auth_current_user_id = Auth::id();
//            $user_id = $user->getKey();
//            if ($auth_current_user_id == $user_id) {
//                $user->save();
//                return redirect()->back();
//            } else {
//                return redirect()->back()->withErrors('error', 'error');
//            }
//        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
