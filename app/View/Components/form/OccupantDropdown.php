<?php

namespace App\View\Components\form;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class OccupantDropdown extends Component
{

    public $isEdit;
    public $roomId;

    public function __construct($isEdit = false, $roomId = null)
    {
        $this->isEdit = $isEdit;
        $this->roomId = $roomId;
    }

    public function getUser()
    {
        if ($this->isEdit) {
            if ($this->roomId ?? false) {
                return User::where(function ($query) {
                    $query->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('rooms')
                            ->whereRaw('users.id = rooms.user_id');
                    })->orWhereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('rooms')
                            ->whereRaw('users.id = rooms.user_id')
                            ->where('rooms.id', $this->roomId);
                    });
                })->where('isAdmin', false)->get();
            }
        } else {
            return User::whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('rooms')
                    ->whereRaw('users.id = rooms.user_id');
            })->where('isAdmin', false)->get();
        }
    }

    public function render()
    {
        return view('components.form.occupant-dropdown', [
            'users' => $this->getUser()
        ]);
    }
}
