<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardMemberController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Models\CardMember;

Route::get('/', function () {
    return view('auth.beranda');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerSave')->name('register.save');

    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginAction')->name('login.action');
});

Route::middleware(['auth'])->group(function () {
    // User
    Route::put('/profile-user/update/{user}', [AuthController::class, 'updateUserProfile'])->name('update.user.profile');

    // Form
    Route::get('/form', [AuthController::class, 'profil_form'])->name('form');
    Route::post('/form-member/register', [CardMemberController::class, 'registerMember'])->name('register-form-member');
    Route::put('/form-member/update/{card_member}', [AuthController::class, 'update'])->name('update-form-member');

    // Data members
    Route::get('/new-dashboard', [TransactionController::class, 'viewDashboard'])->name('new-dashboard')->middleware('user');

    //barcode
    Route::get('/barcode', [AuthController::class, 'barcode'])->name('barcode')->middleware('user');

    Route::get('/information', function () {
        return view('auth.information');
    })->name('information')->middleware('user');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Register admin
    Route::get('/new-regis', function () {
        return view('auth.new_regis');
    })->name('new-regis');

    // Members
    Route::get('/table', [CardMemberController::class, 'showMembers'])->name('table');
    Route::post('/import-members', [CardMemberController::class, 'importMember']);
    Route::post('/update-existing-member', [CardMemberController::class, 'updateExistingMember'])->name('update-existing-member');
    Route::post('/update-member-status', [CardMemberController::class, 'updateMemberStatus'])->name('update-member-status');
    Route::get('/form-admin', [CardMemberController::class, 'formulirMember'])->name('form-admin.index');
    Route::post('/simpan-form', [CardMemberController::class, 'member'])->name('simpan-form');
    Route::get('/form/edit/{id}', [CardMemberController::class, 'edit'])->name('form.edit');
    Route::put('/form/update/{card_member}', [CardMemberController::class, 'update'])->name('form.update');
    Route::get('/member/delete/{card_member}', [CardMemberController::class, 'delete'])->name('delete-member');

    // Transactions
    Route::get('/table-transaction', [TransactionController::class, 'index'])->name('table.transaction');
    Route::post('/import-transactions', [TransactionController::class, 'import'])->name('transaction.import');

    // Akun
    Route::get('/table-akun', [AuthController::class, 'table_akun'])->name('table.akun');
    Route::put('/update-akun/{user}', [AuthController::class, 'updateAkun'])->name('akun.update');
    Route::get('/delete-akun/{user}', [AuthController::class, 'deleteAkun'])->name('akun.delete');
    // Route::get('/table-akun-search', [AuthController::class, 'showAkun'])->name('table-akun');
});
