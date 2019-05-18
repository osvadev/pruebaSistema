<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$apellidoP,$apellidoM,$fechaNac,$telefono,$mail,$Identificacion,$curp,$puesto,$fechaAdmision,$genero,$noimss,$login,$clavehash,$rfc,$numeroEmpleado,$numeroSuc,$calle,$numeroExt,$numeroInt,$colonia,$municipio,$ciudad,$estado,$cp,$pais,$foto,$condicion)
	{
		$sql="INSERT INTO usuario (nombre,apellidoP,apellidoM,fechaNac,telefono,mail,Identificacion,curp,puesto,fechaAdmision,genero,noimss,login,clave,rfc,numeroEmpleado,numeroSuc,calle,numeroExt,numeroInt,colonia,municipio,ciudad,estado,cp,pais,foto,condicion)
		VALUES ('$nombre','$apellidoP','$apellidoM','$fechaNac','$telefono','$mail','$Identificacion','$curp','$puesto','$fechaAdmision','$genero','$noimss','$login','$clavehash','$rfc','$numeroEmpleado','$numeroSuc','$calle','$numeroExt','$numeroInt','$colonia','$municipio','$ciudad','$estado','$cp','$pais','$foto','$condicion')";
		return ejecutarConsulta($sql);
		$idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuarionew','$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idusuario,$nombre,$apellidoP,$apellidoM,$fechaNac,$telefono,$mail,$Identificacion,$curp,$puesto,$fechaAdmision,$genero,$noimss,$login,$clave,$rfc,$numeroEmpleado,$numeroSuc,$calle,$numeroExt,
	$numeroInt,$colonia,$municipio,$ciudad,$estado,$cp,$pais,$foto,$condicion)
	{
		$sql = "UPDATE usuario SET idusuario='$idusuario',nombre='$nombre',apellidoP='$apellidoP',apellidoM='$apellidoM',fechaNac='$fechaNac',telefono='$telefono',mail='$mail',Identificacion='$Identificacion',curp='$curp',puesto='$puesto',fechaAdmision='$fechaAdmision',genero='$genero',noimss='$noimss',login='$login',clave='$clave',rfc='$rfc',numeroEmpleado='$numeroEmpleado',numeroSuc='$numeroSuc',calle='$calle',numeroExt='$numeroExt',numeroInt='$numeroInt',colonia='$colonia',municipio='$municipio',ciudad='$ciudad',estado='$estado',cp='$cp',pais='$pais',foto='$foto',condicion='$condicion' WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
	/*$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;*/
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT idusuario,nombre,apellidoP,apellidoM,fechaNac,telefono,mail,Identificacion,curp,puesto,fechaAdmision,genero,noimss,login,clave,rfc,numeroEmpleado,numeroSuc,
 calle,numeroExt,numeroInt,colonia,municipio,ciudad,estado,cp,pais,foto,condicion FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'";
    	return ejecutarConsulta($sql);
    }
}

?>
