drop database if exists bdPrOr;
create database bdPrOr;
use bdPrOr;

create table USUARIO(
    loginU varchar(30),
    nombresApellidos varchar(60),
    DNI char(8),
    direccion varchar(60),
    telefono varchar(60),
    correo varchar(60),
    contra varchar(60),
    tipo varchar(60),
    estadoU int,
    primary key(loginU)
);

create table EMPRESA(
    idEmpresa int auto_increment,
    nombreEmpresa varchar(60),
    RUC char(11),
    mision varchar(200),
    vision varchar(200),
    propuestaValor varchar(200),
    factorDiferenciador varchar(200),
    objetivo varchar(200),
    estado int,
    primary key(idEmpresa)
);

create table PROCESO(
    idProceso int auto_increment,
    idEmpresa int,
    nombreProceso varchar(60),
    estadoProceso int,
    primary key(idProceso, idEmpresa),
    foreign key(idEmpresa) references EMPRESA(idEmpresa)
);

create table SUBPROCESO(
    idSubProceso int auto_increment,
    nombreSub varchar(60),
    estadoSub int,
    idProceso int,
    idEmpresa int,
    primary key(idSubProceso),
    foreign key(idProceso) references PROCESO(idProceso),
    foreign key(idEmpresa) references PROCESO(idEmpresa)
);

create table ORGANIZACION(
    idOrganizacion int auto_increment,
    idEmpresa int,
    nombreOrganizacion varchar(60),
    estadoOr int,
    primary key(idOrganizacion, idEmpresa),
    foreign key(idEmpresa) references EMPRESA(idEmpresa)
);

create table DETALLE_ASIGNACION(
    idOrganizacion int,
    idSubProceso int,
    idEmpresa int,
    asignacion varchar(60),
    primary key(idOrganizacion, idSubProceso, idEmpresa),
    foreign key(idOrganizacion) references ORGANIZACION(idOrganizacion),
    foreign key(idSubProceso) references SUBPROCESO(idSubProceso),
    foreign key(idEmpresa) references ORGANIZACION(idEmpresa)
);