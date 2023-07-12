<?php

namespace App\View\Components\form;

use Illuminate\View\Component;
use App\Models\Room;

class RoomDropdown extends Component
{
    public function __construct()
    {
        //
    }

    public function getRoom()
    {
        return Room::query()->with(['user'])
            ->where('status', 'Disewa')
            ->oldest('room_number')
            ->get();
    }

    public function render()
    {
        return view('components.form.room-dropdown', [
            'rooms' => $this->getRoom()
        ]);
    }
}
