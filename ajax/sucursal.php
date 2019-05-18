<?php
require_once "../modelos/Sucursal.php";

$sucursal=new Sucursal();

$idSucursal=isset($_POST["idSucursal"])? limpiarCadena($_POST["idSucursal"]):"";
$nombresuc=isset($_POST["nombresuc"])? limpiarCadena($_POST["nombresuc"]):"";
$numsucursal=isset($_POST["numsucursal"])? limpiarCadena($_POST["numsucursal"]):"";
$telefonosuc=isset($_POST["telefonosuc"])? limpiarCadena($_POST["telefonosuc"]):"";
$correosuc=isset($_POST["correosuc"])? limpiarCadena($_POST["correosuc"]):"";
$calle=isset($_POST["calle"])? limpiarCadena($_POST["calle"]):"";
$numeroExt=isset($_POST["numeroExt"])? limpiarCadena($_POST["numeroExt"]):"";
$numeroInt=isset($_POST["numeroInt"])? limpiarCadena($_POST["numeroInt"]):"";
$colonia=isset($_POST["colonia"])? limpiarCadena($_POST["colonia"]):"";
$municipio=isset($_POST["municipio"])? limpiarCadena($_POST["municipio"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$cp=isset($_POST["cp"])? limpiarCadena($_POST["cp"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

			$rspta=$sucursal->insertar($nombresuc,$numsucursal,$telefonosuc,$correosuc,$calle,$numeroExt,$numeroInt,$colonia,$municipio,$ciudad,$estado,$cp,$pais);
			echo $rspta ? "Sucursal registrado" : "Sucursal no se pudo registrar";
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($idarticulo);
 		echo $rspta ? "Artículo Desacti	vado" : "Artículo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$articulo->activar($idarticulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$sucursal->mostrar($idSucursal);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$sucursal->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idSucursal.')"><i class="fa fa-pencil"></i></button>',
 				"1"=>$reg->nombresuc,
 				"2"=>$reg->numSucursal,
 				"4"=>$reg->telefonosuc,
 				"3"=>$reg->correosuc
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
	break;
}
?>
