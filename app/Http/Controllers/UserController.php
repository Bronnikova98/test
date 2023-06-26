<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $user)
    {
        //
    }

    public function edit(string $user)
    {
        return view('users.edit');
    }

    public function update(Request $request, string $user)
    {
        //
    }

    public function destroy(string $user)
    {
        //
    }
}
