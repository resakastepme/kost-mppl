<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        return view('profile', ['user' => $user]);
    }

    public function update(User $user)
    {
        $attributes = $this->validate_user($user);

        $user->update($attributes);

        // buat user logout setelah berhasil riset password
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect(route('login'));
    }

    protected function validate_user(?User $user = null): array
    {
        $user ??= new User();

        return request()->validate(
            [
                'email' => ['required', Rule::unique('users', 'email')->ignore($user), 'max:100'],
                'password' => ['min:5', 'max:50'],
            ],
            [
                'email' => [
                    'required' => ':attribute tidak boleh kosong',
                    'unique' => ':attribute sudah terdaftar',
                    'max' => ':attribute maksimal 100 karakter',
                ],
                'password' => [
                    'min' => ':attribute minimal 5 karakter',
                    'max' => ':attribute maksimal 50 karakter',
                ],
            ],
        );
    }
}
