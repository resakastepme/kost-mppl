<x-partial.base titlePage="Change Password">

    <main>
        <section
            class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">
                            <div class="card-body">

                                @if (Session::has('not_same'))
                                    <div class="alert alert-danger"> {{ Session('not_same') }} </div>
                                @endif

                                <h3> Hai, {{ $name }}! </h3>
                                <hr>

                                <form action="{{ url('/change-password/proccess') }}" class="row g-3" method="POST">
                                    @csrf
                                    <x-form.wrapper>
                                        <x-form.input name="password" id="password" type="password" placeholder="Masukan password baru" value="  "/>
                                    </x-form.wrapper>
                                    <input type="hidden" name="hidden" value="{{ $name }}">

                                    <x-form.wrapper>
                                        <x-form.submit-button class="btn-primary w-100" id="submit">
                                            Submit
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
