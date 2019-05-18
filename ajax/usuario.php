<?php
session_start();
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellidoP=isset($_POST["apellidoP"])? limpiarCadena($_POST["apellidoP"]):"";
$apellidoM=isset($_POST["apellidoM"])? limpiarCadena($_POST["apellidoM"]):"";
$fechaNac=isset($_POST["fechaNac"])? limpiarCadena($_POST["fechaNac"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$mail=isset($_POST["mail"])? limpiarCadena($_POST["mail"]):"";
$Identificacion=isset($_POST["Identificacion"])? limpiarCadena($_POST["Identificacion"]):"";
$curp=isset($_POST["curp"])? limpiarCadena($_POST["curp"]):"";
$puesto=isset($_POST["puesto"])? limpiarCadena($_POST["puesto"]):"";
$fechaAdmision=isset($_POST["fechaAdmision"])? limpiarCadena($_POST["fechaAdmision"]):"";
$genero=isset($_POST["genero"])? limpiarCadena($_POST["genero"]):"";
$noimss=isset($_POST["nomss"])? limpiarCadena($_POST["nomss"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$numeroEmpleado=isset($_POST["numeroEmpleado"])? limpiarCadena($_POST["numeroEmpleado"]):"";
$numeroSuc=isset($_POST["numeroSuc"])? limpiarCadena($_POST["numeroSuc"]):"";
$calle=isset($_POST["calle"])? limpiarCadena($_POST["calle"]):"";
$numeroExt=isset($_POST["numeroExt"])? limpiarCadena($_POST["numeroExt"]):"";
$numeroInt=isset($_POST["numeroInt"])? limpiarCadena($_POST["numeroInt"]):"";
$colonia=isset($_POST["colonia"])? limpiarCadena($_POST["colonia"]):"";
$municipio=isset($_POST["municipio"])? limpiarCadena($_POST["municipio"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$cp=isset($_POST["cp"])? limpiarCadena($_POST["cp"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";
$foto=isset($_POST["foto"])? limpiarCadena($_POST["foto"]):"";
$condicion=isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name']))
		{
			$foto=$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["foto"]["name"]);
			if ($_FILES['foto']['type'] == "image/jpg" || $_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/png")
			{
				$foto = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["foto"]["tmp_name"], "../files/usuarios/" . $foto);
			}
		}
		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);
xdebug_var_dump($idusuario);
		if (empty($idusuario)){
		$rspta=$usuario->insertar($nombre,$apellidoP,$apellidoM,$fechaNac,$telefono,$mail,$Identificacion,$curp,$puesto,$fechaAdmision,$genero,$noimss,$login,$clavehash,
			$rfc,$numeroEmpleado,$numeroSuc,$calle,$numeroExt,$numeroInt,$colonia,$municipio,$ciudad,$estado,$cp,$pais,$foto,$condicion,$_POST['permiso']);
			echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario" . $rspta;
		}
		else {
		$rspta=$usuario->editar($idusuario,$nombre,$apellidoP,$apellidoM,$fechaNac,$telefono,$mail,$Identificacion,$curp,$puesto,$fechaAdmision,$genero,$noimss,$login,$clavehash,
			$rfc,$numeroEmpleado,$numeroSuc,$calle,$numeroExt,$numeroInt,$colonia,$municipio,$ciudad,$estado,$cp,$pais,$foto,$condicion,$_POST['permiso']);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$usuario->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuario->activar($idusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->apellidoP,
 				"3"=>$reg->apellidoM,
 				"4"=>$reg->telefono,
 				"5"=>$reg->email,
 				"6"=>"<img src='../files/usuarios/".$reg->foto."' height='50px' width='50px' >",
 				"7"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
				}
	break;

	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['login']=$fetch->login;

	        //Obtenemos los permisos del usuario
	    	$marcados = $usuario->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			in_array(2,$valores)?$_SESSION['almacen']=1:$_SESSION['almacen']=0;
			in_array(3,$valores)?$_SESSION['compras']=1:$_SESSION['compras']=0;
			in_array(4,$valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
			in_array(5,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
			in_array(6,$valores)?$_SESSION['consultac']=1:$_SESSION['consultac']=0;
			in_array(7,$valores)?$_SESSION['consultav']=1:$_SESSION['consultav']=0;

	    }
	    echo json_encode($fetch);
	break;

	case 'salir':
		//Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;
}
?>
