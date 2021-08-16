<?php

Route::redirect('/', '/login');
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

    // Rak
    Route::delete('raks/destroy', 'RakController@massDestroy')->name('raks.massDestroy');
    Route::resource('raks', 'RakController');

    // Merk
    Route::delete('merks/destroy', 'MerkController@massDestroy')->name('merks.massDestroy');
    Route::resource('merks', 'MerkController');

    // Jenis
    Route::delete('jenis/destroy', 'JenisController@massDestroy')->name('jenis.massDestroy');
    Route::resource('jenis', 'JenisController');

    // Status
    Route::delete('statuses/destroy', 'StatusController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusController');

    // Data Perangkat Keras
    Route::delete('data-perangkat-keras/destroy', 'DataPerangkatKerasController@massDestroy')->name('data-perangkat-keras.massDestroy');
    Route::post('data-perangkat-keras/media', 'DataPerangkatKerasController@storeMedia')->name('data-perangkat-keras.storeMedia');
    Route::post('data-perangkat-keras/ckmedia', 'DataPerangkatKerasController@storeCKEditorImages')->name('data-perangkat-keras.storeCKEditorImages');
    Route::resource('data-perangkat-keras', 'DataPerangkatKerasController');

    // Data Center
    Route::delete('data-centers/destroy', 'DataCenterController@massDestroy')->name('data-centers.massDestroy');
    Route::resource('data-centers', 'DataCenterController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
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
