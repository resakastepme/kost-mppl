<x-partial.base titlePage="User">
    <!-- ======= Header ======= -->
    <x-partial.dashboard._header />
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <x-partial.dashboard._sidebar />
    <!-- End Sidebar-->

    <main id="main" class="main">

        <a href="{{ route('admin.invoices') }}" class="btn btn-warning text-white">
            Back
        </a>

        <x-form.title>
            Ubah Data Tagihan
        </x-form.title>

        <div class="container d-flex justify-content-center align-items-center">
            <form class="col-4" method="POST" action="{{ route('admin.invoice.update', ['invoice' => $invoice->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- <x-form.wrapper class="mt-4">
                    <x-form.input text="Jatuh Tempo" name="due_date" type="date" :value="old('due_date', $invoice->due_date)" />
                </x-form.wrapper> --}}

                <x-form.wrapper class="mt-4">
                    <select name="room_id" class="form-select w-100">
                        <x-form.room-dropdown/>
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
