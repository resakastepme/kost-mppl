<x-partial.base titlePage="Recovery">

    <main>
        <section
            class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">
                            <div class="card-body">
                                {{-- <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                                </div> --}}

                                @if(Session::has('error'))

                                <div class="alert alert-danger"> {{ Session('error') }} </div>

                                @endif

                                <form action="{{ route('recovery.store') }}" class="row g-3" method="POST">
                                    @csrf
                                    <x-form.wrapper>
                                        <x-form.input name="email" id="email" type="email" placeholder="Masukan email anda.."/>
                                    </x-form.wrapper>

                                    <x-form.wrapper>
                                        <x-form.submit-button class="btn-primary w-100">
                                            Send Recovery Code
                                        </x-form.submit-button>
                                    </x-form.wrapper>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-partial.base>
