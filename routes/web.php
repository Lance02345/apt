<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('pages.apt');
});

Route::post('/search', [SearchController::class, 'search'])->name('search');


