<?php


Route::middleware('web')->group(function() {

    Route::name('login')->get('login', 'AuthController@index');
    Route::name('admin.')->prefix('admin')->group(function() {
        Route::name('logout')->get('logout', 'AuthController@logout');
        Route::name('login-post')->post('login-post', 'AuthController@login');
    });
    /**
     * Get In Grade
     */
    Route::name('get-academic-category')->get('get-academic-category', 'AsyncController@asyncAcademicAndCategory');

    //Use in UserJS
    Route::name('checkuser')->get('checkuser/{q}', 'UserController@check_username');


    Route::name('image.')->prefix('image')->group(function() {
        Route::name('business')->get('business/{name}', 'BusinessInfoController@getImage');
    });

    Route::name('index')->get('/', 'DashboardController@index')->middleware('admin.auth');
    Route::name('admin.')->prefix('admin')->middleware('admin.auth')->group(function() {


        Route::name('user.')->prefix('user')->group(function () {
            Route::name('index')->get('/', 'UserController@index');
            Route::name('create')->post('create', 'UserController@create');
            Route::name('update')->post('update', 'UserController@update');
            Route::name('delete')->get('delete/{id}', 'UserController@delete');
            Route::name('getuser')->get('getuser/{type}', 'UserController@getUserByRole');
        });

        Route::name('academic-year.')->prefix('academic-year')->group(function () {
            Route::name('index')->get('/', 'AcademicController@index');
            Route::name('create')->post('create', 'AcademicController@create');
            Route::name('update')->post('update', 'AcademicController@update');
            Route::name('delete')->get('delete/{id}', 'AcademicController@delete');
            Route::name('get-data')->get('get-data', 'AcademicController@getData');
            Route::name('filter-name')->get('filter-name/{name}', 'AcademicController@filterByName');
            Route::name('async-get')->get('async-get', 'AcademicController@asyncget');
        });
        Route::name('info.')->prefix('info')->group(function () {
            Route::name('index')->get('/', 'BusinessInfoController@index');
            Route::name('detail')->get('detail', 'BusinessInfoController@getDetail');
        });
        Route::name('category.')->prefix('category')->group(function () {
            Route::name('index')->get('/', 'CategoryController@index');
            Route::name('create')->post('create', 'CategoryController@create');
            Route::name('update')->post('update', 'CategoryController@update');
            Route::name('delete')->get('delete/{id}', 'CategoryController@delete');
            Route::name('get-data')->get('get-data', 'CategoryController@getData');
            Route::name('filter-name')->get('filter-name/{name}', 'CategoryController@filterByName');
            Route::name('async-get')->get('async-get', 'CategoryController@asyncget');
        });
        Route::name('subject.')->prefix('subject')->group(function () {
            Route::name('index')->get('/', 'SubjectController@index');
            Route::name('create')->post('create', 'SubjectController@create');
            Route::name('update')->post('update', 'SubjectController@update');
            Route::name('delete')->get('delete/{id}', 'SubjectController@delete');
            Route::name('get-data')->get('get-data', 'SubjectController@getData');
            Route::name('filter-name')->get('filter-name/{name}', 'SubjectController@filterByName');
            Route::name('async-get')->get('async-get', 'SubjectController@asyncget');
        });
        Route::name('feetype.')->prefix('feetype')->group(function () {
            Route::name('index')->get('/', 'FeesTypeController@index');
            Route::name('create')->post('create', 'FeesTypeController@create');
            Route::name('update')->post('update', 'FeesTypeController@update');
            Route::name('delete')->get('delete/{id}', 'FeesTypeController@delete');
            Route::name('get-data')->get('get-data', 'FeesTypeController@getData');
            Route::name('filter-name')->get('filter-name/{name}', 'FeesTypeController@filterByName');
            Route::name('async-get')->get('async-get', 'FeesTypeController@asyncget');
        });
        Route::name('grade.')->prefix('grade')->group(function () {
            Route::name('index')->get('/', 'GradeController@index');
            Route::name('create')->post('create', 'GradeController@create');
            Route::name('update')->post('update', 'GradeController@update');
            Route::name('delete')->get('delete/{id}', 'GradeController@delete');
            Route::name('action')->get('action', 'GradeController@detailIndex');
            Route::name('detail')->get('detail', 'GradeController@getDetail');
            Route::name('get-data')->get('get-data', 'GradeController@getData');
        });
        Route::name('guardian.')->prefix('guardian')->group(function () {
            Route::name('index')->get('/', 'GuardianController@index');
            Route::name('create')->post('create', 'GuardianController@create');
            Route::name('update')->post('update', 'GuardianController@update');
            Route::name('get-data')->get('get-data', 'GuardianController@getData');
            Route::name('view-detail')->get('view-detail', 'GuardianController@detailIndex');
            Route::name('get-detail')->get('get-detail/{id}', 'GuardianController@getDetail');
            Route::name('async-get')->get('async-get/{q}', 'GuardianController@asyncget');
        });
    });
});