<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Proveedor
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$tipoDoc,$numDoc,$direccion,$email,$telefono)
	{
		$sql="INSERT INTO Proveedor (nombre,tipoDoc,numDoc,direccion,email,telefono)
		VALUES ('$nombre','$tipoDoc','$numDoc','$direccion','$email','$telefono')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idProveedor,$nombre,$tipoDoc,$numDoc,$direccion,$email,$telefono)
	{
		$sql="UPDATE Proveedor SET nombre='$nombre',tipoDoc='$tipoDoc',numDoc='$numDoc',direccion='$direccion',email='$email',telefono='$telefono' WHERE idProveedor='$idProveedor'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idProveedor)
	{
		$sql="DELETE FROM Proveedor WHERE $idProveedor='$idProveedor'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idProveedor)
	{
		$sql="SELECT * FROM Proveedor WHERE idProveedor='$idProveedor'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listarp()
	{
		$sql="SELECT * FROM Proveedor ";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros 
	/*public function listarc()
	{
		$sql="SELECT * FROM persona WHERE tipo_persona='Cliente'";
		return ejecutarConsulta($sql);		
	}*/
}

?>