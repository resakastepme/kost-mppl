<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', ['users' => User::query()->filter(request(['search']))->latest('name')->get()]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store()
    {
        $attributes = array_merge($this->validate_user(), [
            'isAdmin' => false
        ]);

        User::query()->create($attributes);

        return redirect(route('admin.users'))->with('success', 'Data berhasil disimpan');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(User $user)
    {
        $attributes = $this->validate_user($user);

        $user->update($attributes);

        return redirect(route('admin.users'))->with('success', 'Data berhasil diedit');
    }

    public function destroy(User $user)
    {

        $user->delete();

        return back()->with('success', 'Data terhapus');
    }

    protected function validate_user(?User $user = null): array
    {
        $user ??= new User();

        return request()->validate(
            [
                'name' => ['required'],
                'email' => ['required'],
                'password' => ['required']
            ],
            [
                'name' => [
                    'required' => ':attribute tidak boleh kosong',
                ],
                'email' => [
                    'required' => ':attribute tidak boleh kosong',
                ],
                'password' => [
                    'required' => ':attribute tidak boleh kosong',
                ]
            ],
        );
    }
}
