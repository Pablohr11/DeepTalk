drop table if exists Hilo cascade;
drop table if exists Mensaje cascade;
drop table if exists MensajeGrupal cascade;
drop table if exists Conversacion cascade;
drop table if exists GrupoUsuario cascade;
drop table if exists Usuario cascade;
drop table if exists Grupo cascade;


CREATE TABLE Usuario (
    ID_usuario int AUTO_INCREMENT PRIMARY KEY,
    NombreUsuario varchar(25) UNIQUE,
	Contraseña varchar(25),
    Correo varchar(50) UNIQUE,
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


CREATE TABLE Grupo(
	ID_grupo int AUTO_INCREMENT primary key,
    NombreGrupo varchar(50)
);

CREATE TABLE GrupoUsuario (
	ID_grupo int,
    ID_usuario int,
    constraint fk_us foreign key (ID_usuario) references Usuario(ID_usuario) ON DELETE CASCADE,
    constraint fk_grp foreign key (ID_grupo) references Grupo(ID_grupo) ON DELETE CASCADE,
    constraint pk_grupo primary key (ID_grupo, ID_usuario) 
);

CREATE TABLE MensajeGrupal (
    ID_usuario int,
	Num_Mensaje int AUTO_INCREMENT,
	ID_grupo int,
    Fecha Date,
    Cuerpo varchar(500),
    foreign key (ID_usuario) references Usuario(ID_usuario) ON DELETE CASCADE,
    foreign key (ID_grupo) references Conversacion(ID_conversacion) ON DELETE CASCADE,
    primary key(Num_Mensaje, ID_grupo, ID_usuario) 
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

--PARA CREACION DE USUARIO

insert into Usuario (NombreUsuario, Contraseña, Correo, Telefono, Tipo, Valoracion) values("Pablohr11", "1234", "pablo993968@gmail.com", null, "admin", null);
insert into Usuario (NombreUsuario, Contraseña, Correo, Telefono, Tipo, Valoracion) values("Epic Erik", "12345", "lolamento77w@gmail.com", null, "admin", null);
insert into Usuario (NombreUsuario, Contraseña, Correo, Telefono, Tipo, Valoracion) values("Merlinicos", "Lobos", "mariapallares03@gmail.com", null, "base", null);

--Para creacion de conversaciones

insert into Conversacion (ID_usuario1, ID_usuario2) values (1,2);
insert into Conversacion (ID_usuario1, ID_usuario2) values (3,1);

--Para creacion de grupos

insert into Grupo(NombreGrupo) values ("Grupo de prueba");
insert into Grupo(NombreGrupo) values ("Grupo entre maria y pablo");

--Para usuarios de grupos

insert into GrupoUsuario(ID_grupo, ID_usuario) values (1, 1);
insert into GrupoUsuario(ID_grupo, ID_usuario) values (1, 2);
insert into GrupoUsuario(ID_grupo, ID_usuario) values (1, 3);

insert into GrupoUsuario(ID_grupo, ID_usuario) values (2, 1);
insert into GrupoUsuario(ID_grupo, ID_usuario) values (2, 3);

--PARA CREACION DE MENSAJES GRUPALES

insert into MensajeGrupal(ID_usuario, ID_grupo, Fecha, Cuerpo) values (1, 1, "2023-10-23", "Mensaje para el grupo");
insert into MensajeGrupal(ID_usuario, ID_grupo, Fecha, Cuerpo) values (1, 2, "2023-10-23", "Mensaje para el grupo");


--PARA CREACION DE MENSAJES

insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "HOLA EPIERI");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "HOLA PABLO");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "Que tal epieri");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "Bien...");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "¡Hola! ¿Cómo estás hoy?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "¡Hola! Bien, gracias. ¿Y tú? ¿Cómo ha sido tu día?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "Todo bien, ocupado con el trabajo, ya sabes. Pero ahora tengo un descanso. ¿Qué has estado haciendo?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "Lo mismo de siempre. Trabajo, trabajo y más trabajo. Pero en fin, así es la vida. ¿Has tenido tiempo para alguna actividad recreativa?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "No mucho, la verdad. Pero estoy pensando en tomarme un fin de semana libre. ¿Tú qué planes tienes?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "Pues estoy pensando en ir al cine este sábado. ¿Te gustaría unirte?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "¡Suena genial! ¿Qué película quieres ver?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "Hay una nueva de ciencia ficción que parece interesante. ¿Te apuntas?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "¡Claro! Me encantan las películas de ciencia ficción. ¿A qué hora y en qué cine?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "A las 7 en el cine del centro. ¿Eso te queda bien?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "Perfecto. Nos vemos allí. Cambiando de tema, ¿has escuchado la nueva canción de ese grupo que te gusta?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "¡Sí! La escuché esta mañana. Es increíble. ¿Te gustaría que la compartiera contigo?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "¡Definitivamente! Envíamela, por favor. Siempre tienes buen gusto musical.");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", " ¡Gracias! Lo haré. Y hablando de música, ¿has estado practicando con tu guitarra últimamente?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "La verdad es que no tanto como quisiera. Pero estoy tratando de sacar tiempo. ¿Tú cómo va con tus lecciones de piano?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "Bien, gracias. A veces me cuesta encontrar tiempo también, pero es tan relajante. Deberíamos hacer una jam session un día de estos.");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "¡Eso suena divertido! Seguro que será genial. Cambiando de tema, ¿has probado el nuevo restaurante italiano que abrieron en el centro?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "Todavía no, ¿vale la pena?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "Definitivamente. La pasta es deliciosa. Podríamos ir a cenar allí después de la película el sábado.");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", " ¡Buena idea! Me apunto. ¿Y cómo van las cosas en casa?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "Todo tranquilo. Mi hermana está planeando visitarnos el próximo mes. Será agradable verla.");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "Eso suena bien. Hace tiempo que no la veo. ¡Espero que tengamos tiempo para ponernos al día!");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "Seguro que sí. Ya sabes cómo es ella, siempre llena de historias. Pero suficiente sobre mí. ¿Cómo va todo contigo?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (2, 1, "2023-10-23", "Bien, en general. Algunos altibajos, ya sabes. Pero estoy enfocado en lo positivo. ¿Has tenido alguna noticia emocionante últimamente?");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 1, "2023-10-23", "No mucho, solo la rutina diaria. Pero estoy buscando nuevas aventuras. Tal vez planee unas");


insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 2, "2023-10-23", "HOLA MARIAAAA QUE TAAAAAAAAAAL");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (3, 2, "2023-10-23", "HOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA BIEEEEEEEEEEEEEEN");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (1, 2, "2023-10-23", "WEOOOOOOOOOOOOOOOOOOOOOOOOON");
insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo) values (3, 2, "2023-10-23", "(COMPLETA AUSENCIA DE RESPUESTA)");
