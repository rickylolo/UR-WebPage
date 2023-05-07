DROP DATABASE IF EXISTS UR_WEBPAGE;
CREATE DATABASE UR_WEBPAGE;


-- 												TABLA DE USUARIOS										 --
DROP TABLE IF EXISTS Usuario;
CREATE TABLE Usuario(
	Usuario_id 			INT AUTO_INCREMENT NOT NULL,
    nombres 			VARCHAR(50) NOT NULL,			
	apellidos 			VARCHAR(50) NOT NULL,
	ocupacion 			TINYTEXT,
    edad 				INT,
    fotoPerfil			MEDIUMBLOB,
	correo 				VARCHAR(40) NOT NULL,
	username 			VARCHAR(40) NOT NULL UNIQUE,
	userPassword 		VARCHAR(30) NOT NULL,
	descripcion 		TEXT,
	direccion 			TEXT,
 CONSTRAINT PK_Usuario
	PRIMARY KEY (Usuario_id)
);

-- 												TABLA DE ALOJAMIENTOS										 --
DROP TABLE IF EXISTS Alojamiento;
CREATE TABLE Alojamiento(
	Alojamiento_id 			INT AUTO_INCREMENT NOT NULL,
    UsuarioVendedor_id      INT NOT NULL,
    UsuarioArrendador_id	INT,
    nombre		 			TINYTEXT NOT NULL,			
	caracteristicas 		TEXT,
	imagenAlojamiento		MEDIUMBLOB,
    direccion 				TEXT,
    isOcupado				BIT DEFAULT 0,
    
 CONSTRAINT PK_Alojamiento
	PRIMARY KEY (Alojamiento_id),
 CONSTRAINT FK_Alojamiento_Vendedor
	FOREIGN KEY (UsuarioVendedor_id) REFERENCES Usuario(Usuario_id),
 CONSTRAINT FK_Alojamiento_Arrendador
	FOREIGN KEY (UsuarioArrendador_id) REFERENCES Usuario(Usuario_id)
);


-- 													TABLA DE CHATS--
DROP TABLE IF EXISTS Chat;
CREATE TABLE Chat(
	Chat_id 			 INT AUTO_INCREMENT NOT NULL,
    UsuarioChat_1        INT NOT NULL, 
    UsuarioChat_2 	 	 INT NOT NULL, 
	Alojamiento_id       INT NOT NULL,
    tiempoRegistro       DATETIME NOT NULL,
 CONSTRAINT PK_Chat
	PRIMARY KEY (Chat_id),
 CONSTRAINT FK_Chat_Usuario1
	FOREIGN KEY (UsuarioChat_1) REFERENCES Usuario(Usuario_id),
 CONSTRAINT FK_Chat_Usuario2
	FOREIGN KEY (UsuarioChat_2) REFERENCES Usuario(Usuario_id),
CONSTRAINT FK_Chat_Alojamiento
	FOREIGN KEY (Alojamiento_id) REFERENCES Alojamiento(Alojamiento_id)
);

-- 													TABLA DE MENSAJES --
DROP TABLE IF EXISTS Mensaje;
CREATE TABLE Mensaje(
	Mensaje_id 			INT AUTO_INCREMENT NOT NULL,
    Usuario_id			INT NOT NULL,
	Chat_id 			INT NOT NULL,
    texto  				TINYTEXT NOT NULL,
    tiempoRegistro 		DATETIME NOT NULL,
 CONSTRAINT PK_Mensaje_id
	PRIMARY KEY (Mensaje_id),
 CONSTRAINT FK_Mensaje_Usuario
	FOREIGN KEY (Usuario_id) REFERENCES Usuario(Usuario_id),
 CONSTRAINT FK_Mensaje_Chat
	FOREIGN KEY (Chat_id) REFERENCES Chat(Chat_id)
);

