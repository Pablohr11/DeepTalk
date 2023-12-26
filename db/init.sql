drop table if exists Tokens cascade;
drop table if exists Hilo cascade;
drop table if exists Mensaje cascade;
drop table if exists MensajeGrupal cascade;
drop table if exists Conversacion cascade;
drop table if exists GrupoUsuario cascade;
drop table if exists Grupo cascade;
drop table if exists Usuario cascade;


CREATE TABLE Usuario (
    ID_usuario int AUTO_INCREMENT PRIMARY KEY,
    NombreUsuario varchar(25) UNIQUE,
	Contraseña varchar(100),
    Correo varchar(50) UNIQUE,
    Telefono varchar(9),
	Tipo varchar(25),
    rutaImagenPerfil varchar(66),
	Valoracion varchar(10)
);

CREATE TABLE Tokens (
    Token VARCHAR(32) PRIMARY KEY,
    ID_usuario INT,
	Tipo VARCHAR(25),
    FechaExpiracion DATETIME,
    CONSTRAINT FK_Tokens FOREIGN KEY (ID_usuario) REFERENCES Usuario(ID_usuario)
);

CREATE TABLE Conversacion(
	ID_conversacion int AUTO_INCREMENT,
    ID_usuario1 int,
	ID_usuario2 int,
    constraint fk_conv1 foreign key (ID_usuario1) references Usuario(ID_usuario) ON DELETE CASCADE,
    constraint fk_conv2 foreign key (ID_usuario2) references Usuario(ID_usuario) ON DELETE CASCADE,
    constraint pk_conv primary key(ID_Conversacion, ID_usuario1, ID_usuario2)
);


CREATE TABLE Grupo(
	ID_grupo int AUTO_INCREMENT primary key,
    NombreGrupo varchar(50),
    ID_usuario int,
    constraint fk_grupo foreign key (ID_usuario) references Usuario(ID_usuario)
);

CREATE TABLE GrupoUsuario (
	ID_grupo int,
    ID_usuario int,
    constraint fk_grupoUsu foreign key (ID_usuario) references Usuario(ID_usuario) ON DELETE CASCADE,
    constraint pk_grupoUsu primary key (ID_grupo, ID_usuario) 
);

CREATE TABLE MensajeGrupal (
    ID_usuario int,
	Num_Mensaje int AUTO_INCREMENT,
	ID_grupo int,
    Fecha DATETIME,
    Cuerpo varchar(600),
    Tipo varchar(20),
    foreign key (ID_usuario) references Usuario(ID_usuario) ON DELETE CASCADE,
    foreign key (ID_grupo) references Grupo(ID_grupo) ON DELETE CASCADE,
    primary key(Num_Mensaje, ID_grupo, ID_usuario) 
);

