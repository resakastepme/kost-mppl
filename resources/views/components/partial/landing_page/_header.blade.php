 <!-- navbar -->
 <nav class="navbar-user">
     <p id="brand-name">Kost Dago Timur</p>
     <div class="center-side-navbar">
         <a href="#content-dashboard">Dashboard</a>
         <a href="#content-prices">Prices</a>
         <a href="#content-about">About</a>
     </div>
     <div class="right-side-navbar">
        {{-- jika user sudah login --}}
        @auth
            <a id="redirect-dashboard-button" href="{{ route('dashboard') }}">Dashboard</a>
        @endauth

        {{-- jika user belum login --}}
        @guest
        <a href="{{ route('login') }}" id="login-button">Login</a>
        @endguest
     </div>
 </nav>
 <!-- sidebar for mobile and tablet -->
 <div class="header-mobile">
     <span style="font-size: 30px; cursor: pointer" id="openSideNav">&#9776;
     </span>
     <p id="brand-name">Kost Dago Timur</p>
 </div>
 <div id="mySidenav" class="sidenav">
     <a href="#" class="closebtn closeSideNav">&times;</a>
     <a href="#content-dashboard" class="closeSideNav">Dashboard</a>
     <a href="#content-prices" class="closeSideNav">Prices</a>
     <a href="#content-about" class="closeSideNav">About</a>
     <a href="{{ route('login') }}">Login</a>
 </div>
