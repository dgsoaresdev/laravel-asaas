<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('index');
// })->name('index');

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::get('/checkout/{order_code}/{status_checkout_request}/{trans_code?}', [CheckoutController::class, 'processing'])->name('checkout.processing');
//Route::get('/checkout/processing/{p1}/{p2}', [CheckoutController::class, 'obrigado'])->name('checkout.obrigado');


 //Route::get('/thank_you_page', [CheckoutController::class, 'index'])->name('thankyou');


Route::fallback( function() 
{
    echo 'A rota acessda não existe. <a href="'.route('site.index').'">Clique aqui</a> para voltar à home.';
}
);