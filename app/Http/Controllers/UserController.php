<?php
/**
 * @var \App\Models\User $user
 */
namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::orderBy('created_at', 'desc')->paginate(3);
        return view('users.index', compact('users'));
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $roles = Role::all()->pluck('name');
        return view('users.create', compact('roles'));
    }

    public function store(CreateUserRequest $request): \Illuminate\Http\RedirectResponse
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

    public function edit(User $user): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {
        Log::info('Update user ' . $user->getKey(), ['name' => $user->getName()]);
        $data = $request->all();
        $user->createOrUpdate($data);
        $user->save();
        return redirect()->back();
    }

    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        $user->delete();
        return redirect()->back();
    }
}