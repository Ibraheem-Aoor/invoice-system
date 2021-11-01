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
        'email' => 'admin',
        'roles_name' =>   ["super-admin"], //This how sptie package will recognize to
        'status' =>  1 ,//active
        'password' => bcrypt('admin')
        ]);

        $role = Role::create(['name' => 'super-admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }

}//End Class
