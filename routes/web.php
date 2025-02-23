<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Clock;
Route::get('/', function () {
    return view('index');
});
Route::get('/counter', Counter::class);
Route::get('/clock', Clock::class);
