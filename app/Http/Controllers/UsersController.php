<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UsersRequest;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('services', 'roles')->paginate(10);
        // dd($users[9]->roles[0]->name);
        return view('users.index')->with([
            'users' => $users,
        ]);
    }
    public function edit(User $user)
    {
        $user->load('roles');

        $roles = Role::get();

        return view('users.edit')->with([
            'roles' => $roles,
            'user' => $user,
        ]);
    }
    public function update(UsersRequest $request, User $user)
    {
        $user->update([
            'name' => $request->input('name'),
        ]);

        $user->roles()->sync($request->input('roles_ids'));

        return redirect(route('users.index'));
    }
}
