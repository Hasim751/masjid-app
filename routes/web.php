<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;

Route::get('/', function () {
    return view('index');
});
Route::get('/counter', Counter::class);
