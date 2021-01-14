<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

Route::prefix('agenda')->group(function (){

    Route::get('/', [AgendaController::class, 'index'])
        ->name('agenda.index');

    Route::get('informacoes-dia', [AgendaController::class, 'informacoesDia'])
        ->name('agenda.informacoes-dia');

});

