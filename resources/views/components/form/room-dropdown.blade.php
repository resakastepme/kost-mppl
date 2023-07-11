<option selected>Pilih Kamar</option>
    @foreach ($rooms as $room)
        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->room_number }} - {{ $room->user->name }} </option>
    @endforeach
