<?php

namespace App\View\Components\form;

use Illuminate\View\Component;
use App\Models\Room;

class RoomDropdown extends Component
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
        return view('components.form.room-dropdown',['rooms'=>Room::query()->with(['user'])
        ->where('status', 'Disewa')
        ->oldest('room_number')
        ->get()]
    );
    }
}
