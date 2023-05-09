
<?php
include_once 'db.php';

class Alojamiento extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos Alojamiento

    function getAlojamientoData($Alojamiento_id)
    {
        $get = "CALL sp_GestionAlojamiento(
            'G', # Operacion
            $Alojamiento_id, # Id
            NULL, # Usuario Vendedor Id
            NULL, # Usuario Arrendador Id
            NULL,  # Nombre
            NULL,  # Caracteristicas
            NULL,  # Imagen Alojamiento
            NULL,  # Direccion
            NULL  # Renta
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // QUERY Get Datos Todos Alojamientos

    function getAllAlojamientosData()
    {
        $get = "CALL sp_GestionAlojamiento(
            'A', # Operacion
            NULL, # Id
            NULL, # Usuario Vendedor Id
            NULL, # Usuario Arrendador Id
            NULL,  # Nombre
            NULL,  # Caracteristicas
            NULL,  # Imagen Alojamiento
            NULL,  # Direccion
            NULL  # Renta
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

        // QUERY Get Datos Todos Alojamientos Usuario Arrendador

    function getAllAlojamientosUsuarioVendedorData($Usuario_id)
    {
        $get = "CALL sp_GestionAlojamiento(
            'Z', # Operacion
            NULL, # Id
            $Usuario_id, # Usuario Vendedor Id
            NULL, # Usuario Arrendador Id
            NULL,  # Nombre
            NULL,  # Caracteristicas
            NULL,  # Imagen Alojamiento
            NULL,  # Direccion
            NULL  # Renta
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

            // QUERY Get Datos Todos Alojamientos Usuario Arrendador

    function getAllAlojamientosUsuarioArrendadorData($Usuario_id)
    {
        $get = "CALL sp_GestionAlojamiento(
            'C', # Operacion
            NULL, # Id
            NULL, # Usuario Vendedor Id
            $Usuario_id, # Usuario Arrendador Id
            NULL,  # Nombre
            NULL,  # Caracteristicas
            NULL,  # Imagen Alojamiento
            NULL,  # Direccion
            NULL  # Renta
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    
    function getAlojamientosSearch($nombre)
    {
        $get = "CALL sp_GestionAlojamiento(
            'X', # Operacion
            NULL, # Id
            NULL, # Usuario Vendedor Id
            NULL, # Usuario Arrendador Id
            '$nombre',  # Nombre
            NULL,  # Caracteristicas
            NULL,  # Imagen Alojamiento
            NULL,  # Direccion
            NULL  # Renta
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Alojamiento

    function insertarAlojamiento($UsuarioVendedor_id, $Nombre,$Caracteristicas, $Imagen, $Direccion,$Renta)
    {
        $Imagen = mysqli_escape_string($this->myCon(), $Imagen); //IMAGEN
        $insert = "CALL sp_GestionAlojamiento(
            'I', # Operacion
            NULL, # Id
            $UsuarioVendedor_id, # Usuario Vendedor Id
            NULL, # Usuario Arrendador Id
            '$Nombre',  # Nombre
            '$Caracteristicas',  # Caracteristicas
            '$Imagen',  # Imagen Alojamiento
            '$Direccion',  # Direccion
             $Renta  # Renta
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

    // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------
    // QUERY Actualizar Alojamiento

    function actualizarAlojamiento($Alojamiento_id, $Nombre,$Caracteristicas, $Imagen, $Direccion,$Renta)
    {
        $Imagen = mysqli_escape_string($this->myCon(), $Imagen); //IMAGEN
        $update = "CALL sp_GestionAlojamiento(
            'E', # Operacion
            $Alojamiento_id, # Id
            NULL, # Usuario Vendedor Id
            NULL, # Usuario Arrendador Id
            '$Nombre',  # Nombre
            '$Caracteristicas',  # Caracteristicas
            '$Imagen',  # Imagen Alojamiento
            '$Direccion',  # Direccion
            $Renta  # Renta
        );";
        $query = $this->connect()->query($update);
        return $query;
    }

    // QUERY Actualizar Ocupamiento

    function actualizarAlojamientoEstado($Alojamiento_id, $UsuarioArrendador_id)
    {
        $update = "CALL sp_GestionAlojamiento(
            'V', # Operacion
            $Alojamiento_id, # Id
            NULL, # Usuario Vendedor Id
            $UsuarioArrendador_id, # Usuario Arrendador Id
            NULL,  # Nombre
            NULL,  # Caracteristicas
            NULL,  # Imagen Alojamiento
            NULL,  # Direccion
            NULL  # Renta

        );";
        $query = $this->connect()->query($update);
        return $query;
    }


    // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
    // QUERY Eliminar Alojamiento

    function eliminarAlojamiento($Alojamiento_id)
    {
        $delete = "CALL sp_GestionAlojamiento(
            'D', # Operacion
            $Alojamiento_id, # Id
            NULL, # Usuario Vendedor Id
            NULL, # Usuario Arrendador Id
            NULL,  # Nombre
            NULL,  # Caracteristicas
            NULL,  # Imagen Alojamiento
            NULL,  # Direccion
            NULL  # Renta
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }
}

?>
