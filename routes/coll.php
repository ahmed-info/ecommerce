<?php

use App\Mail\NotifyEmail;
use Illuminate\Support\Facades\Mail;

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('collection','CollectTut@index');
Route::get('mainoffers','CollectTut@complex');
Route::get('main-offers','CollectTut@complexFilter');
Route::get('offers-transform','CollectTut@complexTransform');