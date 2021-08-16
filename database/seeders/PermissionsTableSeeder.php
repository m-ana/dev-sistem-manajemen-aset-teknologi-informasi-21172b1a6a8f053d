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
                'title' => 'data_master_access',
            ],
            [
                'id'    => 18,
                'title' => 'rak_create',
            ],
            [
                'id'    => 19,
                'title' => 'rak_edit',
            ],
            [
                'id'    => 20,
                'title' => 'rak_show',
            ],
            [
                'id'    => 21,
                'title' => 'rak_delete',
            ],
            [
                'id'    => 22,
                'title' => 'rak_access',
            ],
            [
                'id'    => 23,
                'title' => 'merk_create',
            ],
            [
                'id'    => 24,
                'title' => 'merk_edit',
            ],
            [
                'id'    => 25,
                'title' => 'merk_show',
            ],
            [
                'id'    => 26,
                'title' => 'merk_delete',
            ],
            [
                'id'    => 27,
                'title' => 'merk_access',
            ],
            [
                'id'    => 28,
                'title' => 'jeni_create',
            ],
            [
                'id'    => 29,
                'title' => 'jeni_edit',
            ],
            [
                'id'    => 30,
                'title' => 'jeni_show',
            ],
            [
                'id'    => 31,
                'title' => 'jeni_delete',
            ],
            [
                'id'    => 32,
                'title' => 'jeni_access',
            ],
            [
                'id'    => 33,
                'title' => 'status_create',
            ],
            [
                'id'    => 34,
                'title' => 'status_edit',
            ],
            [
                'id'    => 35,
                'title' => 'status_show',
            ],
            [
                'id'    => 36,
                'title' => 'status_delete',
            ],
            [
                'id'    => 37,
                'title' => 'status_access',
            ],
            [
                'id'    => 38,
                'title' => 'data_aset_access',
            ],
            [
                'id'    => 39,
                'title' => 'data_perangkat_kera_create',
            ],
            [
                'id'    => 40,
                'title' => 'data_perangkat_kera_edit',
            ],
            [
                'id'    => 41,
                'title' => 'data_perangkat_kera_show',
            ],
            [
                'id'    => 42,
                'title' => 'data_perangkat_kera_delete',
            ],
            [
                'id'    => 43,
                'title' => 'data_perangkat_kera_access',
            ],
            [
                'id'    => 44,
                'title' => 'data_center_create',
            ],
            [
                'id'    => 45,
                'title' => 'data_center_edit',
            ],
            [
                'id'    => 46,
                'title' => 'data_center_show',
            ],
            [
                'id'    => 47,
                'title' => 'data_center_delete',
            ],
            [
                'id'    => 48,
                'title' => 'data_center_access',
            ],
            [
                'id'    => 49,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 50,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 51,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
