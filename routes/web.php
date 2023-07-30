<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CalculetteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviseController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RetraitController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VilleController;
use App\Http\Middleware\CloseAppDuringNight;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'close.app.during.night'])->group(
    function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::resource('users', UserController::class);
        Route::delete('users/force/{user}', [UserController::class, 'forceDestroy'])->name('users.force.destroy');
        Route::put('users/restore/{user}', [UserController::class, 'restore'])->name('users.restore');

        Route::resource('devises', DeviseController::class);
        Route::delete('devises/force/{devise}', [DeviseController::class, 'forceDestroy'])->name('devises.force.destroy');
        Route::put('devises/restore/{devise}', [DeviseController::class, 'restore'])->name('devises.restore');


        Route::resource('balances', BalanceController::class);
        Route::delete('balances/force/{balance}', [BalanceController::class, 'forceDestroy'])->name('balances.force.destroy');
        Route::put('balances/restore/{balance}', [BalanceController::class, 'restore'])->name('balances.restore');

        Route::get('balances/add/{user}', [BalanceController::class, 'balance'])->name('balance');

        Route::post('balances/add', [BalanceController::class, 'addBalance'])->name('balances.add');

        Route::resource('transactions', TransactionController::class);
        Route::post('transactions/cancel/{transaction}', [TransactionController::class, 'cancel'])->name('transactions.cancel');
        Route::delete('transactions/force/{transaction}', [TransactionController::class, 'forceDestroy'])->name('transactions.force.destroy');
        Route::put('transactions/restore/{transaction}', [TransactionController::class, 'restore'])->name('transactions.restore');

        Route::get('transactions/factureTransfert/{transaction}', [FactureController::class, 'factureTransfert'])->name('transactions.factureTransfert');
        Route::get('transactions/factureRetrait/{transaction}', [FactureController::class, 'factureRetrait'])->name('transactions.factureRetrait');


        Route::resource('compenses', CompenseController::class);
        Route::delete('compenses/force/{compense}', [CompenseController::class, 'forceDestroy'])->name('compenses.force.destroy');
        Route::put('compenses/restore/{compense}', [CompenseController::class, 'restore'])->name('compenses.restore');

        Route::post('compenses/approve/{compense}', [CompenseController::class, 'approve'])->name('compenses.approve');
        Route::post('compenses/reject/{compense}', [CompenseController::class, 'reject'])->name('compenses.reject');
        Route::get('compenses/facture/{transaction}', [FactureController::class, 'factureCompense'])->name('compenses.facture');


        Route::get('profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('changePassword/{user}', [ProfileController::class, 'editPassword'])->name('profile.editPassword');
        Route::put('changePassword/{user}', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::get('profilePicture/{user}', [ProfileController::class, 'editPicture'])->name('profilePicture.edit');
        Route::put('profilePicture/{user}', [ProfileController::class, 'changeProfilePicture'])->name('profilePicture.update');
        Route::delete('profilePicture/{user}', [ProfileController::class, 'deleteProfilePicture'])->name('profilePicture.delete');
        Route::post('/villesByPays', [VilleController::class, 'villesByPays'])->name('villesByPays');

        Route::post('/getDevises', [DeviseController::class, 'devises'])->name('getDevises');


        Route::post('/addClient', [ClientController::class, 'addClient'])->name('addClient');
        Route::post('/getReceiverPays', [ClientController::class, 'getReceiverPays'])->name('getReceiverPays');
        Route::get('/retrait', [RetraitController::class, 'create'])->name('retrait');
        Route::post('/addRetrait', [RetraitController::class, 'retrait'])->name('addRetrait');
        Route::post('/searchByCode', [RetraitController::class, 'searchByCode'])->name('searchByCode');
        Route::get('/calculette', [CalculetteController::class, 'index'])->name('calculette');
        Route::post('/calculette', [CalculetteController::class, 'calculette'])->name('getCalculette');

        Route::post('/commission', [TransactionController::class, 'commission'])->name('commission');
    }
);


Route::middleware(['guest', 'close.app.during.night'])->group(
    function () {
        // les routes pour auth
        Route::get('login', [AuthController::class, 'index'])->name('getLogin')->middleware(CloseAppDuringNight::class);
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('/reload-captcha', [AuthController::class, 'reloadCaptcha']);

        Route::get('/forgot-password', function () {
            return view('pages.auth.forgot-password');
        })->name('password.request');

        Route::get('/reset-password/{token}', function (string $token) {
            return view('pages.auth.reset-password', ['token' => $token]);
        })->name('password.reset');


        Route::post('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email');
        Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
    }
);
