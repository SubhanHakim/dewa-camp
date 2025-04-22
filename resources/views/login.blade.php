@extends('layouts.app')

@section('title', 'Login & Register')

@section('content')
    <div class="flex items-center px-[130px] gap-4 py-4 bg-[#F5FAF3] border border-green-300 text-black">
        <img src="{{ asset('assets/home-2.svg') }}" alt="">
        <a href="{{ url('/') }}" class="text-lg font-medium text-[#333]">Beranda</a>
        <span class="text-lg font-medium text-[#333]">/</span>
        <a href="{{ url('/login') }}" class="text-lg font-medium text-[#333]">Masuk</a>
    </div>

    <div class="flex  px-[130px] items-center justify-between min-h-screen">
        <div class="grid w-full grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Form Login -->
            <div class="h-full">
                <h2 class="text-3xl font-semibold mb-4">Login</h2>
                @if (session('error'))
                    <div class="mb-4 text-red-500 text-center">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="flex flex-col justify-between" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="flex flex-col mb-4 gap-4">
                        <label for="email" class="block text-lg font-medium text-black">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-3 bg-white outline-2 outline-[#333]/30  rounded-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            plac required>
                    </div>
                    <div class="flex flex-col mb-4 gap-4">
                        <label for="password" class="block text-lg font-medium text-black">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 bg-white outline-2 outline-[#333]/30  rounded-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>
                    <div>
                        <button type="submit"
                            class="bg-green-500 text-white py-[8px] px-[25px] rounded-lg hover:bg-green-600 transition">Login</button>
                    </div>
                </form>
            </div>

            <!-- Form Register -->
            <div class="h-full">
                <h2 class="text-3xl font-semibold mb-4">Register</h2>
                @if (session('success'))
                    <div class="mb-4 text-green-500 text-center">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="flex flex-col justify-between" action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="flex flex-col mb-4 gap-4">
                        <label for="name" class="block text-lg font-medium text-black">Name</label>
                        <input type="text" id="name" name="name"
                            class="w-full px-4 py-3 bg-white outline-2 outline-[#333]/30  rounded-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>
                    <div class="flex flex-col mb-4 gap-4">
                        <label for="email" class="block text-lg font-medium text-black">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-3 bg-white outline-2 outline-[#333]/30  rounded-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>
                    <div class="flex flex-col mb-4 gap-4">
                        <label for="password"
                        class="block text-lg font-medium text-black">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 bg-white outline-2 outline-[#333]/30  rounded-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>
                    <div class="flex flex-col mb-4 gap-4">
                        <label for="password_confirmation" class="block text-lg font-medium text-black">Confirm
                            Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-3 bg-white outline-2 outline-[#333]/30  rounded-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>
                    <div>
                        <button type="submit"
                            class="bg-green-500 text-white py-[8px] px-[25px] rounded-lg hover:bg-green-600 transition">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
