<?php

Route::group(['middleware' => ['auth', config('authuser.middleware.isVerified')]], function (){
    Route::resource('categories', 'CategoriesController', ['except' => 'show']);
    Route::resource('books', 'BooksController', ['except' => 'show']);
    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function (){
        Route::resource('books', 'BooksTrashedController', ['except' => ['create', 'store', 'edit', 'destroy']]);
        Route::resource('categories', 'CategoriesTrashedController', ['except' => ['create', 'store', 'edit', 'destroy']]);
    });
});