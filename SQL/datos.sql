-- Datos de ejemplo
-- IMPORTANTE: Importar primero tablas.sql

USE TIENESHUECO;

INSERT INTO USUARIO (CORREO, PASS, NOMBRE)
VALUES ("propie@tar.io","propietario","Propietario");
INSERT INTO USUARIO (CORREO, PASS, NOMBRE)
VALUES ("otropropie@tar.io","otropropietario","Otro Propietario");
INSERT INTO USUARIO (CORREO, PASS, NOMBRE)
VALUES ("grand@dad.com","fleenstones","Grand Dad");
INSERT INTO USUARIO (CORREO, PASS, NOMBRE)
VALUES ("md5@md5.md5","md5","md5");


INSERT INTO ENCUESTA (ID, NOMBRE, PROPIETARIO)
VALUES ("20d59b95948b67ce4cadaac4f7934b1a","Reunión","propie@tar.io");
INSERT INTO ENCUESTA (ID, NOMBRE, PROPIETARIO)
VALUES ("ee057c31ff0e9d301189cfbbaea44c3f","Quedada youtuber para darse patadas voladoras","propie@tar.io");
INSERT INTO ENCUESTA (ID, NOMBRE, PROPIETARIO)
VALUES ("71ce30c162e84936de7584ed3c384b5b","Prueba","otropropie@tar.io");
INSERT INTO ENCUESTA (ID, NOMBRE, PROPIETARIO)
VALUES ("01b3f378798d72bf73c8050d76707e0a","Cumpleaños","otropropie@tar.io");
INSERT INTO ENCUESTA (ID, NOMBRE, PROPIETARIO)
VALUES ("d8c30b0993a4029a9f307767b3f2436e","Fleenstones!?","grand@dad.com");
INSERT INTO ENCUESTA (ID, NOMBRE, PROPIETARIO)
VALUES ("1bc29b36f623ba82aaf6724fd3b16718","md5","md5@md5.md5");


INSERT INTO FECHA (IDENCUESTA, FECHA)
VALUES ("20d59b95948b67ce4cadaac4f7934b1a","2018-12-04");
INSERT INTO FECHA (IDENCUESTA, FECHA)
VALUES ("20d59b95948b67ce4cadaac4f7934b1a","2018-12-05");

INSERT INTO FECHA (IDENCUESTA, FECHA)
VALUES ("71ce30c162e84936de7584ed3c384b5b","2018-12-25");


INSERT INTO HORA (IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("20d59b95948b67ce4cadaac4f7934b1a","2018-12-04","12:00:00","13:00:00");
INSERT INTO HORA (IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("20d59b95948b67ce4cadaac4f7934b1a","2018-12-04","16:00:00","19:00:00");

INSERT INTO HORA (IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("20d59b95948b67ce4cadaac4f7934b1a","2018-12-05","12:00:00","14:00:00");

INSERT INTO HORA (IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("71ce30c162e84936de7584ed3c384b5b","2018-12-25","12:00:00","13:00:00");
INSERT INTO HORA (IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("71ce30c162e84936de7584ed3c384b5b","2018-12-25","14:00:00","16:00:00");
INSERT INTO HORA (IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("71ce30c162e84936de7584ed3c384b5b","2018-12-25","18:00:00","20:00:00");


INSERT INTO VOTA (CORREOUSUARIO, IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("otropropie@tar.io","20d59b95948b67ce4cadaac4f7934b1a","2018-12-04","12:00:00","13:00:00");
INSERT INTO VOTA (CORREOUSUARIO, IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("otropropie@tar.io","20d59b95948b67ce4cadaac4f7934b1a","2018-12-05","12:00:00","14:00:00");
INSERT INTO VOTA (CORREOUSUARIO, IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("grand@dad.com","20d59b95948b67ce4cadaac4f7934b1a","2018-12-04","12:00:00","13:00:00");

INSERT INTO VOTA (CORREOUSUARIO, IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("otropropie@tar.io","71ce30c162e84936de7584ed3c384b5b","2018-12-25","18:00:00","20:00:00");
INSERT INTO VOTA (CORREOUSUARIO, IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("propie@tar.io","71ce30c162e84936de7584ed3c384b5b","2018-12-25","18:00:00","20:00:00");
INSERT INTO VOTA (CORREOUSUARIO, IDENCUESTA, FECHA, HORAINICIO, HORAFIN)
VALUES ("md5@md5.md5","71ce30c162e84936de7584ed3c384b5b","2018-12-25","18:00:00","20:00:00");