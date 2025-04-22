@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Transaction History</h1>

    @if($transactions->isEmpty())
        <p class="text-gray-500">No successful transactions found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Order ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Total</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $transaction->order_id }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <span class="text-green-600 font-semibold">Success</span>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection