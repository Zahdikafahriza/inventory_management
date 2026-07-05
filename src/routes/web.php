<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MasterReferenceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $totalBarang = \App\Models\Barang::count();
    $stokMenipis = \App\Models\Barang::where('stok', '>', 0)->where('stok', '<=', 5)->count();
    $stokHabis   = \App\Models\Barang::where('stok', '<=', 0)->count();
    $logHariIni  = \App\Models\ActivityLog::whereDate('created_at', today())->count();
    $aktivitasTerbaru = \App\Models\ActivityLog::with('loggable')->latest('created_at')->limit(6)->get();

    return view('dashboard', compact('totalBarang', 'stokMenipis', 'stokHabis', 'logHariIni', 'aktivitasTerbaru'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Data barang — otorisasi create/update/delete ditangani di controller via BarangPolicy
    Route::get('barangs/preview-kode', [BarangController::class, 'previewKode'])->name('barangs.preview-kode');
    Route::resource('barangs', BarangController::class);

    // Log aktivitas — READ ONLY, sengaja tidak ada route store/update/destroy.
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // Master Referensi — CRUD generik untuk 8 jenis data referensi.
    // {type} = kategori | sub-kategori | merk | tipe-spek | satuan | kondisi | status | lokasi
    Route::prefix('master/{type}')->name('master.')->group(function () {
        Route::get('/', [MasterReferenceController::class, 'index'])->name('index');
        Route::get('/create', [MasterReferenceController::class, 'create'])->name('create');
        Route::post('/', [MasterReferenceController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MasterReferenceController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MasterReferenceController::class, 'update'])->name('update');
        Route::delete('/{id}', [MasterReferenceController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';