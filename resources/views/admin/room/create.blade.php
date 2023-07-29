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
            Tambah Data Kamar
        </x-form.title>

        <div class="container d-flex justify-content-center align-items-center">
            <form class="col-4" method="POST" action="{{ route('admin.room.store') }}">
                @csrf

                @if (Session::has('errorss'))
                    <?php
                    error_reporting(0);
                    $s = Session('errorss');
                    $parsedData = json_decode($s, true);
                    ?>

                    @if ($parsedData['room_number'][0])
                        <div class="alert alert-danger"> {{ $parsedData['room_number'][0] }} </div>
                    @endif
                    @if ($parsedData['price'][0])
                        <div class="alert alert-danger"> {{ $parsedData['price'][0] }} </div>
                    @endif

                @endif

                <x-form.wrapper class="mt-4">
                    <x-form.input text="No Kamar" name="room_number" type="number" value="{{ Session('old_room') }}" />
                </x-form.wrapper>

                <x-form.wrapper class="mt-4">
                    <x-form.input text="Harga" name="price" type="number" value="{{ Session('old_price') }}" />
                </x-form.wrapper>

                <x-form.wrapper class="mt-4">

                    <select name="user_id" class="form-select w-100">
                        <x-form.occupant-dropdown />
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
