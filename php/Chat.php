<?php
include_once 'ChatQuery.php';


class ChatAPI
{


    function getChatsUsuario($Usuario_id)
    {

        $Chat = new Chat();
        $arrChats = array();
        $arrChats["Datos"] = array();

        $res = $Chat->getChatsUsuario($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Chat_id" => $row['Chat_id'],
                    "Alojamiento_id" => $row['Alojamiento_id'],
                    "UsuarioVendedor_id" => $row['UsuarioVendedor_id'],
                    "imagenAlojamiento" => base64_encode(($row['imagenAlojamiento'])),
                    "nombre" => $row['nombre'],
                    "correo" => $row['correo'],
                    "nombreCompleto" => $row['nombreCompleto'],
                    "username" => $row['username']
                );
                array_push($arrChats["Datos"], $obj);
            }
            echo json_encode($arrChats["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }


    function getMensajes($Chat_id)
    {

        $Chat = new Chat();
        $arrChats = array();
        $arrChats["Datos"] = array();

        $res = $Chat->getTodosMensajesChat($Chat_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Mensaje_id" => $row['Mensaje_id'],
                    "Alojamiento_id" => $row['Alojamiento_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "Chat_id" => $row['Chat_id'],
                    "texto" => $row['texto'],
                    "tiempoRegistro" => $row['tiempoRegistro'],
                    "fotoPerfil" => base64_encode(($row['fotoPerfil'])),
                    "nombreUsuario" => $row['nombreUsuario']
                );
                array_push($arrChats["Datos"], $obj);
            }
            echo json_encode($arrChats["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarChat($Usuario_1,$Usuario_2, $Alojamiento_id)
    {
        $Chat = new Chat();
        $Chat->insertarChat($Usuario_1,$Usuario_2, $Alojamiento_id);
    }

    function insertarMensaje($Chat_id,$Usuario_id, $Texto)
    {
        $Chat = new Chat();
        $Chat->insertarMensaje($Chat_id,$Usuario_id, $Texto);
    }

}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "insertarChat":
            session_start();
            if (!empty($_SESSION)) {
                    $id = $_SESSION['Usuario_id'];
                    $var = new ChatAPI();
                    $var->insertarChat($id,$_POST['Usuario_2'],$_POST['Alojamiento_id']);
                    echo '1'; // Se hizo de manera satisfactoria
            }
            else{
                echo '0'; // No hay Sesión
            }
         
        break;

        case "obtenerChats":
            session_start();
            if (!empty($_SESSION)) {
                    $Usuario_id = $_SESSION['Usuario_id'];
                    $var = new ChatAPI();
                    $var->getChatsUsuario($Usuario_id);
            }else{
                  echo '0'; // No hay Sesión
            }
        break;
        
        case "obtenerMensajes";
            $var = new ChatAPI();
            $var->getMensajes($_POST['Chat_id']);
        break;

        case "insertarMensaje":

            session_start();
            if (!empty($_SESSION)) {          
                $id = $_SESSION['Usuario_id'];
                $var = new ChatAPI();
                $var->insertarMensaje($_POST['Chat_id'],$id,$_POST['Texto']);
                echo '1'; // Se hizo de manera satisfactoria
            }
            else{
                echo '0'; // No hay Sesión
            }
        break;



    }
}

