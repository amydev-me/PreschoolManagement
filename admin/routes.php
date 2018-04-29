<?php


Route::middleware('web')->group(function() {
    Route::name('yearlystudents')->get('yearlystudents', 'DashboardController@yearlyStudents');
    Route::name('yearlyincome')->get('yearlyincome', 'DashboardController@yearlyIncome');
    Route::name('login')->get('login', 'AuthController@index');

    Route::name('admin.')->prefix('admin')->group(function () {
        Route::name('logout')->get('logout', 'AuthController@logout');
        Route::name('login-post')->post('login-post', 'AuthController@login');
    });
    /**
     * Get In Grade
     */
    Route::name('get-academic-category')->get('get-academic-category', 'AsyncController@asyncAcademicAndCategory');
    /**
     * Get In Teacher Allocation
     * Deprecated
     */
    Route::name('get-active-category')->get('get-active-category', 'AsyncController@asyncActiveAcademicAndCategory');

    //Use in UserJS
    Route::name('checkuser')->get('checkuser/{q}', 'UserController@check_username');


    Route::name('image.')->prefix('image')->group(function () {
        Route::name('business')->get('business/{name}', 'BusinessInfoController@getImage');
        Route::name('student')->get('student/{name}', 'StudentController@getImage');
        Route::name('teacher')->get('teacher/{name}', 'TeacherController@getImage');

    });

    Route::name('index')->get('/', 'DashboardController@index')->middleware('admin.auth');

    Route::name('admin.')->prefix('admin')->middleware('admin.auth')->group(function () {


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

        Route::name('term.')->prefix('term')->group(function () {
            Route::name('index')->get('/', 'TermController@index');
            Route::name('create')->post('create', 'TermController@create');
            Route::name('update')->post('update', 'TermController@update');
            Route::name('delete')->get('delete/{id}', 'TermController@delete');
            Route::name('get-data')->get('get-data', 'TermController@getData');
            Route::name('getby-academic')->get('getby-academic', 'TermController@getByAcademic');
            Route::name('get-bycategory')->get('get-bycategory', 'TermController@getByCategory');

        });
        Route::name('grade.')->prefix('grade')->group(function () {
            Route::name('index')->get('/', 'GradeController@index');
            Route::view('edit', 'grade.edit')->name('edit');
            Route::name('manage')->get('manage', 'GradeController@manageIndex');
            Route::name('create')->post('create', 'GradeController@create');
            Route::name('update')->post('update', 'GradeController@update');
            Route::name('delete')->get('delete/{id}', 'GradeController@delete');
            Route::name('action')->get('action', 'GradeController@detailIndex');
            Route::name('get-detail')->get('get-detail', 'GradeController@getDeail');
            Route::name('get-data')->get('get-data', 'GradeController@getData');
            Route::name('get-bycategory')->get('get-bycategory', 'GradeController@getByCategory');
            Route::name('get-grade')->get('get-grade', 'GradeController@getGradeByAC');
            Route::name('get-terms')->get('get-terms', 'GradeController@getByGradeOfTerms');
        });

        Route::name('category.')->prefix('category')->group(function () {
            Route::name('index')->get('/', 'CategoryController@index');
            Route::name('create')->post('create', 'CategoryController@create');
            Route::name('update')->post('update', 'CategoryController@update');
            Route::name('delete')->get('delete/{id}', 'CategoryController@delete');
            Route::name('get-data')->get('get-data', 'CategoryController@getData');
            Route::name('filter-name')->get('filter-name/{name}', 'CategoryController@filterByName');
            Route::name('async-get')->get('async-get', 'CategoryController@asyncget');
            Route::name('get-with-category')->get('get-with-category', 'CategoryController@getCategoryWithGrade');
            Route::name('get-with-category-byacademic')->get('get-with-category-byacademic/{academic_id}', 'CategoryController@getCategoryWithGradeByAcademic');
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


        Route::name('assign_teacher.')->prefix('assign_teacher')->group(function () {

            Route::name('index')->get('/', 'GradeTeacherController@index');
            Route::name('create')->post('create', 'GradeTeacherController@create');
            Route::name('update')->post('update', 'GradeTeacherController@update');
            Route::name('get-data')->get('get-data', 'GradeTeacherController@getData');
            Route::name('delete')->get('delete/{id}', 'GradeTeacherController@delete');
            Route::name('getby-category')->get('getby-category', 'GradeTeacherController@getByCategory');
            Route::name('getby-category-grade')->get('getby-category-grade', 'GradeTeacherController@getByCategoryAndGrade');
            Route::name('getby-teacher')->get('getby-teacher', 'GradeTeacherController@getGradeByTeacher');
        });

        Route::name('teacher.')->prefix('teacher')->group(function () {
            Route::name('index')->get('/', 'TeacherController@index');
            Route::name('create')->get('create', 'TeacherController@createIndex');
            Route::name('detail-view')->get('detail-view', 'TeacherController@detailIndex');

            Route::name('create')->post('create', 'TeacherController@create');
            Route::name('update')->post('update', 'TeacherController@update');
            Route::name('delete')->get('delete/{id}', 'TeacherController@delete');

            Route::name('get-data')->get('get-data', 'TeacherController@getData');
            Route::name('get-detail')->get('get-detail/{id}', 'TeacherController@getDetail');

            Route::name('async-get')->get('async-get/{q}', 'TeacherController@asyncget');
            Route::name('filter')->get('filter', 'TeacherController@filterTeacher');
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

        Route::name('student.')->prefix('student')->group(function () {
            Route::name('index')->get('/', 'StudentController@index');
            Route::name('create')->get('create', 'StudentController@createIndex');
            Route::name('create')->post('create', 'StudentController@create');
            Route::name('update')->post('update', 'StudentController@update');
            Route::name('delete')->get('delete/{id}', 'StudentController@delete');
            Route::name('detail-view')->get('detail-view', 'StudentController@detailIndex');
            Route::name('get-detail')->get('get-detail', 'StudentController@getDetail');
            Route::name('get-data')->get('get-data', 'StudentController@getData');
            Route::name('get-by-academic')->get('get-by-academic', 'StudentController@getStudentByActiveAcademic');
            Route::name('filter')->get('filter', 'StudentController@filterStudent');

            Route::name('get-by-ac')->get('get-by-ac', 'StudentController@getByAC');
            Route::name('get-by-grade')->get('get-by-grade', 'StudentController@getbyGrade');
            Route::name('get-studentby-grade')->get('get-studentby-grade', 'StudentController@getStudentByGrade');
            Route::name('get-file')->get('get-file/{name}', 'StudentController@getFile');
            Route::name('get-student')->get('get-student', 'StudentController@getStudentGrade');
        });
        Route::name('attendance.')->prefix('attendance')->group(function () {
            Route::name('index')->get('/', 'AttendanceController@index');
            Route::name('get-attendances')->get('get-attendances', 'AttendanceController@getAttendance');
            Route::name('get-attendances-bygrade')->get('get-attendances-bygrade', 'AttendanceController@getAttendanceByGradeTerm');
            Route::name('create')->post('create', 'AttendanceController@create');
            Route::name('attend_chart')->get('attend_chart/{id}', 'AttendanceController@attendanceChart');
            Route::name('detail')->get('detail', 'AttendanceController@getDetail');
        });

        Route::name('payment.')->prefix('payment')->group(function () {
            Route::view('/','payment.index')->name('index');
            Route::view('create','payment.create')->name('create');
            Route::view('edit','payment.edit')->name('edit');
            Route::view('view','payment.view')->name('view');
            Route::name('create')->post('create', 'PaymentController@create');
            Route::name('get-data')->get('get-data', 'PaymentController@getData');
            Route::name('get-detail')->get('get-detail', 'PaymentController@getDetail');
            Route::name('update')->post('update', 'PaymentController@update');
            Route::name('delete')->get('delete/{id}', 'PaymentController@delete');
            Route::name('by_student')->get('by_student', 'PaymentController@getByStudent');
            Route::name('export_pdf')->get('export_pdf', 'MailController@getDetail');
        });
        Route::name('invoice')->get('invoice', 'MailController@getDetail');
    });
});