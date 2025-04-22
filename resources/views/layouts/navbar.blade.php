<nav class="absolute top-0 left-0 w-full bg-transparent text-white px-4 sm:px-8 lg:px-[150px] py-4 z-20">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div>
            <a href="{{ url('/') }}" class="cursor-pointer">
                <img src="{{ asset('assets/Logo.png') }}" alt="Dewa-camp" class="h-8 sm:h-10">
            </a>
        </div>

        <!-- Hamburger Menu (Mobile) -->
        <div class="lg:hidden">
            <button id="menu-toggle" class="focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Menu Links -->
        <ul id="menu" class="hidden lg:flex space-x-10">
            <li><a href="{{ url('/') }}" class="hover:underline">Peralatan</a></li>
            <li><a href="{{ url('/cara-sewa') }}" class="hover:underline">cara Sewa</a></li>
            <li><a href="{{ url('/orders') }}" class="hover:underline">Bantuan</a></li>
            <li><a href="{{ url('/categories') }}" class="hover:underline">Tentang Kami</a></li>
            @auth
                <li><a href="{{ url('/dashboard') }}" class="hover:underline">Cart</a></li>
                <li><a href="{{ url('/transaction-history') }}" class="hover:underline">History</a></li>
            @endauth
        </ul>

        <!-- Login or User Name -->
        <div class="hidden lg:block">
            @auth
                <div class="flex items-center space-x-4">
                    <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-1.5 border border-white rounded-4xl hover:bg-white hover:text-black transition">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <button class="px-4 py-1.5 border border-white rounded-4xl">
                    <a href="{{ url('/login') }}">Masuk</a>
                </button>
            @endauth
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden mt-4 transition-all duration-500 ease-in-out transform -translate-y-full opacity-0">
        <ul class="flex flex-col space-y-4 text-center">
            <li><a href="{{ url('/') }}" class="hover:underline">Peralatan</a></li>
            <li><a href="{{ url('/cara-sewa') }}" class="hover:underline">cara Sewa</a></li>
            <li><a href="{{ url('#') }}" class="hover:underline">Tentang Kami</a></li>
            @auth
                <li><a href="{{ url('/dashboard') }}" class="hover:underline">Cart</a></li>
                <li><a href="{{ url('/transaction-history') }}" class="hover:underline">History</a></li>
                <li>
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-1.5 border border-white rounded-4xl hover:bg-white hover:text-black transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            @else
                <li>
                    <button class="px-4 py-1.5 border border-white rounded-4xl">
                        <a href="{{ url('/login') }}">Masuk</a>
                    </button>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
        // Toggle visibility and animation
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => {
                mobileMenu.classList.remove('-translate-y-full', 'opacity-0');
                mobileMenu.classList.add('translate-y-0', 'opacity-100');
            }, 10); // Small delay to ensure animation runs
        } else {
            mobileMenu.classList.remove('translate-y-0', 'opacity-100');
            mobileMenu.classList.add('-translate-y-full', 'opacity-0');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 500); // Match the duration of the animation
        }
    });
</script>