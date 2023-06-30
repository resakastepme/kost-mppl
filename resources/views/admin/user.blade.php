<x-partials.base titlePage="User">
    <!-- ======= Header ======= -->
    <x-partials.dashboard._header />
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <x-partials.dashboard._sidebar />
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
                                    <h5 class="card-title">User <span>| Today</span></h5>

                                    <x-table.table :headers="['#', 'Customer','Product']">
                                        <tr>
                                            <th scope="row"><a href="#">#2049</a></th>
                                            <td>Ashleigh Langosh</td>
                                            <td>$147</td>
                                        </tr>
                                    </x-table.table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <x-partials._footer />
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

</x-partials.base>
