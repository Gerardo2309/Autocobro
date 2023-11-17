DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (/*----Actualizado 01/07/2022-----*/
  `id_rol` int(2) NOT NULL AUTO_INCREMENT,
  `nom_rol` text NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rol`(`nom_rol`) VALUES ('Administrador');
INSERT INTO `rol`(`nom_rol`) VALUES ('Vendedor');
INSERT INTO `rol`(`nom_rol`) VALUES ('Cajero');
INSERT INTO `rol`(`nom_rol`) VALUES ('Mesero');


DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (/*----Actualizado 01/07/2022-----*/
  `id_usuario` varchar(10) NOT NULL,
  `nom_user` text NOT NULL,
  `apellido` text NOT NULL,
  `password` text NOT NULL,
  `id_rol` int(2) NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  FOREIGN KEY (`id_rol`) REFERENCES rol(id_rol) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users(id_usuario, nom_user, apellido, password, id_rol, status) VALUES ('Gerardo023','Gerardo','Cordova','ab767dcbd54062cc93af26df2f8fe8b077d13002fdf83ba4d0f3d373148b1de4f38bbaaf582c7066873af2ea6ba2da469c25256db4d7aa79a97f69fdd2648992','1','0');
INSERT INTO users(id_usuario, nom_user, apellido, password, id_rol, status) VALUES ('Prueba01','Juan','Ramirez','ab767dcbd54062cc93af26df2f8fe8b077d13002fdf83ba4d0f3d373148b1de4f38bbaaf582c7066873af2ea6ba2da469c25256db4d7aa79a97f69fdd2648992','2','0');
INSERT INTO users(id_usuario, nom_user, apellido, password, id_rol, status) VALUES ('Prueba02','Pedro','Ortiz','ab767dcbd54062cc93af26df2f8fe8b077d13002fdf83ba4d0f3d373148b1de4f38bbaaf582c7066873af2ea6ba2da469c25256db4d7aa79a97f69fdd2648992','3','0');

select articulos.nombres, preciousd,preciomxm,stock, users.nom_user, apellido from articulos, users where articulos.codigobar = 'K000275' and users.id_usuario = 'Prueba02';

DROP TABLE IF EXISTS `categoria`;/*----Actualizado 01/07/2022-----*/
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` varchar(10) NOT NULL,
  `nom_categoria` text NOT NULL,
  `proveedor` text NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `articulos`;/*----Actualizado 01/07/2022-----*/
CREATE TABLE IF NOT EXISTS `articulos` (
  `cod_articulo` varchar(8) NOT NULL,
  `nom_articulo` text NOT NULL,
  `id_categoria` varchar(10) NULL,
  `preciousd` decimal(8,2) NOT NULL,
  `preciomxm` decimal(8,2) NOT NULL,  
  `stock` INT(3) NOT NULL,
  PRIMARY KEY (`cod_articulo`),
  FOREIGN KEY (`id_categoria`) REFERENCES categoria(id_categoria) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `ingreso`;/***pendiente***/
CREATE TABLE IF NOT EXISTS `ingreso` (
  `id_ingreso` varchar(8) NOT NULL,
  `id_usuario` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_ingreso) REFERENCES articulos(codigobar) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `caja`;/*--Actualizado 01/07/2022*/
CREATE TABLE IF NOT EXISTS `caja` (
  `id_caja` int NOT NULL,
  `gafete` varchar(13) NOT NULL,
  `id_usuario` varchar(10) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`gafete`),
  FOREIGN KEY (id_usuario) REFERENCES users(id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `detalle_caja`;/*--Actualizado 01/07/2022*/
CREATE TABLE IF NOT EXISTS `detalle_caja` (
  `gafete` varchar(13) NOT NULL,
  `cod_articulo` varchar(8) NOT NULL,
  `cantidad` int(3) NOT NULL,
  FOREIGN KEY (gafete) REFERENCES caja(gafete)ON DELETE CASCADE,
  FOREIGN KEY (cod_articulo) REFERENCES articulos(cod_articulo) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `banco`;/*--Actualizado 01/07/2022*/
CREATE TABLE IF NOT EXISTS `banco` (
  `cod_bank` varchar(8) NOT NULL,
  `nom_bank` text NOT NULL,
  `mxn_usd` varchar(3) NOT NULL,
  PRIMARY KEY (`cod_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `venta`;/*----Actualizado 21/05/2022-----*/
CREATE TABLE IF NOT EXISTS `venta` (
  `idventa` int NOT NULL AUTO_INCREMENT,
  `total` decimal(8,2) NOT NULL,
  `gafete` varchar(13) NOT NULL,
  `banco` varchar(8) NOT NULL,
  `mxn_usd` varchar(3) NOT NULL,
  `vendedor` varchar(10) NOT NULL,
  `cajero` varchar(10) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idventa`),
  FOREIGN KEY (vendedor) REFERENCES users(id_usuario),
  FOREIGN KEY (cajero) REFERENCES users(id_usuario),
  FOREIGN KEY (banco) REFERENCES banco(cod_bank)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `detalle_vents`;/*----Actualizado 21/05/2022-----*/
CREATE TABLE IF NOT EXISTS `detalle_vents` (
  `id` int NOT NULL,
  `cod_articulo` varchar(8) NOT NULL,
  `cantidad` int(3) NOT NULL,
  FOREIGN KEY (cod_articulo) REFERENCES articulos(cod_articulo),
  FOREIGN KEY (id) REFERENCES venta(idventa) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE venta ADD CONSTRAINT `venta_ibfk_2` 
FOREIGN KEY (`cajero`) REFERENCES `users` (`id_usuario`);

INSERT INTO articulos(cod_articulo, nom_articulo, id_categoria, preciousd, preciomxm, stock) VALUES ('K000275','SIL.RNG.WHT','KJER01WHS','15.1','377.5','1');

INSERT INTO articulos(cod_articulo, nom_articulo, id_categoria, preciousd, preciomxm, stock) VALUES ('S020960','MICHAEL K 0MK1046-1855T356','KMR9SGMK0','92','2300','1');

INSERT INTO articulos(cod_articulo, nom_articulo, id_categoria, preciousd, preciomxm, stock) VALUES ('S021033','LLAVEROS CANCUN','KOTSLVF40','0.5','12.5','200');

INSERT INTO articulos(cod_articulo, nom_articulo, id_categoria, preciousd, preciomxm, stock) VALUES ('S021087','BOLSA DE PLAYA GRANDE','KOTSBV840','7.83','195.75','40');

INSERT INTO articulos(cod_articulo, nom_articulo, id_categoria, preciousd, preciomxm, stock) VALUES ('S021086','BOLSA DE PLAYA MEDIANA','KOTSBV840','7.25','181','30');

INSERT INTO categoria(id_categoria, nom_categoria, proveedor) VALUES ('KJER01WHS','BOLSA DE PLAYA MEDIANA','a');
INSERT INTO categoria(id_categoria, nom_categoria, proveedor) VALUES ('KMR9SGMK0','BOLSA DE PLAYA MEDIANA','a');
INSERT INTO categoria(id_categoria, nom_categoria, proveedor) VALUES ('KOTSLVF40','BOLSA DE PLAYA MEDIANA','a');
INSERT INTO categoria(id_categoria, nom_categoria, proveedor) VALUES ('KOTSBV840','BOLSA DE PLAYA MEDIANA','b');



INSERT INTO `ingreso`(`id_ingreso`) VALUES ('K000275');

INSERT INTO `ingreso`(`id_ingreso`) VALUES ('S020960');

INSERT INTO `ingreso`(`id_ingreso`) VALUES ('S021033');

INSERT INTO `ingreso`(`id_ingreso`) VALUES ('S021087');

INSERT INTO `ingreso`(`id_ingreso`) VALUES ('S021086');

DROP TABLE IF EXISTS `detalle_discounts`;/*----Actualizado 03/06/2022-----*/
CREATE TABLE IF NOT EXISTS `detalle_discounts` (
  `id_detalle` int NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(8) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_detalle`),
  FOREIGN KEY (id_usuario) REFERENCES users(id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `discounts`;/*----Actualizado 03/06/2022-----*/
CREATE TABLE IF NOT EXISTS `discounts` (
  `id_discount` int(1) NOT NULL,
  `nom_discount` varchar(10) NOT NULL,
  `id_detalle` int NOT NULL,
  PRIMARY KEY (`id_discount`),
  FOREIGN KEY (id_detalle) REFERENCES detalle_discounts(id_detalle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


