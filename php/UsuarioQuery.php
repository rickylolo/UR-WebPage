
<?php
include_once 'db.php';

class User extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------
    // QUERY Iniciar Sesion Usuario 

    function IniciarSesion($Username, $password)
    {
        $get = "CALL sp_GestionUsuario(
            'L', #Operacion
            NULL, #Id Usuario
            NULL, # Nombres
            NULL, # Apellidos
            NULL, # Ocupacion
            NULL, # Edad
            NULL, # Foto Perfil
            NULL, # Correo
            '$Username', # Nombre de usuario
            '$password', # Contraseña
            NULL, # Descripcion
            NULL, # Direccion
            NULL  # noTelefono   
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // QUERY Get Datos Usuario

    function getUserData($Usuario_id)
    {
        $get = "CALL sp_GestionUsuario(
            'G', #Operacion
            $Usuario_id, #Id Usuario
            NULL, # Nombres
            NULL, # Apellidos
            NULL, # Ocupacion
            NULL, # Edad
            NULL, # Foto Perfil
            NULL, # Correo
            NULL, # Nombre de usuario
            NULL, # Contraseña
            NULL, # Descripcion
            NULL, # Direccion   
            NULL  # noTelefono   
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Usuario

    function insertarUsuario($Nombres, $Apellidos, $Ocupacion, $Edad, $FotoPerfil, $Correo, $Username, $Contraseña,  $Descripcion, $Direccion, $NoTelefono)
    {
        $FotoPerfil = mysqli_escape_string($this->myCon(), $FotoPerfil); //IMAGEN
        $insert = "CALL sp_GestionUsuario(
            'I', #Operacion
            NULL, #Id Usuario
            '$Nombres', # Nombres
            '$Apellidos', # Apellidos
            '$Ocupacion', # Ocupacion
            $Edad, # Edad
            '$FotoPerfil', # Foto Perfil
            '$Correo', # Correo
            '$Username', # Nombre de usuario
            '$Contraseña', # Contraseña
            '$Descripcion', # Descripcion
            '$Direccion',  # Direccion   
            '$NoTelefono'  # Direccion  
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

    // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------
    // QUERY Actualizar Usuario

    function actualizarUser($Usuario_id, $Nombres, $Apellidos, $Ocupacion, $Edad, $FotoPerfil, $Correo, $Username, $Contraseña,  $Descripcion, $Direccion,$NoTelefono)
    {
        $FotoPerfil = mysqli_escape_string($this->myCon(), $FotoPerfil); //IMAGEN
        $update = "CALL sp_GestionUsuario(
            'E', #Operacion
            $Usuario_id, #Id Usuario
            '$Nombres', # Nombres
            '$Apellidos', # Apellidos
            '$Ocupacion', # Ocupacion
            $Edad, # Edad
            '$FotoPerfil', # Foto Perfil
            '$Correo', # Correo
            '$Username', # Nombre de usuario
            '$Contraseña', # Contraseña
            '$Descripcion', # Descripcion
            '$Direccion',  # Direccion   
            '$NoTelefono'  # Direccion  
        );";
        $query = $this->connect()->query($update);
        return $query;
    }
}

?>
