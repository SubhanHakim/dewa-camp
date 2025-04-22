<nav class="w-full bg-green-700 text-white px-[150px] py-4 z-20">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <a href="{{url('/')}}" class="cursor-pointer">
                <img src="{{ asset('assets/Logo.png') }}" alt="Dewa-camp">
            </a>
        </div>
        <ul class="flex space-x-10">
            <li><a href="{{ url('/') }}" class="hover:underline">Peralatan</a></li>
            <li><a href="{{ url('/cara-sewa') }}" class="hover:underline">Cara Sewa</a></li>
            <li><a href="{{ url('#') }}" class="hover:underline">Tentang Kami</a></li>
        </ul>
        <div>
            <button class="px-4 py-1.5 border border-white rounded-4xl"><a href="{{url('/login')}}">Masuk</a></button>
        </div>
    </div>
</nav>
