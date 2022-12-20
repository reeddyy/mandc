<?php

Route::redirect('/', '/login');
Route::get('/sign-in/azure', 'Auth\LoginController@azure');
Route::get('/sign-in/azure/redirect', 'Auth\LoginController@azureRedirect');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Ada
    Route::delete('adas/destroy', 'AdaController@massDestroy')->name('adas.massDestroy');
    Route::post('adas/parse-csv-import', 'AdaController@parseCsvImport')->name('adas.parseCsvImport');
    Route::post('adas/process-csv-import', 'AdaController@processCsvImport')->name('adas.processCsvImport');
    Route::resource('adas', 'AdaController');

    // Certificate
    Route::delete('certificates/destroy', 'CertificateController@massDestroy')->name('certificates.massDestroy');
    Route::post('certificates/parse-csv-import', 'CertificateController@parseCsvImport')->name('certificates.parseCsvImport');
    Route::post('certificates/process-csv-import', 'CertificateController@processCsvImport')->name('certificates.processCsvImport');
    Route::resource('certificates', 'CertificateController');

    // Membership
    Route::delete('memberships/destroy', 'MembershipController@massDestroy')->name('memberships.massDestroy');
    Route::post('memberships/parse-csv-import', 'MembershipController@parseCsvImport')->name('memberships.parseCsvImport');
    Route::post('memberships/process-csv-import', 'MembershipController@processCsvImport')->name('memberships.processCsvImport');
    Route::resource('memberships', 'MembershipController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
