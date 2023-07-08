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
                                        <h5 class="card-title">User
                                            <span>|
                                                <!-- Button trigger modal -->
                                                <a class="btn btn-primary" href="{{ route('admin.user.create') }}">
                                                    Tambah
                                                </a>
                                            </span>
                                        </h5>

                                        <x-form.search :action="route('admin.users')" />
                                    </div>

                                    @if ($users->count())
                                        <x-table.table :headers="['#', 'Nama', 'KTP', '']">
                                            @foreach ($users as $user)
                                                <tr>
                                                    <th class="w-auto" scope="row">#{{ $loop->iteration }}</th>
                                                    <td class="w-50">{{ $user->name }}</td>
                                                    <td class="w-25">
                                                        <img src="{{ asset('storage/'.$user->ktp) }}" height="100%" width="50%" alt="foto ktp">
                                                    </td>
                                                    <td class="d-flex gap-3 w-auto">
                                                        <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}"
                                                            class="btn btn-success">
                                                            Ubah
                                                        </a>

                                                        @if ($user->isAdmin)
                                                        @else
                                                            <form
                                                                action="{{ route('admin.user.destroy', ['user' => $user->id]) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf

                                                                <x-form.submit-button class="btn-danger">Hapus
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

    <!-- ======= Footer ======= -->
    <x-partial._footer />
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

</x-partial.base>
