@extends('layouts.app')

@section('title', $item->name)

@section('content')
    <div class="container mx-auto px-4 sm:px-8 lg:px-[130px] py-10 sm:py-16 lg:py-[100px]">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div
                class="w-full h-[300px] sm:h-[400px] lg:h-[454px] overflow-hidden rounded-lg shadow-lg bg-cover bg-center flex items-center justify-center">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#333]">{{ $item->name }}</h1>
                <p class="text-xl sm:text-2xl font-bold text-green-600 mt-4">Rp. {{ number_format($item->price_per_day, 0, ',', '.') }}</p>
                <p class="text-base sm:text-lg text-gray-600 mt-4">Fungsi : {{ $item->fungsi }}</p>
                <p class="text-base sm:text-lg text-gray-600 mt-4">Deskripsi : {{ $item->description }}</p>
                <p class="text-sm sm:text-base text-gray-500 mt-2">Stok : {{ $item->stock }}</p>

                <div class="mt-6">
                    @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="start_date" class="block text-base sm:text-lg font-semibold text-[#333]">Tanggal Mulai</label>
                                <input type="date" id="start_date" name="start_date" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                            </div>

                            <div>
                                <label for="end_date" class="block text-base sm:text-lg font-semibold text-[#333]">Tanggal Selesai</label>
                                <input type="date" id="end_date" name="end_date" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                            </div>
                            <div>
                                <label for="quantity" class="block text-base sm:text-lg font-semibold text-[#333]">Jumlah Barang</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="{{ $item->stock }}" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                            </div>

                            <input type="hidden" name="item_id" value="{{ $item->id }}">

                            <button type="submit"
                                class="bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition w-full">
                                Tambah ke Cart
                            </button>
                        </form>
                    @else
                        <p class="text-red-600 font-semibold mt-4">Silakan <a href="{{ route('login') }}"
                                class="text-green-600 underline">login</a> untuk melakukan booking.</p>
                    @endauth

                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <div class="mt-10">
                    <h3 class="text-lg sm:text-xl font-semibold text-[#333] border-b-2 border-[#333] w-max mb-6">Perhatian:</h3>

                    <div class="mb-8">
                        <ul class="list-disc pl-6 space-y-4 text-base sm:text-lg text-[#333]">
                            <li>Pemesanan/booking harus menyertakan DP terlebih dahulu.</li>
                            <li>Perubahan/pengurangan hanya bisa dilakukan paling lambat 1 hari sebelum pengambilan.</li>
                            <li>Setiap penyewaan harus meninggalkan identitas (KTP/SIM/Kartu pelajar).</li>
                            <li>Keterlambatan pengembalian akan dikenakan denda sebesar Rp 5,000/jam.</li>
                            <li>Kerusakan pada saat penyewaan menjadi tanggung jawab pelanggan.</li>
                            <li>Menyewa berarti SETUJU.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection