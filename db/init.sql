CREATE TABLE Usuario(
    ID_Usuario varchar(25) PRIMARY KEY,
    NombreUsuario varchar(25) UNIQUE,
    Correo varchar(25),
    Telefono varchar(9) ,
	Tipo varchar(25)
	CONSTRAINT Usuario_Tipo CHECK(Tipo in('Base', 'Admin'));
);

CREATE TABLE Mensaje(
    ID_Usuario varchar(25),
	Contador varchar(25),
    Fecha Date,
    Cuerpo varchar(500),
	CONSTRAINT Mensaje_PK PRIMARY KEY(ID_Usuario, Contador),
	CONSTRAINT Mensaje_FK FOREIGN KEY(ID_Usuario) REFERENCES Usuario(ID_Usuario)
);

CREATE TABLE Chat(
    ID_Usuario1 varchar(25),
	ID_Usuario2 varchar(25),
    NumeroDeMensajes number,
	Publico BOOLEAN,
	CONSTRAINT Mensaje_PK PRIMARY KEY(ID_Usuario1, ID_Usuario2),
	CONSTRAINT Mensaje_FK FOREIGN KEY(ID_Usuario1) REFERENCES Usuario(ID_Usuario),
	CONSTRAINT Mensaje_FK1 FOREIGN KEY(ID_Usuario2) REFERENCES Usuario(ID_Usuario)
);

CREATE TABLE Grupo(
    ID_Usuario varchar(25) PRIMARY KEY,
	Contador varchar(25),
    NumeroDeUsuarios number,
    Descripcion varchar(150),
	CONSTRAINT Mensaje_PK PRIMARY KEY(ID_Usuario, Contador),
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