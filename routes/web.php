<?php

use Illuminate\Support\Facades\Route;

Route::get('/posts/{post_id}', function (int $post_id) {
    return view('posts.show', compact(['post_id']));
})->name('posts.show');

Route::get('/booking/{post_id}', function (int $post_id) {
    return view('booking', compact(['post_id']));
})->name('booking');


Route::get('/posts', function () {
    return view('posts');
})->name('posts');

Route::get('/', function () {
    return view('home');
})->name('home');

