

/*-------------------------------------------------------------------------------- USUARIO --------------------------------------------------------------------------*/

DROP PROCEDURE IF EXISTS sp_GestionUsuario;
DELIMITER //
CREATE PROCEDURE sp_GestionUsuario
(
	Operacion 			CHAR(1),
	sp_Usuario_id 		INT,
	sp_nombres 			VARCHAR(50),
	sp_apellidos	 	VARCHAR(50),
	sp_ocupacion 		TINYTEXT,
    sp_edad 			INT,
    sp_fotoPerfil		MEDIUMBLOB,
	sp_correo 			VARCHAR(40),
	sp_username 		VARCHAR(40),
	sp_userPassword 	VARCHAR(30),
	sp_descripcion 		TEXT,
	sp_direccion 		TEXT,
    sp_noTelefono		VARCHAR(12)
)

BEGIN
	DECLARE sp_ultimoCambio DATETIME; 
   IF Operacion = 'I' /*INSERT USUARIO*/
   THEN  
		INSERT INTO Usuario(nombres,apellidos,ocupacion,edad,fotoPerfil ,correo,username,userPassword,descripcion,direccion,noTelefono) 
			VALUES (sp_nombres,sp_apellidos,sp_ocupacion,sp_edad,sp_fotoPerfil ,sp_correo,sp_username,sp_userPassword,sp_descripcion,sp_direccion,sp_noTelefono);
   END IF;
	IF Operacion = 'E'  /*EDIT USUARIO*/
    
    THEN 
    	SET sp_nombres=IF(sp_nombres='',NULL,sp_nombres),
			sp_apellidos=IF(sp_apellidos='',NULL,sp_apellidos),
			sp_ocupacion=IF(sp_ocupacion='',NULL,sp_ocupacion),
            sp_edad=IF(sp_edad='',NULL,sp_edad),
			sp_fotoPerfil=IF(sp_fotoPerfil='',NULL,sp_fotoPerfil),
            sp_correo=IF(sp_correo='',NULL,sp_correo),
            sp_username=IF(sp_username='',NULL,sp_username),
			sp_userPassword=IF(sp_userPassword='',NULL,sp_userPassword),
            sp_descripcion=IF(sp_descripcion='',NULL,sp_descripcion),
            sp_direccion=IF(sp_direccion='',NULL,sp_direccion),
			sp_noTelefono=IF(sp_noTelefono='',NULL,sp_noTelefono);
		UPDATE Usuario 
			SET nombres = IFNULL(sp_nombres,nombres), 
				apellidos= IFNULL(sp_apellidos,apellidos), 
				ocupacion=  IFNULL(sp_ocupacion,ocupacion), 
				edad= IFNULL(sp_edad,edad), 
				fotoPerfil= IFNULL(sp_fotoPerfil,fotoPerfil), 
				correo= IFNULL(sp_correo,correo), 
				username= IFNULL(sp_username,username),
				userPassword= IFNULL(sp_userPassword,userPassword),
				descripcion= IFNULL(sp_descripcion,descripcion),
                direccion= IFNULL(sp_direccion,direccion),
			    noTelefono= IFNULL(sp_noTelefono,noTelefono)
		WHERE Usuario_id=sp_Usuario_id;
        
   END IF;
    IF Operacion = 'D' THEN /*DELETE USUARIO*/
          DELETE FROM Usuario WHERE  Usuario_id = sp_Usuario_id;
   END IF;
    IF Operacion = 'L' THEN /*LOG IN USUARIO*/
		SELECT Usuario_id
        FROM vUsuario
        WHERE 1=1 
			AND username = sp_username
            AND userPassword = sp_userPassword;
   END IF;
     IF Operacion = 'G' THEN /*GET DATOS USUARIO*/
		SELECT Usuario_id, nombres, apellidos, ocupacion, edad, fotoPerfil, correo, username, descripcion, direccion,noTelefono
        FROM vUsuario
        WHERE Usuario_id = sp_Usuario_id;
   END IF;
	IF Operacion = 'P' THEN /*GET DATOS USUARIO PROPIETARIO*/
		SELECT Usuario_id, nombres, apellidos, ocupacion, edad, fotoPerfil, correo, username, descripcion, direccion,noTelefono
        FROM vUsuario
        WHERE Usuario_id = sp_Usuario_id;
   END IF;
