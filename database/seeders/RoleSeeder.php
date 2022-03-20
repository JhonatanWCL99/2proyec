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

      $permission1=Permission::create(['name'=>'home', 'description'=>'Dashboard']);
      $permission2=Permission::create(['name'=>'proveedores.index', 'description'=>'Ver Proveedores']);
      $permission3=Permission::create(['name'=>'proveedores.create', 'description'=>'Crear nuevo Proveedor']);
      $permission4=Permission::create(['name'=>'proveedores.store', 'description'=>'Guarda Proveedor']);
      $permission5=Permission::create(['name'=>'proveedores.edit', 'description'=>'Editar Proveedor']);
      $permission6=Permission::create(['name'=>'proveedores.update', 'description'=>'Actualizar Proveedor']);
      $permission7=Permission::create(['name'=>'proveedores.destroy', 'description'=>'Eliminar Proveedor']);
      $permission8=Permission::create(['name'=>'proveedores.show', 'description'=>'Ver Info Proveedor']);

      $permission9=Permission::create(['name'=>'productos.index', 'description'=>'Ver Productos']);
      $permission10=Permission::create(['name'=>'productos.create', 'description'=>'Crear nuevo Producto']);
      $permission11=Permission::create(['name'=>'productos.store', 'description'=>'Guardar Producto']);
      $permission12=Permission::create(['name'=>'productos.edit', 'description'=>'Editar Producto']);
      $permission13=Permission::create(['name'=>'productos.update', 'description'=>'Actualizar Producto']);
      $permission14=Permission::create(['name'=>'productos.destroy', 'description'=>'Eliminar Producto']);
      $permission15=Permission::create(['name'=>'productos.show', 'description'=>'Info detallada del Producto']);

      
      $permission16=Permission::create(['name'=>'encargados.index', 'description'=>'Ver Encargados']);
      $permission17=Permission::create(['name'=>'encargados.create', 'description'=>'Nuevo Encargado']);
      $permission18=Permission::create(['name'=>'encargados.store', 'description'=>'Guardar Encargado']);
      $permission19=Permission::create(['name'=>'encargados.edit', 'description'=>'Editar Encargado']);
      $permission20=Permission::create(['name'=>'encargados.update', 'description'=>'Actualizar Encargado']);
      $permission21=Permission::create(['name'=>'encargados.destroy', 'description'=>'Eliminar Encargado']);
      $permission22=Permission::create(['name'=>'encargados.show', 'description'=>'Info detallada del Encargado']);

      $permission22=Permission::create(['name'=>'sucursales.index', 'description'=>'Ver Sucursal']);
      $permission23=Permission::create(['name'=>'sucursales.create', 'description'=>'Crear Sucursal']);
      $permission24=Permission::create(['name'=>'sucursales.store', 'description'=>'Guardar Sucursal']);
      $permission25=Permission::create(['name'=>'sucursales.edit', 'description'=>'Editar Sucursal']);
      $permission26=Permission::create(['name'=>'sucursales.update', 'description'=>'Actualizar Sucursal']);
      $permission27=Permission::create(['name'=>'sucursales.destroy', 'description'=>'Eliminar Sucursal']);
      $permission28=Permission::create(['name'=>'sucursales.show', 'description'=>'Info detallada de Sucursal']);

      $permission29=Permission::create(['name'=>'categorias.index', 'description'=>'Ver Categorias']);
      $permission30=Permission::create(['name'=>'categorias.create', 'description'=>'Crear Categoria']);
      $permission31=Permission::create(['name'=>'categorias.store', 'description'=>'Guardar Categoria']);
      $permission32=Permission::create(['name'=>'categorias.edit', 'description'=>'Editar Categoria']);
      $permission33=Permission::create(['name'=>'categorias.update', 'description'=>'Actualizar Categoria']);
      $permission34=Permission::create(['name'=>'categorias.destroy', 'description'=>'Eliminar Categoria']);
      $permission35=Permission::create(['name'=>'categorias.show', 'description'=>'Mostrar Categoria']);
      
      $permission36=Permission::create(['name'=>'productos_proveedores.index', 'description'=>'Ver Producto Proovedor']);
      $permission37=Permission::create(['name'=>'productos_proveedores.create', 'description'=>'Crear  Producto Proovedor']);
      $permission38=Permission::create(['name'=>'productos_proveedores.store', 'description'=>'Guardar Producto Proovedor']);

      $permission39=Permission::create(['name'=>'inventarios.index', 'description'=>'Inventarios']);
      $permission40=Permission::create(['name'=>'inventarios.create', 'description'=>'Crear Inventarios']);
      $permission41=Permission::create(['name'=>'inventarios.store', 'description'=>'Guardar Inventario']);
     

      $permission43=Permission::create(['name'=>'contratos.index', 'description'=>'Contratos']);
      $permission44=Permission::create(['name'=>'contratos.create', 'description'=>' Crear nuevo Contrato']);
      $permission45=Permission::create(['name'=>'contratos.store', 'description'=>'Guardar Contrato']);
      $permission46=Permission::create(['name'=>'contratos.edit', 'description'=>'Editar Contrato']);
      $permission47=Permission::create(['name'=>'contratos.update', 'description'=>'Actualizar Contrato']);
      $permission48=Permission::create(['name'=>'contratos.destroy', 'description'=>'Eliminar Contrato']);
      $permission49=Permission::create(['name'=>'contratos.show', 'description'=>'Mostrar Contratos']);

      $permission50=Permission::create(['name'=>'departamentos.index', 'description'=>'Departamentos']);
      $permission51=Permission::create(['name'=>'departamentos.create', 'description'=>'Crear nuevo Departamento']);
      $permission52=Permission::create(['name'=>'departamentos.store', 'description'=>' Guardar Departamento']);
      $permission53=Permission::create(['name'=>'departamentos.edit', 'description'=>'Editar Departamento']);
      $permission54=Permission::create(['name'=>'departamentos.update', 'description'=>'Actualizar Departamento']);
      $permission55=Permission::create(['name'=>'departamentos.destroy', 'description'=>'Eliminar Departamento']);
      $permission56=Permission::create(['name'=>'departamentos.show', 'description'=>'Mostrar Departamento']);


      $permission57=Permission::create(['name'=>'personales.index', 'description'=>'Informacion del usuario']);
      $permission58=Permission::create(['name'=>'personales.create', 'description'=>'Crear nuevo usuario']);
      $permission62=Permission::create(['name'=>'personales.destroy', 'description'=>'Eliminar Usuario']);

      $permission59=Permission::create(['name'=>'personales.contratar', 'description'=>'Contratar nuevo personal']);
      $permission60=Permission::create(['name'=>'personales.showDetalleContrato', 'description'=>'Ver Contrato del Personal']);
      $permission61=Permission::create(['name'=>'personales.editContratoUser', 'description'=>'Editar Contrato del Personal']);
      
      $permission63=Permission::create(['name'=>'personales.editDatosBasicos', 'description'=>'Editar datos basicos Usuario']);

      $permission64=Permission::create(['name'=>'personales.actualizarContratoUser', 'description'=>'Actualizar Contrato del Personal']);
      $permission65=Permission::create(['name'=>'personales.actualizarDatosBasicos', 'description'=>'Actualizar datos Basicos']);
      $permission66=Permission::create(['name'=>'personales.vencimientoContratos', 'description'=>'Ver vencimiento de contratos']);
      $permission67=Permission::create(['name'=>'personales.filtrarContratos', 'description'=>'Reporte y filtro de contratos']);

