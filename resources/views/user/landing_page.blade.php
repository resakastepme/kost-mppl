@props(['titlePage'])

<x-partials.base titlePage="Dago">
    <x-partials.landing_page._header />

    <!-- content -->
    <div id="content-dashboard">
        <div class="left-side-dashboard">
            <h1 class="dashboard-title">Temukan Kamar Impianmu Disini!</h1>
            <p class="dashboard-subtext">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim rem est
                exercitationem ut sed molestiae ipsum voluptates rerum corporis
                facere. Fuga numquam ipsum voluptas ex accusamus ratione soluta id
                vel.
            </p>
            <a href="#content-prices" id="button-prices">Lihat Harga</a>
        </div>
        <div class="right-side-dashboard">
            <img id="kost-building" src="{{ asset('storage/images/kost.png') }}" alt="gedung kost" />
        </div>
    </div>
    <div id="content-prices">
        <div id="prices-title">HARGA SEWA KAMAR</div>
        <div id="room-list">
            <div class="room-one">
                <span class="icons">
                    <img src="https://img.icons8.com/ios/50/null/bedroom-interior.png" />
                </span>
                <p class="price">IDR 1.400.000</p>
                <div class="divider"></div>
                <ul class="facilities">
                    <li>Kamar mandi dalam</li>
                    <li>Wifi</li>
                    <li>Kasur + sprai</li>
                    <li>Lemari</li>
                    <li>Meja kecil</li>
                </ul>
            </div>
            <div class="room-two">
                <span class="icons">
                    <img src="https://img.icons8.com/ios/50/null/bed.png" />
                </span>
                <p class="price">IDR 850.000</p>
                <div class="divider"></div>
                <ul class="facilities">
                    <li>Wifi</li>
                    <li>Kasur + sprai</li>
                    <li>Lemari</li>
                    <li>Meja kecil</li>
                </ul>
            </div>
            <div class="room-three">
                <span class="icons">
                    <img src="https://img.icons8.com/ios/50/null/single-bed.png" />
                </span>
                <p class="price">IDR 800.000</p>
                <div class="divider"></div>
                <ul class="facilities">
                    <li>Wifi</li>
                    <li>Kasur + sprai</li>
                    <li>Lemari</li>
                    <li>Meja kecil</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="content-about">
        <div id="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d277.88784009168234!2d107.62060928860276!3d-6.876284241253767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7c5e8bcef05%3A0x5b55fecce97401a2!2sKosan%20Lia!5e0!3m2!1sen!2sid!4v1683075861786!5m2!1sen!2sid"
                style="border: 0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="info">
            <h1>Kost Dago Timur (Kosan Lia)</h1>
            <br />
            <h3>Alamat</h3>
            <p>
                Jl. Dago Timur No.20B, Dago, Kecamatan Coblong, Kota Bandung, Jawa
                Barat 40135
            </p>
            <br />
        </div>
    </div>

    <x-partials._footer />
</x-partials.base>
