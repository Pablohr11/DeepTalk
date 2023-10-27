CREATE TABLE Usuario(
    ID_Usuario varchar(25) PRIMARY KEY,
    NombreUsuario varchar(25) UNIQUE,
	Contraseña varchar(25),
    Correo varchar(25),
    Telefono varchar(9) ,
	Tipo varchar(25),
	Valoracion varchar(10),
	CONSTRAINT Usuario_Tipo CHECK(Tipo in('Base', 'Admin'));
);

CREATE TABLE Chat(
	ID_Chat varchar(25),
    ID_Usuario1 varchar(25),
	ID_Usuario2 varchar(25),
    NumeroDeMensajes number,
	-- Publico BOOLEAN,
	CONSTRAINT Mensaje_PK PRIMARY KEY(ID_Chat, ID_Usuario1, ID_Usuario2),
	CONSTRAINT Mensaje_FK FOREIGN KEY(ID_Usuario1) REFERENCES Usuario(ID_Usuario),
	CONSTRAINT Mensaje_FK1 FOREIGN KEY(ID_Usuario2) REFERENCES Usuario(ID_Usuario)
);


-- CREATE TABLE Grupo(
--     ID_Usuario varchar(25) PRIMARY KEY,
-- 	Contador varchar(25),
--     NumeroDeUsuarios number,
--     Descripcion varchar(150),
-- 	CONSTRAINT Mensaje_PK PRIMARY KEY(ID_Usuario, Contador),
-- 	CONSTRAINT Mensaje_FK FOREIGN KEY(ID_Usuario) REFERENCES Usuario(ID_Usuario)
-- );

CREATE TABLE Mensaje(
    ID_Usuario varchar(25),
	Num_Mensaje varchar(25),
	ID_Chat varchar(25),
    Fecha Date,
    Cuerpo varchar(500),
	CONSTRAINT Chat_FK FOREIGN KEY (ID_Chat) REFERENCES Chat(ID_Chat),
	CONSTRAINT Mensaje_PK PRIMARY KEY(ID_Usuario, Contador, ID_Chat),
	CONSTRAINT Mensaje_FK FOREIGN KEY(ID_Usuario) REFERENCES Usuario(ID_Usuario)
);

CREATE TABLE Hilo(
    ID_Usuario varchar(25),
	Contador varchar(25),
    NombreHilo varchar(25),
    CantidadDeMensajes number,
	CONSTRAINT Mensaje_PK PRIMARY KEY(ID_Usuario, Contador),
	CONSTRAINT Mensaje_FK FOREIGN KEY(ID_Usuario) REFERENCES Usuario(ID_Usuario)
);

--SELECTS

--PARA INICIO DE SESION

select NombreUsuario, Contraseña from Usuario where NombreUsuario = (Usuario introducido en el login) and Contraseña = (Contraseña introducido en el login);

--PARA SELECCIONAR LOS MENSAJES

--select Cuerpo from Mensaje, Usuario, Chat where Mensaje.ID_Chat = Chat.ID_Chat;