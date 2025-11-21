<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Halaman Depan (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// Grup rute yang hanya bisa diakses setelah Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- 1. Rute Dashboard Keuangan & Kantong ---
    Route::get('/dashboard', [FinanceController::class, 'index'])->name('dashboard');
    Route::post('/categories', [FinanceController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{category}', [FinanceController::class, 'show'])->name('categories.show');
    Route::delete('/categories/{category}', [FinanceController::class, 'destroyCategory'])->name('categories.destroy');
    Route::get('/pockets', [FinanceController::class, 'listCategories'])->name('categories.index');

    // --- 2. Rute Transaksi ---
    Route::post('/transactions', [FinanceController::class, 'storeTransaction'])->name('transactions.store');
    Route::delete('/transactions/{transaction}', [FinanceController::class, 'destroyTransaction'])->name('transactions.destroy');
    Route::post('/transfer', [FinanceController::class, 'storeTransfer'])->name('transactions.transfer');
    Route::get('/transactions/history', [FinanceController::class, 'history'])->name('transactions.history');


    // --- 3. Rute Manajemen Tagihan (Bill Calculator) ---
    
    // Halaman Utama Tagihan
    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    
    // Simpan Tagihan Baru (Store)
    Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
    
    // Update Tagihan (Edit) - PASTIKAN INI ADA
    Route::put('/bills/{bill}', [BillController::class, 'update'])->name('bills.update');
    
    // Hapus Tagihan (Destroy)
    Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy');
    
    // Bayar & Topup
    Route::post('/bills/{bill}/pay', [BillController::class, 'pay'])->name('bills.pay'); 
    Route::post('/bills/add-funds', [BillController::class, 'addFunds'])->name('bills.addFunds');
    Route::post('/bills/bulk-pay', [BillController::class, 'bulkPay'])->name('bills.bulkPay');


    // --- 4. Rute Laporan Keuangan ---
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'exportPdf'])->name('reports.export');

    // --- 5. Rute Profil Pengguna ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';