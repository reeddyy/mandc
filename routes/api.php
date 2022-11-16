<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Ada
    Route::apiResource('adas', 'AdaApiController');

    // Certificate
    Route::apiResource('certificates', 'CertificateApiController');

    // Membership
    Route::apiResource('memberships', 'MembershipApiController');
});
