<x-partial.base titlePage="User">
    <!-- ======= Header ======= -->
    <x-partial.dashboard._header />
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <x-partial.dashboard._sidebar />
    <!-- End Sidebar-->

    <main id="main" class="main">

        <x-form.title>
            Profile
        </x-form.title>

        <div class="container d-flex justify-content-center align-items-center">
            <form class="col-4" method="POST" action="{{ route('profile.update',['user'=> $user->id]) }}" >
                @csrf
                @method('PATCH')

                <x-form.wrapper class="mt-4">
                    <x-form.input name="email" type="email" :value="old('email',$user->email)" disabled/>
                </x-form.wrapper>

                <x-form.wrapper class="mt-4">
                    <x-form.input name="password" type="password" />
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
