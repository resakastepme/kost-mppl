<x-partial.base titlePage="Login">

    <main>
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        @if (session()->has('failed'))
                            <div class="messages alert alert-danger mb-3 w-100 text-center">
                                <p>{{ session('failed') }}</p>
                            </div>
                        @endif
                        <div class="card mb-3">
                            <div class="card-body">

                                @if (Session::has('success_recovery'))
                                    <div class="alert alert-success"> {{ Session('success_recovery') }} </div>
                                @elseif (Session::has('failed_recovery'))
                                    <div class="alert alert-danger"> {{ Session('failed_recovery') }} </div>
                                @elseif (Session::has('success_change'))
                                    <div class="alert alert-success"> {{ Session('success_change') }} </div>
                                @elseif (Session::has('failed_change'))
                                    <div class="alert alert-danger"> {{ Session('failed_change') }} </div>
                                @endif


                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                                </div>

                                <form action="{{ route('login.post') }}" class="row g-3" method="POST">
                                    @csrf
                                    <x-form.wrapper>
                                        <x-form.input name="email" id="email" type="email" />
                                    </x-form.wrapper>

                                    <x-form.wrapper>
                                        <x-form.input name="password" id="password" type="password" />
                                    </x-form.wrapper>
                                    <small class="ms-2">
                                        <a href=" {{ url('/recovery-request') }} "> Lupa password?</a>
                                    </small>

                                    <x-form.wrapper>
                                        <x-form.submit-button class="btn-primary w-100">
                                            Login
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
