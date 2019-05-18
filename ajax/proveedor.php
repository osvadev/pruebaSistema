<?php 
require_once "../modelos/Proveedor.php";

$proveedor=new Proveedor();

$idProveedor=isset($_POST["idProveedor"])? limpiarCadena($_POST["idProveedor"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipoDoc=isset($_POST["tipoDoc"])? limpiarCadena($_POST["tipoDoc"]):"";
$numDoc=isset($_POST["numDoc"])? limpiarCadena($_POST["numDoc"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idProveedor)){
			$rspta=$proveedor->insertar($nombre,$tipoDoc,$numDoc,$direccion,$email,$telefono);
			echo $rspta ? "Proveedor registrado" : "Proveedor no se pudo registrar";
		}
		else {
			$rspta=$proveedor->editar($idProveedor,$nombre,$tipoDoc,$numDoc,$direccion,$email,$telefono);
			echo $rspta ? "Proveedor actualizado" : "Proveedor no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$proveedor->eliminar($idProveedor);
 		echo $rspta ? "Proveedor eliminado" : "Proveedor no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$proveedor->mostrar($idProveedor);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarp':
		$rspta=$proveedor->listarp();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idProveedor.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idProveedor.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->tipoDoc,
 				"3"=>$reg->numDoc,
                "4"=>$reg->direccion,
 				"5"=>$reg->email,
 				"6"=>$reg->telefono
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	/*case 'listarc':
		$rspta=$nombre->listarc();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idProveedor.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idProveedor.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->tipoDoc,
 				"3"=>$reg->numDoc,
 				"4"=>$reg->email,
 				"5"=>$reg->telefono
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;*/


}
?>