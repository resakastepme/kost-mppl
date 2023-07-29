<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $r)
    {
        // $attributes = $this->validate_room();

        // if ($attributes['user_id'] ?? false) {
        //     $attributes['status'] = 'Disewa';
        // } else {
        //     $attributes['status'] = 'Kosong';
        // }

        // Room::query()->create($attributes);

        // return redirect(route('admin.rooms'))->with('success', 'Data berhasil disimpan');

        $rules = [
            'room_number' => 'required',
            'price' => 'required'
        ];
        $text = [
            'room_number' => 'No Kamar tidak boleh kosong!',
            'price' => 'Harga tidak boleh kosong!'
        ];
        $validate = Validator::make($r->all(), $rules, $text);
        if($validate->fails()){
            return back()->with('errorss', $validate->errors())
                         ->with('old_room', $r->room_number)
                         ->with('old_price', $r->price);
                         exit();
        }

        if($r->user_id == ""){
            $data = array_merge($r->all(), [
                'status' => 'Kosong'
            ]);
        }elseif(!$r->user_id == ""){
            $data = array_merge($r->all(), [
                'status' => 'Disewa'
            ]);
        }

        $db = Room::create($data);
        if($db){
            return redirect(route('admin.rooms'))->with('success', 'Data berhasil disimpan');
        }else{
            return redirect(route('admin.rooms'))->with('error', 'Data gagal disimpan');
        }

    }

    public function edit(Room $room)
    {
        return view('admin.room.edit', ['room' => $room]);
    }

    public function update(Room $room)
    {
        $attributes = $this->validate_room($room);

        if (!$attributes['user_id'] == "") {
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
                'user_id' => [],
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
