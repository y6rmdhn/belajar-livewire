<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/counter', 'counter');
// Route::get('/users', function () {
//     return view('users');
// });
// Route::get('/users-list', function () {
//     return view('user-list');
// });

Route::view('/users', 'users');
Route::view('/contact', 'contact');
