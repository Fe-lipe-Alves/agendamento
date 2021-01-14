<?php

use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::prefix('paciente')->group(function (){

    Route::resource('/', PacienteController::class)
        ->names('paciente');

});
