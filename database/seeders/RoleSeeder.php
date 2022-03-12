<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role1=  Role::create(['name'=> 'Super Admin']);
      $role2=  Role::create(['name'=>'Admin']);       
      $role3=  Role::create(['name'=> 'Encargado']);
      $role4=  Role::create(['name'=>'RRHH']); 

      $permission1=Permission::create(['name'=>'home']);
      $permission2=Permission::create(['name'=>'proveedores.index']);
      $permission3=Permission::create(['name'=>'proveedores.create']);
      $permission4=Permission::create(['name'=>'proveedores.store']);
      $permission5=Permission::create(['name'=>'proveedores.edit']);
      $permission6=Permission::create(['name'=>'proveedores.update']);
      $permission7=Permission::create(['name'=>'proveedores.destroy']);
      $permission8=Permission::create(['name'=>'proveedores.show']);

      $permission9=Permission::create(['name'=>'productos.index']);
      $permission10=Permission::create(['name'=>'productos.create']);
      $permission11=Permission::create(['name'=>'productos.store']);
      $permission12=Permission::create(['name'=>'productos.edit']);
      $permission13=Permission::create(['name'=>'productos.update']);
      $permission14=Permission::create(['name'=>'productos.destroy']);
      $permission15=Permission::create(['name'=>'productos.show']);

      
      $permission16=Permission::create(['name'=>'encargados.index']);
      $permission17=Permission::create(['name'=>'encargados.create']);
      $permission18=Permission::create(['name'=>'encargados.store']);
      $permission19=Permission::create(['name'=>'encargados.edit']);
      $permission20=Permission::create(['name'=>'encargados.update']);
      $permission21=Permission::create(['name'=>'encargados.destroy']);
      $permission22=Permission::create(['name'=>'encargados.show']);

      $role1->syncPermissions($permission1,$permission2,$permission3,$permission4,$permission5,$permission6,$permission7,$permission8,$permission9,$permission10);
      /*$role3->syncPermissions($permission11,$permission12,$permission13,$permission14,$permission15,$permission16,$permission17,$permission18,$permission19,$permission20);*/
    }
}
