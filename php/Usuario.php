<?php
include_once 'UsuarioQuery.php';





class usuarioAPI
{
    function seleccionLoggeo($email, $password)
    {

        $user = new User();
        $arrUsers = array();
        $arrUsers["Datos"] = array();

        $res = $user->IniciarSesion($email, $password);

        if ($res) { // Entra si hay información
            session_start();
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $obj = array(
                    "Usuario_id" => $row['Usuario_id']
                );
                $_SESSION['Usuario_id'] = $obj["Usuario_id"];
                array_push($arrUsers["Datos"], $obj);
            }
            echo json_encode($arrUsers["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getUserData($Usuario_id)
    {
        
        $user = new User();
        $arrUsers = array();
        $arrUsers["Datos"] = array();

        $res = $user->getUserData($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $obj = array( 
                    "Usuario_id" => $row['Usuario_id'],
                    "nombres" => $row['nombres'],
                    "apellidos" => $row['apellidos'],
                    "ocupacion" => $row['ocupacion'],
                    "edad" => $row['edad'],
                    "fotoPerfil" => base64_encode(($row['fotoPerfil'])),
                    "correo" => $row['correo'],
                    "username" => $row['username'],
                    "descripcion" => $row['descripcion'],
                    "direccion" => $row['direccion']
                );
                array_push($arrUsers["Datos"], $obj);
            }
            echo json_encode($arrUsers["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarUser($Nombres,$Apellidos,$Ocupacion,$Edad,$FotoPerfil,$Correo,$Username,$Contraseña,$Descripcion,$Direccion)
     {
        $user = new User();
        $user->insertarUsuario($Nombres,$Apellidos,$Ocupacion,$Edad,$FotoPerfil,$Correo,$Username,$Contraseña,$Descripcion,$Direccion);
    }

    function actualizarUser($Usuario_id,$Nombres,$Apellidos,$Ocupacion,$Edad,$FotoPerfil,$Correo,$Username,$Contraseña,$Descripcion,$Direccion)
    {
        $user = new User();
        $user->actualizarUser($Usuario_id,$Nombres,$Apellidos,$Ocupacion,$Edad,$FotoPerfil,$Correo,$Username,$Contraseña,$Descripcion,$Direccion);
    }



    function cerrarSesion()
    {
        session_start();
        session_destroy();
        header("Location:index.php");
        exit();
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "iniciarSesion":
            $var = new usuarioAPI();
            $var->seleccionLoggeo($_POST['username'], $_POST['password']);
            break;
        case "registrarUsuario":
            $binariosImagen = '';
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != NULL) {
                 $tipoArchivo = $_FILES['file']['type'];
                $nombreArchivo = $_FILES['file']['name'];
                $tamanoArchivo = $_FILES['file']['size'];
                $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                $var = new usuarioAPI();
                $var->insertarUser($_POST['Nombres'], $_POST['Apellidos'], $_POST['Ocupacion'],$_POST['Edad'], $binariosImagen,  $_POST['Correo'], $_POST['Username'], $_POST['Contraseña'], $_POST['Descripcion'],$_POST['Direccion']);
            }
            else{
                echo 'Imagen No Cargada';
            }
           
            break;
        case "actualizarUser":
            $binariosImagen = '';
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != NULL) {
                $tipoArchivo = $_FILES['file']['type'];
                $nombreArchivo = $_FILES['file']['name'];
                $tamanoArchivo = $_FILES['file']['size'];
                $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
            }
            session_start();
            $id = $_SESSION['Usuario_id'];
            $rol = $_SESSION['rolUsuario'];
            $var = new usuarioAPI();
              $var->actualizarUser($id,$_POST['Nombres'], $_POST['Apellidos'], $_POST['Ocupacion'],$_POST['Edad'], $binariosImagen,  $_POST['Correo'], $_POST['Username'], $_POST['Contraseña'], $_POST['Descripcion'],$_POST['Direccion']);
            break;
        case "obtenerDataUsuario":

            session_start();
            if (!empty($_SESSION)) {
                $id = $_SESSION['Usuario_id'];
                $var = new usuarioAPI();
                $var->getUserData($id);
            }
            else{
                echo '0';
            }
            break;
    }
}

//Cerrar Sesión
if (isset($_GET['logout'])) {
    $var = new usuarioAPI();
    $var->cerrarSesion();
}
