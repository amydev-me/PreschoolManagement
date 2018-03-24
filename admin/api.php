<?php
Route::name('info.')->prefix('info')->group(function () {


    Route::name('edit')->post('edit', 'BusinessInfoController@update');

    Route::name('create')->post('create', 'BusinessInfoController@create');
});