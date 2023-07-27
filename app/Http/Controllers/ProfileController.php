<?php

namespace App\Http\Controllers;

use App\Models\User;

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
                'password' => ['min:5', 'max:50'],
            ],
            [
                'password' => [
                    'min' => ':attribute minimal 5 karakter',
                    'max' => ':attribute maksimal 50 karakter',
                ],
            ],
        );
    }
}
