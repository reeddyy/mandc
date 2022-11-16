<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'ada_create',
            ],
            [
                'id'    => 20,
                'title' => 'ada_edit',
            ],
            [
                'id'    => 21,
                'title' => 'ada_show',
            ],
            [
                'id'    => 22,
                'title' => 'ada_delete',
            ],
            [
                'id'    => 23,
                'title' => 'ada_access',
            ],
            [
                'id'    => 24,
                'title' => 'certificate_create',
            ],
            [
                'id'    => 25,
                'title' => 'certificate_edit',
            ],
            [
                'id'    => 26,
                'title' => 'certificate_show',
            ],
            [
                'id'    => 27,
                'title' => 'certificate_delete',
            ],
            [
                'id'    => 28,
                'title' => 'certificate_access',
            ],
            [
                'id'    => 29,
                'title' => 'membership_create',
            ],
            [
                'id'    => 30,
                'title' => 'membership_edit',
            ],
            [
                'id'    => 31,
                'title' => 'membership_show',
            ],
            [
                'id'    => 32,
                'title' => 'membership_delete',
            ],
            [
                'id'    => 33,
                'title' => 'membership_access',
            ],
            [
                'id'    => 34,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
