<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['acceso']=="1")
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Usuario <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Condicion</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Condicion</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                              <input type="hidden" name="idusuario" id="idusuario">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Apellido Paterno(*):</label>
                            <input type="text" class="form-control" name="apellidoP" id="apellidoP" maxlength="20" placeholder="Apellido Paterno" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Apellido Materno(*):</label>
                            <input type="text" class="form-control" name="apellidoM" id="apellidoM" maxlength="20" placeholder="Apellido Materno" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha de Nacimiento:</label>
                            <input type="text" class="form-control" name="fechaNac" id="fechaNac" placeholder="Fecha de Nacimiento" maxlength="70">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Teléfono(*):</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="Teléfono" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="mail" id="mail" maxlength="50" placeholder="Email">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Identificacion:</label>
                            <input type="text" class="form-control" name="Identificacion" id="Identificacion" maxlength="20" placeholder="Identificacion">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Login (*):</label>
                            <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Login" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>CLAVE (*):</label>
                          <input type="password" class="form-control" name="clave" id="clave" maxlength="20" placeholder="clave" >
                        </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>CURP (*):</label>
                            <input type="text" class="form-control" name="curp" id="curp" maxlength="64" placeholder="CURP" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>PUESTO:</label>
                            <input type="text" class="form-control" name="puesto" id="puesto" maxlength="64" placeholder="PUESTO">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha de Admision (*):</label>
                            <input type="text" class="form-control" name="fechaAdmision" id="fechaAdmision" maxlength="64" placeholder="Admision" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>GENERO (*):</label>
                            <input type="text" class="form-control" name="genero" id="genero" maxlength="64" placeholder="GENERO" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>No IMSS:</label>
                            <input type="text" class="form-control" name="noimss" id="noimss" maxlength="64" placeholder="IMSS">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>RFC:</label>
                            <input type="text" class="form-control" name="rfc" id="rfc" maxlength="64" placeholder="RFC">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>NUMERO DE EMPLEADO (*):</label>
                            <input type="text" class="form-control" name="numeroEmpleado" id="numeroEmpleado" maxlength="64" placeholder="EMPLEADO" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>NUMERO DE SUCURSAL (*):</label>
                            <input type="text" class="form-control" name="numeroSuc" id="numeroSuc" maxlength="64" placeholder="SUCURSAL" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>CALLE(*):</label>
                            <input type="text" class="form-control" name="calle" id="calle" maxlength="64" placeholder="CALLE" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>NUMERO EXTERIOR:</label>
                            <input type="text" class="form-control" name="numeroExt" id="numeroExt" maxlength="64" placeholder="NUMERO EXTERIOR" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>NUMERO INTERIOR:</label>
                            <input type="text" class="form-control" name="numeroInt" id="numeroInt" maxlength="64" placeholder="NUMERO INTERIOR">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>COLONIA(*):</label>
                            <input type="text" class="form-control" name="colonia" id="colonia" maxlength="64" placeholder="COLONIA" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>MUNICIPIO(*):</label>
                            <input type="text" class="form-control" name="municipio" id="municipio" maxlength="64" placeholder="MUNICIPIO" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>CIUDAD(*):</label>
                            <input type="text" class="form-control" name="ciudad" id="ciudad" maxlength="64" placeholder="CIUDAD" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>ESTADO(*):</label>
                            <input type="text" class="form-control" name="estado" id="estado" maxlength="64" placeholder="ESTADO" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>C.P.(*):</label>
                            <input type="text" class="form-control" name="cp" id="cp" maxlength="64" placeholder="C.P." >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>PAIS(*):</label>
                            <input type="text" class="form-control" name="pais" id="pais" maxlength="64" placeholder="PAIS" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>FOTO:</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>CONDICION(*):</label>
                            <select class="form-control select" name="">
                              <option value="0">INACTIVO</option>
                              <option value="1">ACTIVO</option>
                            </select>
                          </div>
                          <!-- <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Permisos:</label>
                            <ul style="list-style: none;" id="permisos">

                            </ul>
                          </div> -->
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript" src="scripts/usuario.js"></script>

<?php
}
ob_end_flush();
?>
