@if (session()->has('success'))
    <div class="messages position-fixed bg-primary text-white py-2 px-4 rounded top-3 start-3 text-sm mx-auto">
        <p>{{ session('success') }}</p>
    </div>
@endif
