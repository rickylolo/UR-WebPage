
<?php
include_once 'db.php';

class Chat extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Todos Chats Usuario

    function getChatsUsuario($Usuario_id)
    {
        $get = "CALL sp_GestionChat(
                    'G',  		    #Operacion
                    NULL, 		    # Id
                    $Usuario_id,	# Usuario 1 Id
                    NULL, 	        # Usuario 2 Id
                    NULL 		    # Alojamiento Id
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }



    // QUERY Get Todos Mensajes del Chat 

    function getTodosMensajesChat($Chat_id)
    {
        $get = "CALL sp_GestionMensaje(
                    'G',  		    #Operacion
                    NULL, 		    # Id
                    $Chat_id,	    # Chat Id
                    NULL,           # Usuario Id
                    NULL            # Texto
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Chat

    function insertarChat($Usuario_1,$Usuario_2, $Alojamiento_id)
    {
        $insert = "CALL sp_GestionChat(
                    'I',  		    # Operacion
                    NULL, 		    # Id
                    $Usuario_1,     # Usuario 1 Id
                    $Usuario_2, 	# Usuario 2 Id
                    $Alojamiento_id # Alojamiento Id
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

    // QUERY Insertar Mensaje
    function insertarMensaje($Chat_id,$Usuario_id,$Texto)
    {
        $insert = "CALL sp_GestionMensaje(
                    'I',  		    #Operacion
                    NULL, 		    # Id
                    $Chat_id,	    # Chat Id
                    $Usuario_id,    # Usuario Id
                    '$Texto'        # Texto
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

   // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------



   // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
      // QUERY Eliminar Chat

    function eliminarChat($Chat_id)
    {
        $delete = "CALL sp_GestionChat(
                'D', # Operacion
                $Chat_id, # Id
                NULL, # User Id
                NULL, #Curso Id
                NULL, # is Like
                NULL  # texto
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }
     
}

?>
