<div class="container mx-auto px-4 sm:px-8 lg:px-[130px] py-10 sm:py-16 lg:py-[100px]">
    <!-- Garis Hijau -->
    <div class="w-full h-1 bg-green-600 rounded-full"></div>

    <!-- Judul -->
    <div class="mt-10 mb-5 text-center">
        <div class="font-semibold text-lg sm:text-xl lg:text-2xl uppercase">
            Klik PADA Gambar Untuk Booking Secara Online
        </div>

        <!-- Grid Responsif -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
            @foreach ($items as $item)
                <a href="{{ route('product.detail', $item->id) }}">
                    <div class="relative overflow-hidden group">
                        <!-- Gambar Produk -->
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                            class="w-full h-auto rounded-lg transform transition-transform duration-500 group-hover:scale-110">
                        
                        <!-- Overlay Informasi -->
                        <div
                            class="absolute bottom-0 left-0 w-full h-1/2 flex flex-col items-center justify-center text-white bg-black opacity-80 rounded-b-lg">
                            <h2 class="text-lg sm:text-xl lg:text-2xl font-bold">{{ $item->name }}</h2>
                            <h2 class="text-sm sm:text-base lg:text-lg">Rp. {{ number_format($item->price_per_day, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>