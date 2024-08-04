<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\EnderecoController;


use Inertia\Inertia;

Route::get('/address-lookup', function () {
    return Inertia::render('AddressLookup');
});

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pessoas', PessoaController::class);
Route::resource('pessoas.enderecos', EnderecoController::class)->shallow();
