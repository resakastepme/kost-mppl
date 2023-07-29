@props(['selectedUser'=> false])

@if ($users->count())
<option value="" selected>Pilih Penghuni</option>
    @foreach ($users as $user)
        <option value="{{ $user->id }}" {{ $selectedUser == $user->id ? 'selected' : '' }}>{{ $user->name }} </option>
    @endforeach
@else
    <option  disabled selected>Semua User Sudah Mendapat Kamar</option>
@endif
