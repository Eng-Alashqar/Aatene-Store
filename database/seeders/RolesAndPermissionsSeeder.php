<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create roles and assign created permissions
        // this can be done as separate statements

        // $permissions = Permission::pluck('id','id')->all();

        // $role->syncPermissions($permissions);

        $permissions = [
            'إضافة-متجر',
            'تعديل-متجر',
            'حذف-متجر',
            'عرض-متجر',
            'قبول-طلبات-متجر',
            'إضافة-قسم',
            'تعديل-قسم',
            'حذف-قسم',
            'عرض-قسم',
            'إضافة-منطقة',
            'تعديل-منطقة',
            'حذف-منطقة',
            'عرض-منطقة',
            'إضافة-مستخدم',
            'تعديل-مستخدم',
            'حذف-مستخدم',
            'عرض-مستخدم',
            'إضافة-دور',
            'تعديل-دور',
            'حذف-دور',
            'عرض-دور',
            'إضافة-موظف',
            'تعديل-موظف',
            'حذف-موظف',
            'عرض-موظف',
            'إضافة-اعلان',
            'تعديل-اعلان',
            'حذف-اعلان',
            'عرض-اعلان',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $role = Role::create(['name' => 'الأدمن']);
        $role->givePermissionTo(Permission::all());
    }
}
