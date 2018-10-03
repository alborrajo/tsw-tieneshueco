SET FOREIGN_KEY_CHECKS=0;

DROP DATABASE IF EXISTS TIENESHUECO;
CREATE DATABASE TIENESHUECO;
USE TIENESHUECO;

CREATE TABLE USUARIO (
    CORREO  varchar(50) NOT NULL PRIMARY KEY,
    PASS    varchar(20) NOT NULL,
    NOMBRE  varchar(20) NOT NULL
);

CREATE TABLE ENCUESTA (
    ID      varchar(32) NOT NULL PRIMARY KEY,
    NOMBRE  varchar(50) NOT NULL, 
    PROPIETARIO varchar(50) NOT NULL,

    INDEX (ID),

    FOREIGN KEY (PROPIETARIO) REFERENCES USUARIO(CORREO)
);

CREATE TABLE FECHA (
    IDENCUESTA  varchar(32) NOT NULL,
    FECHA   date NOT NULL,
    
    INDEX (IDENCUESTA),
    INDEX (FECHA),

    FOREIGN KEY (IDENCUESTA) REFERENCES ENCUESTA(ID),
    CONSTRAINT PKFECHA PRIMARY KEY (IDENCUESTA, FECHA)
);

CREATE TABLE HORA (
    IDENCUESTA  varchar(32) NOT NULL,
    FECHA   date NOT NULL,
    HORAINICIO  time NOT NULL,
    HORAFIN     time NOT NULL,

    INDEX (HORAINICIO),
    INDEX (HORAFIN),

    FOREIGN KEY (IDENCUESTA) REFERENCES FECHA(IDENCUESTA),
    FOREIGN KEY (FECHA) REFERENCES FECHA(FECHA),
    CONSTRAINT PKHORA PRIMARY KEY (IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
);

CREATE TABLE VOTA (
    CORREOUSUARIO varchar(50) NOT NULL,
    IDENCUESTA  varchar(32) NOT NULL,
    FECHA   date NOT NULL,
    HORAINICIO  time NOT NULL,
    HORAFIN     time NOT NULL,

    FOREIGN KEY (CORREOUSUARIO) REFERENCES USUARIO(CORREO),
    FOREIGN KEY (IDENCUESTA) REFERENCES FECHA(IDENCUESTA),
    FOREIGN KEY (FECHA) REFERENCES FECHA(FECHA),
    FOREIGN KEY (HORAINICIO) REFERENCES HORA(HORAINICIO),
    FOREIGN KEY (HORAFIN) REFERENCES HORA(HORAFIN),
    CONSTRAINT PKVOTA PRIMARY KEY (CORREOUSUARIO, IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
)