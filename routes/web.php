<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');


 Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

 //Route::get('/thank_you_page', [CheckoutController::class, 'index'])->name('thankyou');


Route::fallback( function() 
{
    echo 'A rota acessda não existe. <a href="'.route('site.index').'">Clique aqui</a> para voltar à home.';
}
);