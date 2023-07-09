{{ $users->count() }}

@if ($users->count())
<option selected>Pilih Penghuni</option>
    @foreach ($users as $user)
        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
    @endforeach
@else
    <option  disabled selected>Semua User Sudah Mendapat Kamar</option>
@endif
