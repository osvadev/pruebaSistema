<?php
        //incluimos inicialmente la conexion a bdcrm
require "../config/Conexion.php";

Class Cliente
{
    //implementamos nuestro constructor
    public function __construct()
    {

    }
    //implementamos un metodo para insertar registros
    public function insertar($nombre,$apellido_paterno,$apellido_materno,$fecha_nacimiento,$direccion,$telefono,$email,$identificacion)
    {
        $sql="INSERT INTO cliente(nombre,apellido_paterno,apellido_materno,fecha_nacimiento,direccion,telefono,email,identificacion)
    VALUES ('$nombre','$apellido_paterno','$apellido_materno','$fecha_nacimiento','$direccion','$telefono','$email','$identificacion')";
        return ejecutarConsulta($sql);
    }
    //implementamos un metodo para editar registros
    public function editar($idcliente,$nombre,$apellido_paterno,$apellido_materno,$fecha_nacimiento,$direccion,$telefono,$email,$identificacion)
    {
        $sql="UPDATE cliente SET nombre='$nombre',apellido_paterno='$apellido_paterno',apellido_materno='$apellido_materno',fecha_nacimiento='$fecha_nacimiento',direccion='$direccion',telefono='$telefono',email='$email',identificacion='$identificacion' WHERE idcliente='$idcliente'";
        return ejecutarConsulta($sql);
    }
    //implementamos un metodo para eliminar categorias
    public function eliminar($idcliente)
    {
        $sql="DELETE FROM cliente WHERE idcliente='$idcliente'";
        return ejecutarConsulta($sql);
    }
    //implementamos un metodo para mostrat los regsitros a modificar
    public function mostrar($idcliente)
    {
        $sql="SELECT * FROM  cliente WHERE idcliente='$idcliente'";
    return ejecutarConsultaSimpleFila($sql);
    }
    //implementamos un metodo para listar registros
    public function listarc()
    {
        $sql="SELECT * FROM cliente";
        return ejecutarConsulta($sql);
    }







}