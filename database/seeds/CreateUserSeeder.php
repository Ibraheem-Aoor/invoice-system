<?php
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateUserSeeder extends Seeder
{//satrt class
    /**
    * Run the database seeds.
    *
    * @return void
    */
        public function run()
    {
        $user = User::create([
        'name' => 'IbraheemDev',
        'email' => 'admin@admin',
        'status' =>  1 ,//active
        'password' => bcrypt('admin')
        ]);

        $role = Role::create(['name' => 'owner']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        /* Create a user Default Role */
        $role_2 = Role::create(['name' => 'default-user']);
        $role_2->syncPermissions(['الفواتير',
        'قائمة الفواتير',
        'الفواتير المدفوعة',
        'الفواتير المدفوعة جزئيا',
        'الفواتير الغير مدفوعة',
        'ارشيف الفواتير',
        'التقارير',
        'تقرير الفواتير',
        'تقرير العملاء',
        'الاعدادات',
        'المنتجات',
        'الاقسام',

        'اضافة فاتورة',
        'حذف الفاتورة',
        'تصدير EXCEL',
        'تغير حالة الدفع',
        'تعديل الفاتورة',
        'ارشفة الفاتورة',
        'طباعةالفاتورة',
        'اضافة مرفق',
        'حذف المرفق',

        'اضافة منتج',
        'تعديل منتج',
        'حذف منتج',

        'اضافة قسم',
        'تعديل قسم',
        'حذف قسم',]);
        $user->assignRole([$role->id]);
    }

}//End Class