END //


/*--------------------------------------------------------------------------------ALOJAMIENTO--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionAlojamiento;
DELIMITER //
CREATE PROCEDURE sp_GestionAlojamiento
(
	Operacion CHAR(1),
	sp_Alojamiento_id 			INT,
    sp_UsuarioVendedor_id       INT,
    sp_UsuarioArrendador_id		INT,
    sp_nombre		 			TINYTEXT,			
	sp_caracteristicas 			TEXT,
	sp_imagenAlojamiento		MEDIUMBLOB,
    sp_direccion 				TEXT,
    sp_renta 					DECIMAL(9,2)
)		


BEGIN
   DECLARE u_costoRenta DECIMAL(9,2);
   IF Operacion = 'I' /*INSERT ALOJAMIENTO*/
   THEN  
		INSERT INTO Alojamiento(UsuarioVendedor_id,nombre,caracteristicas,imagenAlojamiento,direccion,renta) 
			VALUES (sp_UsuarioVendedor_id,sp_nombre,sp_caracteristicas,sp_imagenAlojamiento,sp_direccion,sp_renta);
   END IF;
   
   IF Operacion = 'E'  /*EDIT ALOJAMIENTO*/
    
    THEN 
    	SET u_costoRenta = CONVERT(sp_renta,DECIMAL(9,2));
    	SET sp_nombre=IF(sp_nombre='',NULL,sp_nombre),
			sp_caracteristicas=IF(sp_caracteristicas='',NULL,sp_caracteristicas),
			sp_imagenAlojamiento=IF(sp_imagenAlojamiento='',NULL,sp_imagenAlojamiento),
			sp_direccion=IF(sp_direccion='',NULL,sp_direccion);
		UPDATE Alojamiento 
			SET nombre = IFNULL(sp_nombre,nombre), 
				caracteristicas= IFNULL(sp_caracteristicas,caracteristicas), 
				imagenAlojamiento=  IFNULL(sp_imagenAlojamiento,imagenAlojamiento), 
				direccion= IFNULL(sp_direccion,direccion),
                renta = IFNULL(u_costoRenta,renta)
		WHERE Alojamiento_id=sp_Alojamiento_id;
        
   END IF;
	IF Operacion = 'V' THEN /*UPDATE ESTADO OCUPAMIENTO*/
         UPDATE Alojamiento SET isOcupado = 1, UsuarioArrendador_id = sp_UsuarioArrendador_id 
         WHERE Alojamiento_id=sp_Alojamiento_id;
   END IF;
   IF Operacion = 'D' THEN /*DELETE ALOJAMIENTO*/
          DELETE FROM Alojamiento WHERE Alojamiento_id=sp_Alojamiento_id;
   END IF;
   
   IF Operacion = 'A' THEN /*GET ALL ALOJAMIENTOS DISPONIBLES*/
          SELECT Alojamiento_id, UsuarioVendedor_id, UsuarioArrendador_id,renta, nombre,nombreCompleto, caracteristicas, imagenAlojamiento, direccion, isOcupado
          FROM vAlojamiento
          WHERE isOcupado = 0;
   END IF;
      IF Operacion = 'C' THEN /*GET ALL ALOJAMIENTOS USUARIO*/
          SELECT Alojamiento_id, nombre, caracteristicas, nombreCompleto,renta, imagenAlojamiento, direccion, isOcupado
          FROM vAlojamiento
          WHERE UsuarioArrendador_id = sp_UsuarioArrendador_id;
   END IF;
	     IF Operacion = 'G' THEN /*GET ALOJAMIENTOS DATA*/
          SELECT Alojamiento_id, nombre, caracteristicas, nombreCompleto,renta, imagenAlojamiento, direccion, isOcupado
          FROM vAlojamiento
          WHERE Alojamiento_id = sp_Alojamiento_id;
   END IF;
