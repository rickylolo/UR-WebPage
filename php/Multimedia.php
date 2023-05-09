<?php
include_once 'MultimediaQuery.php';


class multimediaAPI
{


    function getMultimediaAlojamiento($Alojamiento_id)
    {

        $Multimedia = new Multimedia();
        $arrMultimedias = array();
        $arrMultimedias["Datos"] = array();

        $res = $Multimedia->getMultimediaAlojamiento($Alojamiento_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Multimedia_id" => $row['Multimedia_id'],
                    "multimedia" => base64_encode(($row['multimedia']))
                );
                array_push($arrMultimedias["Datos"], $obj);
            }
            echo json_encode($arrMultimedias["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }


    function insertarMultimedia($Alojamiento_id,$MultimediaEscapeString)
    {
        $Multimedia = new Multimedia();
        $Multimedia->insertarMultimedia($Alojamiento_id,$MultimediaEscapeString);
    }


    function eliminarMultimedia($Multimedia_id)
    {
         $Multimedia = new Multimedia();
        $Multimedia->eliminarMultimedia($Multimedia_id);
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "registrarMultimedia":
           $binarios = '';
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != NULL) {
                $tipoArchivo = $_FILES['file']['type'];
                $nombreArchivo = $_FILES['file']['name'];
                $tamanoArchivo = $_FILES['file']['size'];
                $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
                $binarios = fread($imagenSubida, $tamanoArchivo);
                 $var = new multimediaAPI();
                $var->insertarMultimedia($_POST['Alojamiento_id'], $binarios);
            }
           else{
            echo '0';
           }
            break;
        case "eliminarMultimedia":
            $var = new multimediaAPI();
            $var->eliminarMultimedia($_POST['Multimedia_id']);
            break;
        case "obtenerMultimediaAlojamiento":
            $var = new multimediaAPI();
            $var->getMultimediaAlojamiento($_POST['Alojamiento_id']);
            break;

    }
}

