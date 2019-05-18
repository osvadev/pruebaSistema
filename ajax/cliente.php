<?php
require_once "../modelos/Cliente.php";

$cliente = new Cliente();

$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido_paterno=isset($_POST["apellido_paterno"])? limpiarCadena($_POST["apellido_paterno"]):"";
$apellido_materno=isset($_POST["apellido_materno"])? limpiarCadena($_POST["apellido_materno"]):"";
$fecha_nacimiento=isset($_POST["fecha_nacimiento"])? limpiarCadena($_POST["fecha_nacimiento"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$identificacion=isset($_POST["identificacion"])? limpiarCadena($_POST["identificacion"]):"";
$compras=isset($_POST["compras"])? limpiarCadena($_POST["compras"]):"";
$numero_tiket=isset($_POST["numero_tiket"])? limpiarCadena($_POST["numero_tiket"]):"";
$numero_trans=isset($_POST["numero_trans"])? limpiarCadena($_POST["numero_trans"]):"";
$puntosA=isset($_POST["puntosA"])? limpiarCadena($_POST["puntosA"]):"";
$puntosR=isset($_POST["puntosR"])? limpiarCadena($_POST["puntosR"]):"";
$puntosT=isset($_POST["puntosT"])? limpiarCadena($_POST["puntosT"]):"";
$fecha_insercion=isset($_POST["fecha_insercion"])? limpiarCadena($_POST["fecha_insercion"]):"";
$origen_programa=isset($_POST["origen_programa"])? limpiarCadena($_POST["origen_programa"]):"";
$nivel_programa=isset($_POST["nivel_programa"])? limpiarCadena($_POST["nivel_programa"]):"";
$condicion=isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";
$forma_pago=isset($_POST["forma_pago"])? limpiarCadena($_POST["forma_pago"]):"";
$idUsuario=isset($_POST["idUsuario"])? limpiarCadena($_POST["idUsuario"]):"";
$idSucursal=isset($_POST["idSucursal"])? limpiarCadena($_POST["idSucursal"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
        if (empty($idcliente)){
            $rspta=$cliente->insertar($nombre,$apellido_paterno,$apellido_materno,$fecha_nacimiento,$direccion,$telefono,$email,$identificacion);
            echo $rspta ? "Cliente registrado" : "Cliente no se pudo registrar";
        }
        else{
            $rspta=$cliente->editar($idcliente,$nombre,$apellido_paterno,$apellido_materno,$fecha_nacimiento,$direccion,$telefono,$email,$identificacion);
            echo $rspta ? "Cliente actualizado" : "Cliente no se pudo actualizar";
        }
    break;

    case 'eliminar':
        $rspta=$cliente->eliminar($idcliente);
        echo $rspta ? "Cliente eliminado" : "Cliente no se pudo eliminar";
        break;

    case 'mostrar':
        $rspta=$cliente->mostrar($idcliente);
        //codificar el resultado utlizando json
    echo json_encode($rspta);
    break;

    case 'listar':
        $rspta= $cliente->listarc();
        //declaramos un array
        $data=Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>'.
                    '<button class="btn btn-danger" onclick="eliminar('.$reg->idcliente.')"><i class="fa fa-trash"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->apellido_paterno,
                "3"=>$reg->apellido_materno,
                "4"=>$reg->fecha_nacimiento,
                "5"=>$reg->direccion,
                "6"=>$reg->telefono,
                "7"=>$reg->email,
                "8"=>$reg->identificacion
            );
        }
        $results = array(
            "sEcho"=>1, //informacion para el datatables
            "iTotalRecords"=>count($data),//enviamos el total de registros al datatables
            "iTotalDisplayRecords"=>count($data), //enviamos el total de registros al visualizador
            "aaData"=>$data);
        echo json_encode($results);

        break;
}