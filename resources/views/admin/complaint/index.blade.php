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
                                        <h5 class="card-title">Komplain
                                        </h5>
                                    </div>

                                    @if ($complaints->count())
                                        <x-table.table :headers="['No', 'Komplain','Dikomplain Oleh', 'Tanggal Komplain', 'Status', '']">
                                            @foreach ($complaints as $complaint)
                                                <tr>
                                                    <th class="w-auto" scope="row">#{{ $loop->iteration }}</th>
                                                    <td class="w-50 ">{{ $complaint->complain }}</td>
                                                    <td class="w-25 ">{{ $complaint->user->name }}</td>
                                                    <td class="w-auto text-center">{{ date('d/m/Y',strtotime($complaint->date_reported)) }}</td>
                                                    <td class="w-auto text-center">
                                                        <span
                                                            class="badge {{ $complaint->status == 'Belum Diproses' ? 'bg-danger' : ($complaint->status == 'Diproses' ? 'bg-warning' : 'bg-success') }}">
                                                            {{ $complaint->status }}
                                                        </span>
                                                    </td>
                                                    <td class="d-flex gap-3 w-auto ">
                                                        @if ($complaint->status == "Belum Diproses")
                                                        <form
                                                        action="{{ route('admin.complaint.process', ['complaint' => $complaint->id]) }}"
                                                        method="POST">
                                                        @method('PATCH')
                                                        @csrf

                                                        <x-form.submit-button class="btn-warning">
                                                            Proses
                                                        </x-form.submit-button>
                                                    </form>
                                                            
                                                        @endif

                                                        @if ($complaint->status == "Diproses")
                                                    <form
                                                            action="{{ route('admin.complaint.finished', ['complaint' => $complaint->id]) }}"
                                                            method="POST">
                                                            @method('PATCH')
                                                            @csrf

                                                            <x-form.submit-button class="btn-success">
                                                                Selesai
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