END //



/*--------------------------------------------------------------------------------CHAT--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionChat;
DELIMITER //
CREATE PROCEDURE sp_GestionChat
(
	Operacion CHAR(1),
	sp_Chat_id 			 INT,
    sp_UsuarioChat_1  	 INT,			
    sp_UsuarioChat_2 	 INT,			
    sp_Alojamiento_id	 INT
)		

BEGIN
  DECLARE isExistenteChat INT;
   IF Operacion = 'I' /*INSERT CHAT*/
   THEN  
   
		SELECT COUNT(*) INTO isExistenteChat FROM Chat
		WHERE UsuarioChat_1 = sp_UsuarioChat_1
		AND UsuarioChat_2 = sp_UsuarioChat_2
		AND Alojamiento_id = sp_Alojamiento_id;
        
		IF isExistenteChat = 0 THEN
			
			INSERT INTO Chat(UsuarioChat_1,UsuarioChat_2,Alojamiento_id, tiempoRegistro) 
			VALUES (sp_UsuarioChat_1,sp_UsuarioChat_2,sp_Alojamiento_id, now());
        END IF;
		
   END IF;
   IF Operacion = 'D' THEN /*DELETE CHAT*/
          DELETE FROM Chat WHERE Chat_id = sp_Chat_id;
   END IF;
   
   # TO DO
   IF Operacion = 'G' THEN /*GET ALL MENSAJE HEADER Usuario*/
          SELECT Chat_id, Alojamiento_id, UsuarioVendedor_id, imagenAlojamiento, nombre, correo, nombreCompleto, username FROM vChat
          WHERE UsuarioChat_1 = sp_UsuarioChat_1 OR UsuarioChat_2 = sp_UsuarioChat_1;
   END IF;
END //





/*--------------------------------------------------------------------------------MENSAJE --------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionMensaje;
DELIMITER //
CREATE PROCEDURE sp_GestionMensaje
(
	Operacion CHAR(1),
	sp_Mensaje_id 	 		 INT,		
    sp_Chat_id 			 	 INT,	
	sp_Usuario_id            INT,	
    sp_texto  				 TINYTEXT
)		

BEGIN
   IF Operacion = 'I' /*INSERT MENSAJE*/
   THEN  
		INSERT INTO Mensaje(Chat_id,Usuario_id,texto,tiempoRegistro) 
			VALUES (sp_Chat_id,sp_Usuario_id,sp_texto,now());
   END IF;
   IF Operacion = 'G' THEN /*GET ALL MENSAJES*/
          SELECT Mensaje_id, Alojamiento_id, Usuario_id, Chat_id, texto, tiempoRegistro, fotoPerfil, nombreUsuario
          FROM vMensaje
          WHERE Chat_id = sp_Chat_id;
   END IF;
END //




/*--------------------------------------------------------------------------------MULTIMEDIA--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionMultimedia;
DELIMITER //
CREATE PROCEDURE sp_GestionMultimedia
(
	Operacion CHAR(1),
	sp_Multimedia_id 		INT,
    sp_Alojamiento_id 		INT,				
    sp_multimedia  			MEDIUMBLOB	
)		

BEGIN
   IF Operacion = 'I' /*INSERT MULTIMEDIA*/
   THEN  
		INSERT INTO Multimedia(Alojamiento_id,multimedia) 
			VALUES (sp_Alojamiento_id,sp_multimedia);
   END IF;
    IF Operacion = 'D' THEN /*DELETE MULTIMEDIA*/
          DELETE FROM Multimedia WHERE Multimedia_id = sp_Multimedia_id;
        
   END IF;
   
      IF Operacion = 'A' THEN /*GET ALL MULTIMEDIA DEL ALOJAMIENTO*/
		SELECT Multimedia_id, multimedia
        FROM vMultimediaAlojamiento
        WHERE Alojamiento_id = sp_Alojamiento_id;
   END IF;
   
END //
