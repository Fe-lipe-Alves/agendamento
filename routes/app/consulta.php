<?php

use App\Http\Controllers\ConsultaController;
use Illuminate\Support\Facades\Route;

Route::prefix('consulta')->group(function (){

    Route::resource('/', ConsultaController::class)
        ->names('consulta');

});

