<?php
include_once 'AlojamientoQuery.php';





class AlojamientoAPI
{


    function getAlojamientoData($Alojamiento_id)
    {

        $Alojamiento = new Alojamiento();
        $arrAlojamientos = array();
        $arrAlojamientos["Datos"] = array();

        $res = $Alojamiento->getAlojamientoData($Alojamiento_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Alojamiento_id" => $row['Alojamiento_id'],
                    "UsuarioVendedor_id" => $row['UsuarioVendedor_id'],
                    "nombre" => $row['nombre'],
                    "caracteristicas" => $row['caracteristicas'],
                    "imagenAlojamiento" => base64_encode(($row['imagenAlojamiento'])),
                    "direccion" => $row['direccion'],
                    "isOcupado" => $row['isOcupado'],
                    "nombreCompleto" => $row['nombreCompleto'],
                    "renta" => $row['renta']
                );
                array_push($arrAlojamientos["Datos"], $obj);
            }
            echo json_encode($arrAlojamientos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getAllAlojamientosData()
    {

        $Alojamiento = new Alojamiento();
        $arrAlojamientos = array();
        $arrAlojamientos["Datos"] = array();

        $res = $Alojamiento->getAllAlojamientosData();
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Alojamiento_id" => $row['Alojamiento_id'],
                    "nombre" => $row['nombre'],
                    "caracteristicas" => $row['caracteristicas'],
                    "imagenAlojamiento" => base64_encode(($row['imagenAlojamiento'])),
                    "direccion" => $row['direccion'],
                    "isOcupado" => $row['isOcupado'],
                    "nombreCompleto" => $row['nombreCompleto'],
                    "renta" => $row['renta']
                );
                array_push($arrAlojamientos["Datos"], $obj);
            }
            echo json_encode($arrAlojamientos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getAlojamientosUsuarioData($Usuario_id)
    {

        $Alojamiento = new Alojamiento();
        $arrAlojamientos = array();
        $arrAlojamientos["Datos"] = array();

        $res = $Alojamiento->getAllAlojamientosUsuarioData($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Alojamiento_id" => $row['Alojamiento_id'],
                    "nombre" => $row['nombre'],
                    "caracteristicas" => $row['caracteristicas'],
                    "imagenAlojamiento" => base64_encode(($row['imagenAlojamiento'])),
                    "direccion" => $row['direccion'],
                    "isOcupado" => $row['isOcupado'],
                    "nombreCompleto" => $row['nombreCompleto'],
                    "renta" => $row['renta']
                );
                array_push($arrAlojamientos["Datos"], $obj);
            }
            echo json_encode($arrAlojamientos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarAlojamiento($UsuarioVendedor_id,$Nombre,$Caracteristicas,$Imagen,$Direccion,$Renta)
    {
        $Alojamiento = new Alojamiento();
        $Alojamiento->insertarAlojamiento($UsuarioVendedor_id,$Nombre,$Caracteristicas,$Imagen,$Direccion,$Renta);
    }

    function actualizarAlojamiento($Alojamiento_id,$Nombre,$Caracteristicas,$Imagen,$Direccion,$Renta)
    {
        $Alojamiento = new Alojamiento();
        $Alojamiento->actualizarAlojamiento($Alojamiento_id,$Nombre,$Caracteristicas,$Imagen,$Direccion,$Renta);
    }

    function actualizarAlojamientoEstado($Alojamiento_id, $UsuarioArrendador_id)
    {
        $Alojamiento = new Alojamiento();
        $Alojamiento->actualizarAlojamientoEstado($Alojamiento_id, $UsuarioArrendador_id);
    }
    
    function eliminarAlojamiento($Alojamiento_id)
    {
        $Alojamiento = new Alojamiento();
        $Alojamiento->eliminarAlojamiento($Alojamiento_id);
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "registrarAlojamiento":
            session_start();
            if (!empty($_SESSION)) {
                $binariosImagen = '';
                if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != NULL) {
                     $tipoArchivo = $_FILES['file']['type'];
                    $nombreArchivo = $_FILES['file']['name'];
                    $tamanoArchivo = $_FILES['file']['size'];
                    $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
                    $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                    $id = $_SESSION['Usuario_id'];
                    $var = new AlojamientoAPI();
                    $var->insertarAlojamiento($id, $_POST['Nombre'], $_POST['Caracteristicas'],$binariosImagen, $_POST['Direccion'],$_POST['Renta']);
                }
                else{
                    echo 'Imagen No Cargada';
                    exit();
                }
            }
            else
            {
                echo '0';
                exit();
            }
       
            break;

        case "actualizarAlojamiento":

            session_start();
            if (!empty($_SESSION)) {
                $binariosImagen = '';
                if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != NULL) {
                     $tipoArchivo = $_FILES['file']['type'];
                    $nombreArchivo = $_FILES['file']['name'];
                    $tamanoArchivo = $_FILES['file']['size'];
                    $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
                    $binariosImagen = fread($imagenSubida, $tamanoArchivo);

                }
                $id = $_SESSION['Usuario_id'];
                $var = new AlojamientoAPI();
                $var->actualizarAlojamiento($_POST['Alojamiento_id'], $_POST['Nombre'], $_POST['Caracteristicas'],$binariosImagen,$_POST['Direccion'],$_POST['Renta']);
            }
            else
            {
                echo '0';
                exit();
            }
        
            break;
        case "actualizarAlojamientoEstado":
            $var = new AlojamientoAPI();
              session_start();
               $id = $_SESSION['Usuario_id'];
            $var->actualizarAlojamientoEstado($_POST['Alojamiento_id'],$id);
            break;
        case "eliminarAlojamiento":
            $var = new AlojamientoAPI();
            $var->eliminarAlojamiento($_POST['Alojamiento_id']);
            break;
        case "obtenerDataAlojamiento":
            $var = new AlojamientoAPI();
            $var->getAlojamientoData($_POST['Alojamiento_id']);
            break;
        case "obtenerDataTodosAlojamiento":
            $var = new AlojamientoAPI();
            $var->getAllAlojamientosData();
            break;
        case "obtenerDataTodosAlojamientosUsuario":
            $var = new AlojamientoAPI();
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var->getAlojamientosUsuarioData($id);
            break;
    }
}
