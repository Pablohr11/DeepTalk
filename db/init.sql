drop table if exists Hilo cascade;
drop table if exists Mensaje cascade;
drop table if exists Conversacion cascade;
drop table if exists Usuario cascade;


CREATE TABLE Usuario (
    ID_usuario int AUTO_INCREMENT PRIMARY KEY,
    NombreUsuario varchar(25) UNIQUE,
	Contraseña varchar(25),
    Correo varchar(25),
    Telefono varchar(9),
	Tipo varchar(25),
	Valoracion varchar(10)
);

CREATE TABLE Conversacion(
	ID_conversacion int AUTO_INCREMENT,
    ID_usuario1 int,
	ID_usuario2 int,
    constraint fk_us1 foreign key (ID_usuario1) references Usuario(ID_usuario) ON DELETE CASCADE,
    constraint fk_us2 foreign key (ID_usuario2) references Usuario(ID_usuario) ON DELETE CASCADE,
    constraint pk_conv primary key(ID_Conversacion, ID_usuario1, ID_usuario2)
);

CREATE TABLE Mensaje(
    ID_usuario int,
	Num_Mensaje int AUTO_INCREMENT,
	ID_conversacion int,
    Fecha Date,
    Cuerpo varchar(500),
    foreign key (ID_usuario) references Usuario(ID_usuario) ON DELETE CASCADE,
    foreign key (ID_conversacion) references Conversacion(ID_conversacion) ON DELETE CASCADE,
    primary key(Num_Mensaje, ID_Conversacion, ID_usuario)
);

CREATE TABLE Hilo(
    ID_hilo int AUTO_INCREMENT primary key,
    ID_usuario int,
    NombreHilo varchar(25),
    CantidadDeMensajes int,
    foreign key (ID_usuario) references Usuario(ID_usuario) ON DELETE CASCADE
);

--SELECTS

--PARA INICIO DE SESION

-- select NombreUsuario, Contraseña from Usuario where NombreUsuario = (Usuario introducido en el login) and Contraseña = (Contraseña introducido en el login);

--PARA SELECCIONAR LOS MENSAJES

-- select Cuerpo, NombreUsuario from Mensaje, Usuario, Chat where Mensaje.ID_Conversacion = Chat.ID_Conversacion order by Mensaje.Num_Mensaje;

--PARA CREACION DE USUARIO

insert into Usuario (NombreUsuario, Contraseña, Correo, Telefono, Tipo, Valoracion) values("Pablohr11", "1234", "pablo993968@gmail.com", null, "admin", null);
insert into Usuario (NombreUsuario, Contraseña, Correo, Telefono, Tipo, Valoracion) values("Epic Erik", "123456", "lolamento77w@gmail.com", null, "admin", null);

--Para creacion de conversaciones

insert into Conversacion (ID_usuario1, ID_usuario2) values (1,2);

--PARA CREACION DE MENSAJES

insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "HOLA EPIERI");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "HOLA PABLO");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "Que tal epieri");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "Bien...");