DROP DATABASE IF EXISTS appsalon;
CREATE DATABASE appsalon;
use appsalon;



CREATE TABLE Usuarios(
id int not null auto_increment,
nombre varchar(30),
apellido varchar(33),
telefono varchar(10),
email varchar(55),
pass varchar(255), /*Es necesario para el hash 255 en php para asegurarse. Probe hasta con 60 y el password_verify no funciona*/
esAdmin tinyint(1),
confirmado tinyint(1),
token varchar(15),
PRIMARY KEY(id)
);


CREATE TABLE Servicios(
id int not null auto_increment,
nombre varchar(20),
precio int,
PRIMARY KEY(id)
);

CREATE TABLE Citas(
    id int not null auto_increment,
    idUsuario int not null,
    fecha date not null,

    hora time not null,
    PRIMARY KEY (id),

    CONSTRAINT FK_3PersonaCita FOREIGN KEY(idUsuario) references Usuarios(id)
);

CREATE TABLE Citas_Servicios(
    id int not null auto_increment,
    idCita int not null,
    idServicio int not null,
    PRIMARY KEY (id),
    constraint FK1_CitaServicios foreign key (idCita) references Citas(id),
    constraint FK2_ServicioCita foreign key (idServicio) references Servicios(id)
);

INSERT INTO Servicios (nombre, precio) VALUES
('Corte de pelo', 200),
('Coloración', 300),
('Peinado', 150),
('Tratamiento capilar', 250),
('Manicura', 50),
('Pedicura', 70);

INSERT INTO Usuarios(nombre,apellido,telefono,email,pass,esAdmin,confirmado,token) VALUES
("Gonzalo","Hernandez","1144657777","gonza@gonza.com","1234567",1,1,""),
("Ivan","Hernan","1131653752","phelpscole990@gmail.com","DanaTeAmo",0,1,"");


/*CONSULTAS*/
/*OBTENER TODAS LAS CITAS QUE TENGAN SERVICIOS Y SUS USUARIOS*/
SELECT * FROM CITAS LEFT OUTER JOIN usuarios 
ON citas.idUsuario =  usuarios.id 
LEFT OUTER JOIN citas_servicios 
ON citas.id =citas_servicios.idCita
LEFT OUTER JOIN servicios
ON servicios.id = citas_servicios.idServicio;

/*oBTENER LAS CITAS DEL DIA DE HOY, CARACTERISTICAS DEL USUARIO como nombre apellido telefono Y EL SERVICIO ELEGIDO con sus caracteristicas*/

SELECT citas.id, CONCAT(usuarios.nombre,' ', usuarios.apellido) as "cliente", usuarios.telefono as "telefono", usuarios.email, servicios.nombre as "servicio", servicios.precio, citas.hora as "hora" FROM CITAS LEFT OUTER JOIN usuarios 
ON citas.idUsuario =  usuarios.id 
LEFT OUTER JOIN citas_servicios
ON citas.id =citas_servicios.idCita
LEFT OUTER JOIN servicios
ON servicios.id = citas_servicios.idServicio WHERE citas.fecha = "2024-01-23";



