<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->route()->getName() == 'dashboard'? 'active': '' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        {{-- hak akses admin --}}
        @if (auth()->user()->isAdmin)
            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getName() == 'admin.users'? 'active': '' }}"
                    href="{{ route('admin.users') }}">
                    <i class="bi bi-grid"></i>
                    <span>Penghuni</span>
                </a>
            </li>
            <!-- End User Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getName() == 'admin.rooms'? 'active': '' }}"
                    href="{{ route('admin.rooms') }}">
                    <i class="bi bi-grid"></i>
                    <span>Kamar</span>
                </a>
            </li>
            <!-- End Kamar Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getName() == 'admin.complaints'? 'active': '' }}"
                    href="{{ route('admin.complaints') }}">
                    <i class="bi bi-grid"></i>
                    <span>Komplain</span>
                </a>
            </li>
            <!-- End Komplain Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getName() == 'admin.invoices'? 'active': '' }}"
                    href="{{ route('admin.invoices') }}">
                    <i class="bi bi-grid"></i>
                    <span>Tagihan</span>
                </a>
            </li>
            <!-- End Komplain Nav -->
        @else

        {{-- hak akses user --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getName() == 'user.complaints'? 'active': '' }}"
                    href="{{ route('user.complaints') }}">
                    <i class="bi bi-grid"></i>
                    <span>Komplain</span>
                </a>
            </li>
            <!-- End Komplain Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getName() == 'user.invoices'? 'active': '' }}"
                    href="{{ route('user.invoices') }}">
                    <i class="bi bi-grid"></i>
                    <span>Tagihan</span>
                </a>
            </li>
            <!-- End Komplain Nav -->
        @endif


        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('profile.edit',['user'=>auth()->id()]) }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>

</aside>
