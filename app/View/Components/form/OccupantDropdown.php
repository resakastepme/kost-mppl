<?php

namespace App\View\Components\form;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class OccupantDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.occupant-dropdown', [
            'users' => User::whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('rooms')
                    ->whereRaw('users.id = rooms.user_id');
            })->where('isAdmin', false)->get()
        ]);
    }
}
