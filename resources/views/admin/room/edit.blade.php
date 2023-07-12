<x-partial.base titlePage="User">
    <!-- ======= Header ======= -->
    <x-partial.dashboard._header />
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <x-partial.dashboard._sidebar />
    <!-- End Sidebar-->

    <main id="main" class="main">

        <a href="{{ route('admin.rooms') }}" class="btn btn-warning text-white">
            Back
        </a>

        <x-form.title>
            Ubah Data Kamar
        </x-form.title>

        <div class="container d-flex justify-content-center align-items-center">
            <form class="col-4" method="POST" action="{{ route('admin.room.update', ['room' => $room->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <x-form.wrapper class="mt-4">
                    <x-form.input text="No Kamar" name="room_number" type="number" :value="old('room_number', $room->room_number)" readonly />
                </x-form.wrapper>

                <x-form.wrapper class="mt-4">
                    <x-form.input text="Harga" name="price" type="number" :value="old('price', $room->price)" />
                </x-form.wrapper>

                <x-form.wrapper class="mt-4">
                    <select name="user_id" class="form-select w-100">
                        <x-form.occupant-dropdown :isEdit="true" :roomId="$room->id" :selectedUser="$room->user_id"/>
                    </select>
                </x-form.wrapper>
                <x-form.wrapper class="mt-4">
                    <x-form.submit-button class="btn-primary col-12">Submit</x-form.submit-button>
                </x-form.wrapper>

            </form>
        </div>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <x-partial._footer />
    <!-- End Footer -->

</x-partial.base>
