<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Barang;
use App\Models\StockOpnameSession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Kartu ringkasan ---
        $totalBarang = Barang::count();
        $totalStok   = (int) Barang::sum('stok');
        $stokMenipis = Barang::stokStatus('menipis')->count();
        $stokHabis   = Barang::stokStatus('habis')->count();
        $logHariIni  = ActivityLog::whereDate('created_at', today())->count();

        // --- Donut: komposisi status stok ---
        $stokAman = Barang::stokStatus('aman')->count();
        $stokChart = [
            'labels' => ['Aman', 'Menipis', 'Habis'],
            'data'   => [$stokAman, $stokMenipis, $stokHabis],
        ];

        // --- Bar: jumlah barang per kategori (top 6) ---
        $perKategori = Barang::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->orderByDesc('total')
            ->limit(6)
            ->get();
        $kategoriChart = [
            'labels' => $perKategori->pluck('kategori')->map(fn ($k) => $k ?: 'Lainnya')->all(),
            'data'   => $perKategori->pluck('total')->all(),
        ];

        // --- Line: aktivitas 14 hari terakhir ---
        $days = collect(range(13, 0))->map(fn ($i) => today()->subDays($i));
        $counts = ActivityLog::where('created_at', '>=', today()->subDays(13)->startOfDay())
            ->select(DB::raw('DATE(created_at) as d'), DB::raw('count(*) as total'))
            ->groupBy('d')
            ->pluck('total', 'd');
        $trendChart = [
            'labels' => $days->map(fn ($d) => $d->format('d/m'))->all(),
            'data'   => $days->map(fn ($d) => (int) ($counts[$d->format('Y-m-d')] ?? 0))->all(),
        ];

        // --- Aktivitas terbaru & barang perlu perhatian ---
        $aktivitasTerbaru = ActivityLog::with('loggable')->latest('created_at')->limit(6)->get();
        $perluPerhatian   = Barang::where('stok', '<=', Barang::STOK_MENIPIS_THRESHOLD)
            ->orderBy('stok')
            ->limit(5)
            ->get();

        $soTerakhir = StockOpnameSession::where('status', 'finalized')->latest('finalized_at')->first();

        return view('dashboard', compact(
            'totalBarang', 'totalStok', 'stokMenipis', 'stokHabis', 'logHariIni',
            'stokChart', 'kategoriChart', 'trendChart',
            'aktivitasTerbaru', 'perluPerhatian', 'soTerakhir'
        ));
    }
}
