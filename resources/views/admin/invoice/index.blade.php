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
                                        <h5 class="card-title">Tagihan
                                            <span>|
                                                <!-- Button trigger modal -->
                                                <a class="btn btn-primary {{ $invoices->count() == 13 ? 'disabled' : '' }}"
                                                    href="{{ route('admin.invoice.create') }}">
                                                    Tambah
                                                </a>
                                            </span>
                                        </h5>

                                    </div>

                                    @if ($invoices->count())
                                        <x-table.table :headers="[
                                            '#',
                                            'Nomor Kamar',
                                            'Nama Penghuni',
                                            'Total Tagihan',
                                            'Jatuh Tempo',
                                            'Bukti',
                                            'Status',
                                            '',
                                        ]">
                                            @foreach ($invoices as $invoice)
                                                <tr>
                                                    <td class="text-center"> {{ $loop->iteration }} </td>
                                                    <td class="text-center"> {{ $invoice->room->room_number }} </td>
                                                    <td class="text-center"> {{ $invoice->user->name }} </td>
                                                    <td class="text-center"> {{ rupiah($invoice->room->price) }} </td>
                                                    <td class="text-center">
                                                        {{ date('d/m/Y', strtotime($invoice->due_date)) }} </td>
                                                    <td class="text-center">
                                                        @if ($invoice->path)
                                                            <img src="{{ asset('storage/' . $invoice->path) }}"
                                                                height="100%" width="50%" alt="foto ktp">
                                                        @else
                                                            Belum Di upload
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge {{ $invoice->status == 'Sudah Dibayar' ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $invoice->status }}
                                                        </span>
                                                    </td>
                                                    <td class="d-flex gap-3 w-auto ">
                                                        @if ($invoice->status != 'Sudah Dibayar' && $invoice->path == null)
                                                            <a href="{{ route('admin.invoice.edit', ['invoice' => $invoice->id]) }}"
                                                                class="btn btn-success">
                                                                Ubah
                                                            </a>

                                                            <form
                                                                action="{{ route('admin.invoice.destroy', ['invoice' => $invoice->id]) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf

                                                                <x-form.submit-button class="btn-danger">
                                                                    Hapus
                                                                </x-form.submit-button>
                                                            </form>
                                                            @endif

                                                            @if ($invoice->path ?? false)
                                                                <form
                                                                    action="{{ route('admin.invoice.payment_process', ['invoice' => $invoice->id]) }}"
                                                                    method="POST">
                                                                    @method('PATCH')
                                                                    @csrf

                                                                    <x-form.submit-button class="btn-primary {{ $invoice->status === 'Sudah Dibayar' ? 'disabled' : ''}}">
                                                                        Verifikasi
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

        var email = "{{ Session('emailReport') }}";
        var session = " {{ Session('success') }} ";

        console.log(session);
        console.log(email);

    </script>

    <!-- ======= Footer ======= -->
    <x-partial._footer />
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

</x-partial.base>
