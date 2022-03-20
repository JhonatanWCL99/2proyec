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

      $permission22=Permission::create(['name'=>'sucursales.index']);
      $permission23=Permission::create(['name'=>'sucursales.create']);
      $permission24=Permission::create(['name'=>'sucursales.store']);
      $permission25=Permission::create(['name'=>'sucursales.edit']);
      $permission26=Permission::create(['name'=>'sucursales.update']);
      $permission27=Permission::create(['name'=>'sucursales.destroy']);
      $permission28=Permission::create(['name'=>'sucursales.show']);

      $permission29=Permission::create(['name'=>'categorias.index']);
      $permission30=Permission::create(['name'=>'categorias.create']);
      $permission31=Permission::create(['name'=>'categorias.store']);
      $permission32=Permission::create(['name'=>'categorias.edit']);
      $permission33=Permission::create(['name'=>'categorias.update']);
      $permission34=Permission::create(['name'=>'categorias.destroy']);
      $permission35=Permission::create(['name'=>'categorias.show']);
      
      $permission36=Permission::create(['name'=>'productos_proveedores.index']);
      $permission37=Permission::create(['name'=>'productos_proveedores.create']);
      $permission38=Permission::create(['name'=>'productos_proveedores.store']);

      $permission39=Permission::create(['name'=>'inventarios.index']);
      $permission40=Permission::create(['name'=>'inventarios.create']);
      $permission41=Permission::create(['name'=>'inventarios.store']);
     

      $permission43=Permission::create(['name'=>'contratos.index']);
      $permission44=Permission::create(['name'=>'contratos.create']);
      $permission45=Permission::create(['name'=>'contratos.store']);
      $permission46=Permission::create(['name'=>'contratos.edit']);
      $permission47=Permission::create(['name'=>'contratos.update']);
      $permission48=Permission::create(['name'=>'contratos.destroy']);
      $permission49=Permission::create(['name'=>'contratos.show']);

      $permission50=Permission::create(['name'=>'departamentos.index']);
      $permission51=Permission::create(['name'=>'departamentos.create']);
      $permission52=Permission::create(['name'=>'departamentos.store']);
      $permission53=Permission::create(['name'=>'departamentos.edit']);
      $permission54=Permission::create(['name'=>'departamentos.update']);
      $permission55=Permission::create(['name'=>'departamentos.destroy']);
      $permission56=Permission::create(['name'=>'departamentos.show']);


      $permission57=Permission::create(['name'=>'personales.index']);
      $permission58=Permission::create(['name'=>'personales.create']);
      $permission62=Permission::create(['name'=>'personales.destroy']);

      $permission59=Permission::create(['name'=>'personales.contratar']);
      $permission60=Permission::create(['name'=>'personales.showDetalleContrato']);
      $permission61=Permission::create(['name'=>'personales.editContratoUser']);
      
      $permission63=Permission::create(['name'=>'personales.editDatosBasicos']);

      $permission64=Permission::create(['name'=>'personales.actualizarContratoUser']);
      $permission65=Permission::create(['name'=>'personales.actualizarDatosBasicos']);
      $permission66=Permission::create(['name'=>'personales.vencimientoContratos']);
      $permission67=Permission::create(['name'=>'personales.filtrarContratos']);

