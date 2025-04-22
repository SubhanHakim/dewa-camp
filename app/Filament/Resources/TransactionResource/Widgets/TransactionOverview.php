<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            stat::make('Total Pengguna', User::where('role', 'user')->count())
                ->description('Total Pengguna')
                ->icon('heroicon-o-users')
                ->color('success'),
            stat::make('Transaksi Berhasil', Transaction::where('status', 'success')->count())
                ->description('Transaksi Berhasil')
                ->icon('heroicon-o-shopping-cart')
                ->color('success'),
            Stat::make('total Pendapatan', 'Rp. ' . number_format(Transaction::where('status', 'success')->sum('total'), 0, ',', '.'))
                ->description('Total Pendapatan')
                ->icon('heroicon-o-currency-dollar')
                ->color('success'),
                stat::make('Transaksi Pending', Transaction::where('status', 'pending')->count())
                ->description('Transaksi Pending')
                ->icon('heroicon-o-clock')
                ->color('warning'),
            
        ];
    }
}
