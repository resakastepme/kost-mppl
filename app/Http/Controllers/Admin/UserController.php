<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::query()->filter(request(['search']))->getOccupants()->latest('name')->get()
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store()
    {
        $attributes = array_merge($this->validate_user(), [
            'isAdmin' => false,
        ]);

        if ($attributes['ktp'] ?? false) $attributes['ktp'] = request()->file('ktp')->store('images', 'public');


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

        if ($attributes['ktp'] ?? false) $attributes['ktp'] = request()->file('ktp')->store('images', 'public');

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
                'name' => ['required', 'max:200'],
                'email' => ['required', Rule::unique('users', 'email'), 'max:100'],
                'password' => ['required', 'min:5', 'max:50'],
                'ktp' => ['image']
            ],
            [
                'name' => [
                    'required' => ':attribute tidak boleh kosong',
                    'max' => ':attribute maksimal 200 karakter',
                ],
                'email' => [
                    'required' => ':attribute tidak boleh kosong',
                    'unique' => ':attribute sudah terdaftar',
                    'max' => ':attribute maksimal 100 karakter',
                ],
                'password' => [
                    'required' => ':attribute tidak boleh kosong',
                    'min' => ':attribute minimal 5 karakter',
                    'max' => ':attribute maksimal 50 karakter',
                ],
                'ktp' => [
                    'required' => ':attribute harus berupa foto',
                ],
            ],
        );
    }
}
