<?php
Route::post('login', 'Api\V1\Admin\AuthController@login');
Route::get('v1/membership-details/{member_reference}', 'Api\V1\Admin\MembershipApiController@getMembershipDetails');
Route::get('v1/credential-verification/{credential_reference}', 'Api\V1\Admin\CertificateApiController@verifyCredential');

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
