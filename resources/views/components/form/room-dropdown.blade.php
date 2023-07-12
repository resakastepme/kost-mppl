@props(['selectedRoom'=> false])

<option selected>Pilih Kamar</option>
    @foreach ($rooms as $room)
        <option value="{{ $room->id }}" {{ $selectedRoom == $room->id ? 'selected' : '' }}>(Kamar {{ $room->room_number }}) - {{ $room->user->name }} </option>
    @endforeach
