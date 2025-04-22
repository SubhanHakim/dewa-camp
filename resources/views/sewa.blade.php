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
                <h2 class="text-3xl font-[#333] font-medium">Informasi dan Petunjuk</h2>
                <h1 class="text-4xl font-[#333] font-semibold">Cara Sewa</h1>
                <p class="text-lg font-[#333] font-normal">Ikuti langkah-langkah berikut untuk menyewa produk kami:</p>
            </div>
            <div class="flex gap-[20px]">
                <div>
                    <button type="submit"
                        class="bg-[#E29300] text-white py-[8px] px-[25px] rounded-lg hover:bg-green-700 transition"><a href="{{ url('/cara-sewa') }}">Sewa</a></button>
                </div>
                <div>
                    <button type="submit"
                        class="bg-green-600 text-white py-[8px] px-[25px] rounded-lg hover:bg-green-700 transition"><a href="{{ url('/syarat-ketentuan') }}">S & K</a></button>
                </div>
                <div>
                    <button type="submit"
                        class="bg-green-600 text-white py-[8px] px-[25px] rounded-lg hover:bg-green-700 transition"><a href="{{url('/pembayaran')}}">Pembayaran</a></button>
                </div>
                <div>
                    <button type="submit"
                        class="bg-green-600 text-white py-[8px] px-[25px] rounded-lg hover:bg-green-700 transition"><a href="{{url('/pengiriman')}}">Pengiriman</a></button>
                </div>
            </div>

            <div class="text-[20px] font-semibold text-[#333] border-b-2 border-[#333] w-[110px] ">
                Cara Sewa :
            </div>

            <div class="text-lg text-[#333] leading-relaxed">
                <ol class="list-decimal pl-6 space-y-4">
                    <li>Silahkan Login di <strong>My Account</strong>, atau registrasi akun dengan mengisi lengkap data diri Anda.</li>
                    <li>Buka halaman <strong>Sewa</strong> atau <strong>Paket Camping</strong> dan pilih produk-produk yang akan Anda sewa.</li>
                    <li>Tekan pada gambar produk sewa untuk melihat detail dan ketersediaan.</li>
                    <li>Untuk booking:
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Pilih tanggal kapan Anda memulai sewa.</li>
                            <li>Pilih tanggal kapan Anda selesai menyewa.</li>
                            <li>Apabila tersedia, Anda bisa menyewa lebih dari satu produk.</li>
                        </ul>
                    </li>
                    <li>Anda dapat melihat durasi penyewaan dan total biaya sewa.</li>
                    <li>Tekan tombol <strong>“Book Now”</strong> untuk memasukkan ke dalam keranjang belanja (Cart) Anda.</li>
                    <li>Lihat <strong>keranjang belanja</strong> apabila sudah selesai, atau Anda bisa langsung <strong>checkout</strong>.</li>
                    <li>Masukkan kupon yang Anda miliki untuk mendapatkan potongan harga.</li>
                    <li>Untuk produk sewa tidak ada pilihan pengiriman dan produk tidak dikirim ke alamat Anda.</li>
                    <li>Namun jika Anda sekaligus membeli produk, maka pemilihan pengiriman dan proses checkout mengikuti <strong>cara membeli produk</strong>.</li>
                    <li>Pilih metode pembayaran.</li>
                    <li>Tekan tombol <strong>“Place Order”</strong>.</li>
                    <li>Anda akan menerima bukti pesanan (order received) ke email Anda.</li>
                    <li>Segera selesaikan pembayaran Anda.</li>
                    <li>Pastikan status pembayaran sudah berhasil di <strong>My Account</strong> bagian <strong>Orders</strong> dan status sewa (booking) sudah terkonfirmasi di bagian <strong>Booking</strong>.</li>
                    <li>Atau konfirmasi melalui kontak <strong>WhatsApp</strong> kami.</li>
                    <li>Silahkan ambil dan kembalikan produk sewa di <strong>Basecamp Sibayak Adventure</strong> sesuai jadwal booking Anda pada jam pengambilan/pengembalian alat (check-in – check-out).</li>
                    <li>Keterlambatan pengembalian akan dianggap penambahan waktu sewa yang dikenakan biaya per hari sesuai harga reguler produk sewa.</li>
                    <li>Kerusakan/kehilangan pada saat penyewaan menjadi tanggung jawab pelanggan. Kami berhak meminta biaya ganti rugi kehilangan dan/atau kerusakan sesuai dengan tingkat keparahannya.</li>
                    <li>Pergunakan semestinya dan jagalah produk yang Anda sewa demi kenyamanan kita bersama.</li>
                </ol>
            </div>
        </div>
    </div>
@endsection