/*      $permission68=Permission::create(['name'=>'encargados.update']);
      $permission69=Permission::create(['name'=>'encargados.destroy']);
      $permission70=Permission::create(['name'=>'encargados.show']);*/

      $permission71=Permission::create(['name'=>'cargos.index']);
      $permission72=Permission::create(['name'=>'cargos.create']);
      $permission73=Permission::create(['name'=>'cargos.store']);
      $permission74=Permission::create(['name'=>'cargos.edit']);
      $permission75=Permission::create(['name'=>'cargos.update']);
      $permission76=Permission::create(['name'=>'cargos.destroy']);
      $permission77=Permission::create(['name'=>'cargos.show']);

    

      
      $permission85=Permission::create(['name'=>'horarios.index']);
      $permission86=Permission::create(['name'=>'horarios.create']);
      $permission87=Permission::create(['name'=>'horarios.store']);

      $permission88=Permission::create(['name'=>'horarios.obtenerSucursal']);
      $permission89=Permission::create(['name'=>'horarios.funcionarios']);
      $permission90=Permission::create(['name'=>'horarios.reporteHorario']);
      $permission91=Permission::create(['name'=>'horarios.planillaHorarios']);
   
      $permission93=Permission::create(['name'=>'horarios.obtenerFuncionarios']);
      

      $permission94=Permission::create(['name'=>'bonos.index']);
      $permission95=Permission::create(['name'=>'bonos.create']);
      $permission96=Permission::create(['name'=>'bonos.store']);
      $permission97=Permission::create(['name'=>'bonos.edit']);
      $permission98=Permission::create(['name'=>'bonos.update']);
      $permission99=Permission::create(['name'=>'bonos.destroy']);
      $permission100=Permission::create(['name'=>'bonos.show']);

      $permission101=Permission::create(['name'=>'descuentos.index']);
      $permission102=Permission::create(['name'=>'descuentos.create']);
      $permission103=Permission::create(['name'=>'descuentos.store']);
      $permission104=Permission::create(['name'=>'descuentos.edit']);
      $permission105=Permission::create(['name'=>'descuentos.update']);
      $permission106=Permission::create(['name'=>'descuentos.destroy']);
      $permission107=Permission::create(['name'=>'descuentos.show']);

      $permission108=Permission::create(['name'=>'sanciones.index']);
      $permission109=Permission::create(['name'=>'sanciones.create']);
      $permission110=Permission::create(['name'=>'sanciones.store']);
      $permission111=Permission::create(['name'=>'sanciones.edit']);
      $permission112=Permission::create(['name'=>'sanciones.update']);
      $permission113=Permission::create(['name'=>'sanciones.destroy']);
      $permission114=Permission::create(['name'=>'sanciones.show']);

      
      $permission115=Permission::create(['name'=>'vacaciones.index']);
      $permission116=Permission::create(['name'=>'vacaciones.create']);
      $permission117=Permission::create(['name'=>'vacaciones.store']);
      $permission118=Permission::create(['name'=>'vacaciones.edit']);
      $permission119=Permission::create(['name'=>'vacaciones.update']);
      $permission120=Permission::create(['name'=>'vacaciones.destroy']);
      $permission121=Permission::create(['name'=>'vacaciones.show']);


      $role1->syncPermissions($permission1,$permission2,$permission3,$permission4,$permission5,
      $permission6,$permission7,$permission8,$permission9,$permission10,$permission11,$permission12,
      $permission13,$permission14,$permission15,
      $permission16,$permission17,$permission18,$permission19,$permission20,$permission21,$permission22,
      $permission23,$permission24,$permission25,$permission26,$permission27,
      $permission28,$permission29,$permission30,$permission31,$permission32,$permission33,$permission34,
      $permission35,$permission36,$permission37,
      $permission38,$permission39,$permission40,$permission41,$permission43,$permission44,$permission45,
      $permission46,$permission47,$permission48,$permission49,$permission50,
      $permission51,$permission52,$permission53,$permission54,$permission55,$permission56,$permission57,
      $permission58,$permission59,$permission60,
      $permission61,$permission62,$permission63,$permission64,$permission65,$permission66,$permission67,
      $permission71,$permission72,$permission73,
      $permission74,$permission75,$permission76,$permission77,$permission85,
      $permission86,$permission87,$permission88,$permission89,$permission90,$permission91,
      $permission93,$permission94,$permission95,
      $permission96,$permission97,$permission98,$permission99,$permission100,$permission101,$permission102,
      $permission103,$permission104,$permission105, $permission106,$permission107,$permission108,
      $permission109,$permission110,$permission111,$permission112,$permission113,$permission114,
      $permission115,$permission116,$permission117,$permission118,$permission119,$permission120,$permission121);

      $role4->syncPermissions($permission57,$permission58,$permission59,$permission60,$permission61,$permission62,
      $permission63,$permission64,$permission65,$permission67);
    }
}
