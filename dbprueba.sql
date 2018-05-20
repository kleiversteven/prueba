/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : dbprueba

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-05-19 09:03:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dpersona
-- ----------------------------
DROP TABLE IF EXISTS `dpersona`;
CREATE TABLE `dpersona` (
  `cedupers` varchar(8) NOT NULL COMMENT 'cedula de la persona',
  `codeprof` int(2) NOT NULL COMMENT 'codigo de la profesion',
  KEY `persona` (`cedupers`),
  KEY `profesion` (`codeprof`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla relacional entre la persona y la profesion, una persona puede tener mas de una profesion';

-- ----------------------------
-- Records of dpersona
-- ----------------------------
INSERT INTO `dpersona` VALUES ('123123', '3');
INSERT INTO `dpersona` VALUES ('12345678', '1');

-- ----------------------------
-- Table structure for dpersonab
-- ----------------------------
DROP TABLE IF EXISTS `dpersonab`;
CREATE TABLE `dpersonab` (
  `cedupers` varchar(8) DEFAULT NULL COMMENT 'cedula',
  `codemarc` int(2) DEFAULT NULL COMMENT 'codigo de la marca del vehiculo',
  `codemode` int(2) DEFAULT NULL COMMENT 'codigo del modelo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relacion persona vehiculo';

-- ----------------------------
-- Records of dpersonab
-- ----------------------------
INSERT INTO `dpersonab` VALUES ('123123', '2', '0');
INSERT INTO `dpersonab` VALUES ('12345678', '1', '1');

-- ----------------------------
-- Table structure for marca
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `codemarc` int(2) NOT NULL AUTO_INCREMENT COMMENT 'codigo de la marca vehiculo',
  `descmarc` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`codemarc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of marca
-- ----------------------------
INSERT INTO `marca` VALUES ('1', 'Ford');
INSERT INTO `marca` VALUES ('2', 'Chevrolet');

-- ----------------------------
-- Table structure for modelo
-- ----------------------------
DROP TABLE IF EXISTS `modelo`;
CREATE TABLE `modelo` (
  `codemode` int(2) NOT NULL AUTO_INCREMENT COMMENT 'codigo del modelo',
  `descmode` varchar(20) DEFAULT NULL,
  `aniomode` year(4) DEFAULT NULL COMMENT 'año del vehiculo',
  `codemarc` int(2) NOT NULL,
  PRIMARY KEY (`codemode`,`codemarc`),
  KEY `relacion` (`codemarc`),
  CONSTRAINT `relacion` FOREIGN KEY (`codemarc`) REFERENCES `marca` (`codemarc`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modelo
-- ----------------------------
INSERT INTO `modelo` VALUES ('1', 'F150', '1997', '1');

-- ----------------------------
-- Table structure for municipios
-- ----------------------------
DROP TABLE IF EXISTS `municipios`;
CREATE TABLE `municipios` (
  `codemuni` int(2) NOT NULL AUTO_INCREMENT COMMENT 'codigo del municipio',
  `descmuni` varchar(50) DEFAULT NULL COMMENT 'descripcion del municipio',
  PRIMARY KEY (`codemuni`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of municipios
-- ----------------------------
INSERT INTO `municipios` VALUES ('1', 'Cardenas');
INSERT INTO `municipios` VALUES ('2', 'San Cristobal');
INSERT INTO `municipios` VALUES ('3', 'Fernandez feo');

-- ----------------------------
-- Table structure for persona
-- ----------------------------
DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `cedupers` varchar(8) NOT NULL COMMENT 'cedula',
  `nombpers` varchar(80) DEFAULT NULL COMMENT 'nombre',
  `nacipers` date DEFAULT NULL COMMENT 'fecha de nacimiento',
  `codemuni` int(2) NOT NULL COMMENT 'municipio',
  `direpers` varchar(255) DEFAULT NULL COMMENT 'direccion',
  `telepers` varchar(11) DEFAULT NULL COMMENT 'telefono',
  `sexopers` varchar(1) DEFAULT NULL COMMENT 'genero',
  `statpers` int(1) DEFAULT '1' COMMENT 'status de la persona',
  PRIMARY KEY (`cedupers`),
  KEY `municipio` (`codemuni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of persona
-- ----------------------------
INSERT INTO `persona` VALUES ('123123', 'prueba', '2001-05-01', '3', 'San Critobal vere 3 casa 1-09', '123123', 'm', '1');
INSERT INTO `persona` VALUES ('12345678', 'jose', '2001-05-09', '2', 'palo gordo calle principal altos de gallardin casa 1-01', '4264760674', 'm', '1');

-- ----------------------------
-- Table structure for profesion
-- ----------------------------
DROP TABLE IF EXISTS `profesion`;
CREATE TABLE `profesion` (
  `codeprof` int(2) NOT NULL AUTO_INCREMENT COMMENT 'codigo de la profesion',
  `descprof` varchar(30) DEFAULT NULL COMMENT 'profesion',
  PRIMARY KEY (`codeprof`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of profesion
-- ----------------------------
INSERT INTO `profesion` VALUES ('1', 'Ing civil');
INSERT INTO `profesion` VALUES ('2', 'Albañil');
INSERT INTO `profesion` VALUES ('3', 'Licenciada');
