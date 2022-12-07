<?php
Route::post('login', 'Api\V1\Admin\AuthController@login');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {


    Route::get('membership-details/{member_reference}', 'MembershipApiController@getMembershipDetails');
    Route::get('credential-verification/{credential_reference}', 'CertificateApiController@verifyCredential');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Ada
    Route::apiResource('adas', 'AdaApiController');

    // Certificate
    Route::apiResource('certificates', 'CertificateApiController');

    // Membership
    Route::apiResource('memberships', 'MembershipApiController');
});