CREATE TABLE Mensaje(
    ID_usuario int,
	Num_Mensaje int AUTO_INCREMENT,
	ID_conversacion int,
    Fecha DATETIME,
    Cuerpo varchar(600),
    Tipo varchar(20),
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

--PARA CREACION DE USUARIO

insert into Usuario (NombreUsuario, Contraseña, Correo, Telefono, Tipo, rutaImagenPerfil, Valoracion) values("Pablohr11", "$2y$10$UaepmEegovq1Qm4vbl7cnutgHivrusQl5.chLfk8UeGwPnkKpdAwm", "pablo993968@gmail.com", null, "admin", "../resources/perfiles/usuarioDefault.png", null);
insert into Usuario (NombreUsuario, Contraseña, Correo, Telefono, Tipo, rutaImagenPerfil, Valoracion) values("Epic Erik", "$2y$10$HmLPVyYjMJZIChqNSaBUaOjMmxbw1lTb/ejT02IReXAu8gGU.qcL2", "lolamento77w@gmail.com", null, "admin", "../resources/perfiles/usuarioDefault.png", null);
insert into Usuario (NombreUsuario, Contraseña, Correo, Telefono, Tipo, rutaImagenPerfil, Valoracion) values("Merlinicos", "$2y$10$ZxRL.REa30Ppmlakypip9.rrla6oykP2IwYs6nQV5XS/ZAdgyMpUu", "mariapallares03@gmail.com", null, "base", "../resources/perfiles/usuarioDefault.png", null);

--Para creacion de conversaciones

insert into Conversacion (ID_usuario1, ID_usuario2) values (1,2);
insert into Conversacion (ID_usuario1, ID_usuario2) values (3,1);

--Para creacion de grupos

insert into Grupo(NombreGrupo, ID_usuario) values ("Grupo de prueba", 1);
insert into Grupo(NombreGrupo, ID_usuario) values ("Grupo entre maria y pablo", 1);

--Para usuarios de grupos

insert into GrupoUsuario(ID_grupo, ID_usuario) values (1, 1);
insert into GrupoUsuario(ID_grupo, ID_usuario) values (1, 2);
insert into GrupoUsuario(ID_grupo, ID_usuario) values (1, 3);

insert into GrupoUsuario(ID_grupo, ID_usuario) values (2, 1);
insert into GrupoUsuario(ID_grupo, ID_usuario) values (2, 3);

--PARA CREACION DE MENSAJES GRUPALES

insert into MensajeGrupal(ID_usuario, ID_grupo, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-23", "Mensaje para el grupo", "texto");
insert into MensajeGrupal(ID_usuario, ID_grupo, Fecha, Cuerpo, Tipo) values (1, 2, "2023-10-23", "Mensaje para el grupo", "texto");


--PARA CREACION DE MENSAJES

insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-1-23", "HOLA EPIERI", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-2-23", "HOLA PABLO", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-3-23", "Que tal epieri", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-4-23", "Bien...", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-5-23", "¡Hola! ¿Cómo estás hoy?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-6-23", "¡Hola! Bien, gracias. ¿Y tú? ¿Cómo ha sido tu día?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-7-23", "Todo bien, ocupado con el trabajo, ya sabes. Pero ahora tengo un descanso. ¿Qué has estado haciendo?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-8-23", "Lo mismo de siempre. Trabajo, trabajo y más trabajo. Pero en fin, así es la vida. ¿Has tenido tiempo para alguna actividad recreativa?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-9-23", "No mucho, la verdad. Pero estoy pensando en tomarme un fin de semana libre. ¿Tú qué planes tienes?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-10-23", "Pues estoy pensando en ir al cine este sábado. ¿Te gustaría unirte?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-23", "¡Suena genial! ¿Qué película quieres ver?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-10-23", "Hay una nueva de ciencia ficción que parece interesante. ¿Te apuntas?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-23", "¡Claro! Me encantan las películas de ciencia ficción. ¿A qué hora y en qué cine?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-10-23", "A las 7 en el cine del centro. ¿Eso te queda bien?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-23", "Perfecto. Nos vemos allí. Cambiando de tema, ¿has escuchado la nueva canción de ese grupo que te gusta?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-10-23", "¡Sí! La escuché esta mañana. Es increíble. ¿Te gustaría que la compartiera contigo?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-23", "¡Definitivamente! Envíamela, por favor. Siempre tienes buen gusto musical.", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-10-23", " ¡Gracias! Lo haré. Y hablando de música, ¿has estado practicando con tu guitarra últimamente?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-23", "La verdad es que no tanto como quisiera. Pero estoy tratando de sacar tiempo. ¿Tú cómo va con tus lecciones de piano?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-10-23", "Bien, gracias. A veces me cuesta encontrar tiempo también, pero es tan relajante. Deberíamos hacer una jam session un día de estos.", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-23", "¡Eso suena divertido! Seguro que será genial. Cambiando de tema, ¿has probado el nuevo restaurante italiano que abrieron en el centro?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-10-23", "Todavía no, ¿vale la pena?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-23", "Definitivamente. La pasta es deliciosa. Podríamos ir a cenar allí después de la película el sábado.", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-10-24", " ¡Buena idea! Me apunto. ¿Y cómo van las cosas en casa?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-24", "Todo tranquilo. Mi hermana está planeando visitarnos el próximo mes. Será agradable verla.", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-10-24", "Eso suena bien. Hace tiempo que no la veo. ¡Espero que tengamos tiempo para ponernos al día!", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-10-25", "Seguro que sí. Ya sabes cómo es ella, siempre llena de historias. Pero suficiente sobre mí. ¿Cómo va todo contigo?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (2, 1, "2023-11-25", "Bien, en general. Algunos altibajos, ya sabes. Pero estoy enfocado en lo positivo. ¿Has tenido alguna noticia emocionante últimamente?", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 1, "2023-12-26", "No mucho, solo la rutina diaria. Pero estoy buscando nuevas aventuras. Tal vez planee unas", "texto");


insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 2, "2023-10-23", "HOLA MARIAAAA QUE TAAAAAAAAAAL", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (3, 2, "2023-10-23", "HOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA BIEEEEEEEEEEEEEEN", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (1, 2, "2023-10-23", "WEOOOOOOOOOOOOOOOOOOOOOOOOON", "texto");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (3, 2, "2023-10-23", "(COMPLETA AUSENCIA DE RESPUESTA)", "texto");
