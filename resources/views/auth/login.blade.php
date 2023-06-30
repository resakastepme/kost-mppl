<x-partials.base titlePage="Login">

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                                    </div>

                                    <form action="{{ route('login.post') }}" class="row g-3" method="POST">
                                        @csrf
                                        <x-forms.wrapper>
                                            <x-forms.input name="email" id="email" type="email"/>
                                        </x-forms.wrapper>

                                        <x-forms.wrapper>
                                            <x-forms.input name="password" id="password" type="password" />
                                        </x-forms.wrapper>

                                        <x-forms.wrapper>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </x-forms.wrapper>

                                        <x-forms.wrapper>
                                            <x-forms.submit-button class="btn-primary w-100">
                                                Login
                                            </x-forms.submit-button>
                                        </x-forms.wrapper>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-partials.base>
