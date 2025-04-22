@extends('layouts.app')

@section('title', 'Cara Sewa')

@section('content')
    <div class="relative top-0 bg-cover bg-center">
        <div class="flex items-center px-[130px] gap-4 py-4 bg-[#F5FAF3] border border-green-300 text-black">
            <img src="{{ asset('assets/home-2.svg') }}" alt="">
            <a href="{{ url('/') }}" class="text-lg font-medium text-[#333]">Beranda</a>
            <span class="text-lg font-medium text-[#333]">/</span>
            <a href="{{ url('/cara-sewa') }}" class="text-lg font-medium text-[#333]">Cara Sewa</a>
        </div>


        <div class="px-[130px] py-20 flex flex-col gap-[40px] justify-center">
            <div class="flex flex-col gap-[10px] text-center">
                <h2 class="text-3xl text-[#333] font-medium">Informasi dan Petunjuk</h2>
                <h1 class="text-4xl text-[#333] font-semibold">Cara Sewa</h1>
                <p class="text-lg text-[#333] font-normal">Ikuti langkah-langkah berikut untuk menyewa produk kami:</p>
            </div>

            <div class="flex gap-[20px]">
                <a href="{{ url('/cara-sewa') }}"
                    class="bg-[#E29300] text-white py-[8px] px-[25px] rounded-lg hover:bg-green-700 transition">Sewa</a>
                <a href="{{ url('/syarat-ketentuan') }}"
                    class="bg-green-600 text-white py-[8px] px-[25px] rounded-lg hover:bg-green-700 transition">S & K</a>
                <a href="{{ url('/pembayaran') }}"
                    class="bg-green-600 text-white py-[8px] px-[25px] rounded-lg hover:bg-green-700 transition">Pembayaran</a>
                <a href="{{ url('/pengiriman') }}"
                    class="bg-green-600 text-white py-[8px] px-[25px] rounded-lg hover:bg-green-700 transition">Pengiriman</a>
            </div>

            <div class="mt-10">
                <h3 class="text-[20px] font-semibold text-[#333] border-b-2 border-[#333] w-max mb-6">Metode transfer
                    Seabank:</h3>

                <!-- Pemesanan / Booking -->
                <div class="mb-8">
                    <ol class="list-decimal pl-6 space-y-4 text-lg text-[#333]">
                        <li>Setelah checkout, Anda akan menerima bukti pesanan (order received) ke email lengkap dengan
                            nomor Rekening Bank tujuan pembayaran.</li>
                        <li>
                            Rekening Seabank Dewa Camp: <strong>a.n. Miftahul Fajri</strong><br>
                            Bank Mandiri No. Rek: <strong>901798990300</strong>
                        </li>
                        <li>Lakukan pembayaran dengan cara mengirim/mentransfer sesuai dengan tagihan yang tertera.</li>
                        <li>Isi Nomor Order Anda di kolom keterangan transfer.</li>
                        <li>Untuk menghindari biaya transfer antar bank, anda dapat menggunakan aplikasi Flip (bukan sponsor).</li>
                        <li>Selesaikan pembayaran anda sebelum 1×24 jam untuk menghindari pembatalan otomatis.</li>
                        <li>Segera Lakukan konfirmasi dengan mengunggah bukti transfer ke formulir Konfirmasi Pembayaran.</li>
                    </ol>
                </div>

                <!-- Penyewaan -->
                <div>
                    <h4 class="text-[20px] font-semibold text-[#333] mb-4">Penyewaan:</h4>
                    <ol class="list-decimal pl-6 space-y-4 text-lg text-[#333]">
                        <li>Setiap penyewaan harus meninggalkan identitas (KTP / SIM / Kartu Pelajar).</li>
                        <li>Keterlambatan pengembalian akan dikenakan denda sebesar Rp. 5,000/jam.</li>
                        <li>Segala kerusakan / kehilangan ditanggung sepenuhnya oleh penyewa.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
