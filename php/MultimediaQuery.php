
<?php
include_once 'db.php';

class Multimedia extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Multimedia de un Alojamiento

    function getMultimediaAlojamiento($Alojamiento_id)
    {
        $get = "CALL sp_GestionMultimedia(
                'A',  		# Operacion
                NULL,    		# Id
                $Alojamiento_id, 	    # Alojamiento Id
                NULL  		# Multimedia
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Multimedia

    function insertarMultimedia($Alojamiento_id, $Multimedia)
    {
        $Multimedia = mysqli_escape_string($this->myCon(), $Multimedia); 
        mysqli_close($this->myCon());
        $insert = "CALL sp_GestionMultimedia(
                    'I',                # Operacion
                    NULL,               # Id
                    $Alojamiento_id, 	# Nivel Id
                    '$Multimedia'  	    # Multimedia
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

        function actualizarMultimedia($Multimedia_id, $Multimedia)
    {
         $Multimedia = mysqli_escape_string($this->myCon(), $Multimedia); 
        mysqli_close($this->myCon());
        $insert = "CALL sp_GestionMultimedia(
                    'E',                # Operacion
                    $Multimedia_id,               # Id
                    NULL, 	        # Nivel Id
                    '$Multimedia'  	# Multimedia
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }


   // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
      // QUERY Eliminar Multimedia

    function eliminarMultimedia($Multimedia_id)
    {
        $delete = "CALL sp_GestionMultimedia(
                    'D',  		# Operacion
                    $Multimedia_id,    		# Id
                    NULL, 	    # Nivel Id
                    NULL  		# Multimedia
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }
     
}

?>
