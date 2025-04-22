@extends('layouts.app')

@section('content')
<div class="container mx-auto px-[130px] py-8">
    <h1 class="text-2xl font-bold mb-6">Transaction History</h1>

    @if($transactions->isEmpty())
        <p class="text-gray-500">No successful transactions found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr class="bg-white shadow-md rounded-lg">
                        <th class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-left text-sm sm:text-base">#</th>
                        <th class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-left text-sm sm:text-base">Order ID</th>
                        <th class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-left text-sm sm:text-base">Total</th>
                        <th class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-left text-sm sm:text-base">Status</th>
                        <th class="py-4 px-6 sm:py-[24px] sm:px-[40px] text-left text-sm sm:text-base">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="h-4"></td>
                    </tr>

                    @foreach($transactions as $transaction)
                        <tr class="bg-white shadow-md rounded-lg">
                            <td class="py-4 px-6 sm:py-[24px] sm:px-[40px]">{{ $loop->iteration }}</td>
                            <td class="py-4 px-6 sm:py-[24px] sm:px-[40px]">{{ $transaction->order_id }}</td>
                            <td class="py-4 px-6 sm:py-[24px] sm:px-[40px]">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 sm:py-[24px] sm:px-[40px]">
                                <span class="text-green-600 font-semibold">Success</span>
                            </td>
                            <td class="py-4 px-6 sm:py-[24px] sm:px-[40px]">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection