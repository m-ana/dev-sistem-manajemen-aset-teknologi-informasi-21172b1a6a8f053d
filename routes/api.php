<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Rak
    Route::apiResource('raks', 'RakApiController');

    // Merk
    Route::apiResource('merks', 'MerkApiController');

    // Jenis
    Route::apiResource('jenis', 'JenisApiController');

    // Status
    Route::apiResource('statuses', 'StatusApiController');

    // Data Perangkat Keras
    Route::post('data-perangkat-keras/media', 'DataPerangkatKerasApiController@storeMedia')->name('data-perangkat-keras.storeMedia');
    Route::apiResource('data-perangkat-keras', 'DataPerangkatKerasApiController');

    // Data Center
    Route::apiResource('data-centers', 'DataCenterApiController');
});
