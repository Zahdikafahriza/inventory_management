<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MasterReferenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RbacAuditController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Data barang — otorisasi create/update/delete ditangani di controller via BarangPolicy
    Route::get('barangs/preview-kode', [BarangController::class, 'previewKode'])->name('barangs.preview-kode');
    Route::get('barangs/export', [BarangController::class, 'export'])->name('barangs.export');
    Route::resource('barangs', BarangController::class);

    // Stock Opname (SO)
    Route::get('stock-opname', [StockOpnameController::class, 'index'])->name('stock-opname.index');
    Route::post('stock-opname', [StockOpnameController::class, 'create'])->name('stock-opname.create');
    Route::get('stock-opname/{stockOpname}', [StockOpnameController::class, 'show'])->name('stock-opname.show');
    Route::put('stock-opname/{stockOpname}', [StockOpnameController::class, 'update'])->name('stock-opname.update');
    Route::post('stock-opname/{stockOpname}/finalize', [StockOpnameController::class, 'finalize'])->name('stock-opname.finalize');
    Route::delete('stock-opname/{stockOpname}', [StockOpnameController::class, 'destroy'])->name('stock-opname.destroy');

    // ---- RBAC: User, Role, Permission ----
    Route::resource('users', UserController::class)->except(['show']);

    Route::get('roles/audit', [RbacAuditController::class, 'index'])->name('roles.audit');
    Route::resource('roles', RoleController::class)->except(['show']);
    // Autosave toggle permission (fetch, tanpa reload)
    Route::post('roles/{role}/toggle-permission', [RoleController::class, 'togglePermission'])->name('roles.toggle-permission');

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