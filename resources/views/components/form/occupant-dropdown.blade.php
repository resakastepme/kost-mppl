@props(['selectedUser'=> false])

@if ($users->count())
<option selected>Pilih Penghuni</option>
    @foreach ($users as $user)
        <option value="{{ $user->id }}" {{ $selectedUser == $user->id ? 'selected' : '' }}>{{ $user->name }} {{$selectedUser == $user->id}} </option>
    @endforeach
@else
    <option  disabled selected>Semua User Sudah Mendapat Kamar</option>
@endif
