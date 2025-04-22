@extends('layouts.app')

@section('content')
    <div class="p-6 px-4 sm:px-8 lg:px-[130px]">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-4 py-4 mb-6">
            <img src="{{ asset('assets/home-2.svg') }}" alt="" class="w-6 h-6 sm:w-8 sm:h-8">
            <a href="{{ url('/') }}" class="text-sm sm:text-lg font-medium text-[#333]">Beranda</a>
            <span class="text-sm sm:text-lg font-medium text-[#333]">/</span>
            <a href="{{ url('/dashboard') }}" class="text-sm sm:text-lg font-medium text-[#333]">Cart</a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-white shadow-md rounded-lg">
                        <th class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-left text-sm sm:text-base">Nama Barang</th>
                        <th class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-center text-sm sm:text-base">Harga</th>
                        <th class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-center text-sm sm:text-base">Jumlah</th>
                        <th class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-center text-sm sm:text-base">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="h-4"></td>
                    </tr>
                    @php
                        $total = 0;
                    @endphp

                    @forelse ($cartItems as $item)
                        @php
                            $subtotal = $item->price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr class="bg-white shadow-md rounded-lg">
                            <td class="py-4 px-6 sm:py-[24px] sm:px-[40px] flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $item->item->image) }}" alt="{{ $item->item->name }}"
                                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg shadow-md">
                                <span class="text-gray-700 font-medium text-sm sm:text-base">{{ $item->item->name }}</span>
                            </td>
                            <td class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-center text-sm sm:text-base text-gray-600 font-semibold">
                                Rp. {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-center text-sm sm:text-base">
                                <input type="number" min="1" value="{{ $item->quantity }}"
                                    class="quantity-input border border-gray-300 rounded w-12 sm:w-16 text-center focus:ring-2 focus:ring-red-500"
                                    data-price="{{ $item->price }}" data-subtotal-target="#subtotal-{{ $item->id }}"
                                    data-total-target="#total" data-cart-id="{{ $item->id }}">
                            </td>
                            <td class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-center text-sm sm:text-base text-gray-600 font-semibold"
                                id="subtotal-{{ $item->id }}">
                                Rp. {{ number_format($subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-500 text-sm sm:text-base">Your cart is empty.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Return to Shop -->
        <div class="mt-6 flex justify-between items-center">
            <div class="px-4 py-2 border border-red-500 rounded-lg">
                <a href="/" class="text-red-500 hover:underline text-sm sm:text-base">Return to Shop</a>
            </div>
        </div>

        <!-- Cart Total -->
        <div class="flex justify-end">
            <div class="flex mt-8 border border-black p-6 rounded-lg shadow-md w-full sm:w-[470px] h-auto">
                <div class="flex flex-col justify-between w-full">
                    <h3 class="text-lg sm:text-xl font-bold mb-4">Cart Total</h3>
                    <div class="flex justify-between items-center text-gray-700 font-medium text-sm sm:text-base">
                        <span>SubTotal:</span>
                        <span id="total">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-700 font-medium text-sm sm:text-base">
                        <span>Ongkir :</span>
                        <span>Free</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-700 font-medium text-sm sm:text-base">
                        <span>Total:</span>
                        <span id="total">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout.process') }}"
                        class="block mt-4 text-center bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 text-sm sm:text-base">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity-input');

            quantityInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const price = parseFloat(this.dataset.price);
                    const quantity = parseInt(this.value);
                    const subtotalTarget = document.querySelector(this.dataset.subtotalTarget);
                    const totalTarget = document.querySelector(this.dataset.totalTarget);
                    const cartId = this.dataset.cartId;

                    if (!isNaN(quantity) && quantity > 0) {
                        // Hitung subtotal untuk item ini
                        const subtotal = price * quantity;
                        subtotalTarget.textContent = `Rp. ${subtotal.toLocaleString('id-ID')}`;

                        // Kirim perubahan ke server
                        fetch('{{ route('cart.update') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    cart_id: cartId,
                                    quantity: quantity
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log('Cart updated successfully');
                                } else {
                                    console.error('Failed to update cart');
                                }
                            })
                            .catch(error => console.error('Error:', error));

                        // Hitung total keseluruhan
                        let total = 0;
                        quantityInputs.forEach(input => {
                            const itemPrice = parseFloat(input.dataset.price);
                            const itemQuantity = parseInt(input.value);
                            if (!isNaN(itemQuantity) && itemQuantity > 0) {
                                total += itemPrice * itemQuantity;
                            }
                        });

                        // Update total
                        totalTarget.textContent = `Rp. ${total.toLocaleString('id-ID')}`;
                    }
                });
            });
        });
    </script>
@endsection