<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        return view('admin.room.index', [
            'rooms' => Room::query()->with(['user'])->filter(request(['search']))->oldest('room_number')->get()
        ]);
    }

    public function create()
    {
        return view('admin.room.create');
    }

    public function store()
    {
        $attributes = $this->validate_room();


        if ($attributes['user_id'] ?? false) {
            $attributes['status'] = 'Disewa';
        } else {
            $attributes['status'] = 'Kosong';
        }

        Room::query()->create($attributes);

        return redirect(route('admin.rooms'))->with('success', 'Data berhasil disimpan');
    }

    public function edit(Room $room)
    {
        return view('admin.room.edit', ['room' => $room]);
    }

    public function update(Room $room)
    {
        $attributes = $this->validate_room($room);

        if ($attributes['user_id'] ?? false) {
            $attributes['status'] = 'Disewa';
        } else {
            $attributes['status'] = 'Kosong';
        }

        $room->update($attributes);

        return redirect(route('admin.rooms'))->with('success', 'Data berhasil diedit');
    }

    public function destroy(Room $room)
    {

        $room->delete();

        return back()->with('success', 'Data terhapus');
    }

    public function clear_the_room(Room $room)
    {

        $attributes['user_id'] = null;
        $attributes['status'] = 'Kosong';

        $room->update($attributes);

        return redirect(route('admin.rooms'))->with('success', 'Data berhasil diedit');
    }

    protected function validate_room(?Room $room = null): array
    {
        $room ??= new Room();

        return request()->validate(
            [
                'room_number' => ['required'],
                'price' => ['required'],
                'user_id' => ['required'],
            ],
            [
                'room_number' => [
                    'required' => ':attribute tidak boleh kosong',
                ],
                'price' => [
                    'required' => ':attribute tidak boleh kosong',
                ],
            ],
            [
                'room_number' => 'No Ruangan',
                'price' => 'Harga Kamar',
                'user_id' => 'Penghuni',
            ]
        );
    }
}
