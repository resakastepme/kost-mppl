<x-partial.base titlePage="User">
    <!-- ======= Header ======= -->
    <x-partial.dashboard._header />
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <x-partial.dashboard._sidebar />
    <!-- End Sidebar-->

    <main id="main" class="main">

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <!-- user table -->
                        <div class="col-12 ">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">

                                    <div class="d-lg-flex justify-content-lg-between">
                                        <h5 class="card-title">Kamar
                                            <span>|
                                                <!-- Button trigger modal -->
                                                <a class="btn btn-primary {{ $rooms->count() == 13 ? 'disabled' : ''}}" href="{{ route('admin.room.create') }}">
                                                    Tambah
                                                </a>
                                            </span>
                                        </h5>

                                        <x-form.search :action="route('admin.rooms')" />
                                    </div>

                                    @if ($rooms->count())
                                        <x-table.table :headers="['No Kamar', 'Nama Penghuni', 'Harga', 'Status', '']">
                                            @foreach ($rooms as $room)
                                                <tr>
                                                    <th class="w-auto" scope="row">#{{ $room->room_number }}</th>
                                                    <td class="w-50 ">{{ $room->user->name ?? '-' }}</td>
                                                    <td class="w-25 ">{{ rupiah($room->price) }}</td>
                                                    <td class="w-25 text-center">
                                                        <span
                                                            class="badge {{ $room->status == 'Disewa' ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $room->status }}
                                                        </span>
                                                    </td>
                                                    <td class="d-flex gap-3 w-auto ">
                                                        <a href="{{ route('admin.room.edit', ['room' => $room->id]) }}"
                                                            class="btn btn-success">
                                                            Ubah
                                                        </a>

                                                        <form
                                                            action="{{ route('admin.room.destroy', ['room' => $room->id]) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf

                                                            <x-form.submit-button class="btn-danger">
                                                                Hapus
                                                            </x-form.submit-button>
                                                        </form>

                                                        @if ($room->user_id ?? false)
                                                        <form
                                                            action="{{ route('admin.room.clear', ['room' => $room->id]) }}"
                                                            method="POST">
                                                            @method('PATCH')
                                                            @csrf

                                                            <x-form.submit-button class="btn-warning">
                                                                Kosongkan
                                                            </x-form.submit-button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </x-table.table>
                                    @else
                                        <p class="text-center">Tidak ada Data</p>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

    <script type="text/javascript">
        var success = "{{ Session('success') }}";
        var error = "{{ Session('error') }}";

        console.log(success);
        console.log(error);
    </script>

    <!-- ======= Footer ======= -->
    <x-partial._footer />
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

</x-partial.base>
