USE UR_WEBPAGE;

/*--------------------------------------------------------------------------------USUARIOS--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vUsuario;

CREATE VIEW vUsuario AS
SELECT Usuario_id, nombres, apellidos, ocupacion, edad, fotoPerfil, correo, username, userPassword, descripcion, direccion, noTelefono
FROM Usuario;


/*--------------------------------------------------------------------------------CHAT--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vChat;

CREATE VIEW vChat AS
SELECT UsuarioChat_1, UsuarioChat_2, Chat_id, A.Alojamiento_id, B.UsuarioVendedor_id, imagenAlojamiento, B.nombre, correo, CONCAT(C.nombres,' ', apellidos) nombreCompleto, username
FROM Chat A
LEFT JOIN Alojamiento B ON A.Alojamiento_id = B.Alojamiento_id
LEFT JOIN Usuario C ON C.Usuario_id= B.UsuarioVendedor_id;


/*--------------------------------------------------------------------------------MENSAJE--------------------------------------------------------------------------*/

DROP VIEW IF EXISTS vMensaje;

CREATE VIEW vMensaje AS
SELECT Mensaje_id, B.UsuarioChat_1, B.UsuarioChat_2, B.Alojamiento_id, C.Usuario_id, A.Chat_id, texto, A.tiempoRegistro, fotoPerfil,  CONCAT(C.nombres,' ', apellidos) nombreUsuario
FROM Mensaje A
LEFT JOIN Usuario C ON C.Usuario_id= A.Usuario_id
LEFT JOIN Chat B ON B.Chat_id= A.Chat_id
ORDER BY A.tiempoRegistro ASC;

/*--------------------------------------------------------------------------------ALOJAMIENTO--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vAlojamiento;

CREATE VIEW vAlojamiento AS
SELECT Alojamiento_id, UsuarioVendedor_id, UsuarioArrendador_id,renta, nombre, caracteristicas,CONCAT(nombres,' ',apellidos) nombreCompleto, imagenAlojamiento, A.direccion, isOcupado
FROM Alojamiento A
LEFT JOIN Usuario B
ON A.UsuarioVendedor_id = B.Usuario_id;



/*--------------------------------------------------------------------------------ALOJAMIENTO--------------------------------------------------------------------------*/

DROP VIEW IF EXISTS vMultimediaAlojamiento;

CREATE VIEW vMultimediaAlojamiento AS
SELECT A.Alojamiento_id, Multimedia_id, multimedia
FROM Alojamiento A
LEFT JOIN Multimedia B
ON A.Alojamiento_id = B.Alojamiento_id
ORDER BY Multimedia_id;