/*      $permission68=Permission::create(['name'=>'encargados.update']);
      $permission69=Permission::create(['name'=>'encargados.destroy']);
      $permission70=Permission::create(['name'=>'encargados.show']);*/

      $permission71=Permission::create(['name'=>'cargos.index', 'description'=>'Cargos']);
      $permission72=Permission::create(['name'=>'cargos.create', 'description'=>'Crear nuevo Cargo']);
      $permission73=Permission::create(['name'=>'cargos.store', 'description'=>'Guardar Cargo']);
      $permission74=Permission::create(['name'=>'cargos.edit', 'description'=>'Editar Cargo']);
      $permission75=Permission::create(['name'=>'cargos.update', 'description'=>'Actualizar Cargo']);
      $permission76=Permission::create(['name'=>'cargos.destroy', 'description'=>'Eliminar Cargos']);
      $permission77=Permission::create(['name'=>'cargos.show', 'description'=>'Mostrar Cargos']);

    

      
      $permission85=Permission::create(['name'=>'horarios.index', 'description'=>'Horarios']);
      $permission86=Permission::create(['name'=>'horarios.create', 'description'=>'Crear Horario']);
      $permission87=Permission::create(['name'=>'horarios.store', 'description'=>'Guardar Horario']);

      $permission88=Permission::create(['name'=>'horarios.obtenerSucursal', 'description'=>'Obtener Horario Sucursal']);
      $permission89=Permission::create(['name'=>'horarios.funcionarios', 'description'=>'Ver Funcionarios']);
      $permission90=Permission::create(['name'=>'horarios.reporteHorario', 'description'=>'Ver Reporte Mano de Obra']);
      $permission91=Permission::create(['name'=>'horarios.planillaHorarios', 'description'=>'Ver Planilla de Horarios']);
   
      $permission93=Permission::create(['name'=>'horarios.obtenerFuncionarios', 'description'=>'Obtener horarios de funcionarios']);
      

      $permission94=Permission::create(['name'=>'bonos.index', 'description'=>'Bonos']);
      $permission95=Permission::create(['name'=>'bonos.create', 'description'=>'Crear Bono']);
      $permission96=Permission::create(['name'=>'bonos.store', 'description'=>'Guardar Bono']);
      $permission97=Permission::create(['name'=>'bonos.edit', 'description'=>'Editar Bono']);
      $permission98=Permission::create(['name'=>'bonos.update', 'description'=>'Actualizar Bono']);
      $permission99=Permission::create(['name'=>'bonos.destroy', 'description'=>'Eliminar Bono']);
      $permission100=Permission::create(['name'=>'bonos.show', 'description'=>'Mostrar Bonos']);

      $permission101=Permission::create(['name'=>'descuentos.index', 'description'=>'Descuentos']);
      $permission102=Permission::create(['name'=>'descuentos.create', 'description'=>'Crear Descuento']);
      $permission103=Permission::create(['name'=>'descuentos.store', 'description'=>'Guardar Descuento']);
      $permission104=Permission::create(['name'=>'descuentos.edit', 'description'=>'Editar Descuento']);
      $permission105=Permission::create(['name'=>'descuentos.update', 'description'=>'Actualizar Descuento']);
      $permission106=Permission::create(['name'=>'descuentos.destroy', 'description'=>'Eliminar Descuento']);
      $permission107=Permission::create(['name'=>'descuentos.show', 'description'=>'Mostrar Descuento']);

      $permission108=Permission::create(['name'=>'sanciones.index', 'description'=>'Sanciones']);
      $permission109=Permission::create(['name'=>'sanciones.create', 'description'=>'Crear Sancion']);
      $permission110=Permission::create(['name'=>'sanciones.store', 'description'=>'Guardar Sancion']);
      $permission111=Permission::create(['name'=>'sanciones.edit', 'description'=>'Editar Sancion']);
      $permission112=Permission::create(['name'=>'sanciones.update', 'description'=>'Actualizar Sancion']);
      $permission113=Permission::create(['name'=>'sanciones.destroy', 'description'=>'Eliminar Sancion']);
      $permission114=Permission::create(['name'=>'sanciones.show', 'description'=>'Ver Sanciones']);

      
      $permission115=Permission::create(['name'=>'vacaciones.index', 'description'=>'Ver Vacaciones']);
      $permission116=Permission::create(['name'=>'vacaciones.create', 'description'=>'Crear Vacaciones']);
      $permission117=Permission::create(['name'=>'vacaciones.store', 'description'=>'Guardar Vacaciones']);
      $permission118=Permission::create(['name'=>'vacaciones.edit', 'description'=>'Editar Vacaciones']);
      $permission119=Permission::create(['name'=>'vacaciones.update', 'description'=>'Actualizar Vacaciones']);
      $permission120=Permission::create(['name'=>'vacaciones.destroy', 'description'=>'Eliminar Vacaciones']);
      $permission121=Permission::create(['name'=>'vacaciones.show', 'description'=>'Mostrar Vacaciones']);
      $permission122=Permission::create(['name'=>'inventario', 'description'=>'Menu Inventario']);


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
      $permission115,$permission116,$permission117,$permission118,$permission119,$permission120,$permission121,$permission122);

      $role4->syncPermissions($permission57,$permission58,$permission59,$permission60,$permission61,$permission62,
      $permission63,$permission64,$permission65,$permission67);
    }
}
