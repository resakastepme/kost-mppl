<x-partial.base titlePage="User">
    <!-- ======= Header ======= -->
    <x-partial.dashboard._header />
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <x-partial.dashboard._sidebar />
    <!-- End Sidebar-->

    <main id="main" class="main">

        <a href="{{ route('user.invoices') }}" class="btn btn-warning text-white">
            Back
        </a>

        <x-form.title>
            {{ $invoice->path ?? false ? 'Ubah Bukti' : 'Upload Bukti'}}
        </x-form.title>

        <div class="container d-flex justify-content-center align-items-center">
            <form class="col-4" method="POST" action="{{ route('user.invoice.update', ['invoice' => $invoice->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <x-form.wrapper class="mt-4">
                    <x-form.input text="Upload Bukti Pembayaran" name="path" type="file" accept="image/*" />
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
