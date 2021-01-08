<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;

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

function incluir($caminho){
    require_once __DIR__.$caminho;
}

Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Inclusões
    incluir('/app/agenda.php');
});
