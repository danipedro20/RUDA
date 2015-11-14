-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2015 a las 17:15:35
-- Versión del servidor: 5.5.36
-- Versión de PHP: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ruda`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`ruben`@`localhost` PROCEDURE `insertar_solicitudes`(in ins_nombre varchar(30), ins_nrocedula varchar(10),ins_direccion varchar(50),ins_telefono varchar(10), ins_email varchar(50), ins_password varchar(40),ins_pregunta varchar(100),ins_respuesta varchar(40),ins_visto int(1),ins_turno varchar(1),idaula int(3),idplan int(3),id_carrera int(3))
BEGIN
/*DECLARE nombre varchar(45)*/
INSERT INTO inscripcion VALUES (idinscripcion,ins_nombre,ins_nrocedula,ins_direccion,ins_telefono,ins_email,ins_password,ins_pregunta,ins_respuesta,ins_visto,ins_turno,idaula,idplan,id_carrera);
END$$

CREATE DEFINER=`ruben`@`localhost` PROCEDURE `insertar_usuarios`(in usu_nombre varchar(30), usu_nrocedula varchar(10),usu_direccion varchar(50),usu_telefono varchar(10), usu_email varchar(50), usu_password varchar(40),idperfil int(1))
BEGIN
/*DECLARE nombre varchar(45)*/
INSERT INTO usuarios VALUES (idusuario,usu_nombre,usu_nrocedula,usu_direccion,usu_telefono,usu_email,usu_password,idperfil);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE IF NOT EXISTS `asistencias` (
  `idasistencia` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `asi_estado` varchar(1) CHARACTER SET utf8 NOT NULL COMMENT 'Estado del alumno si esta prsente o ausente (P o A)',
  `asi_fecha` date NOT NULL COMMENT 'Fecha Actual ',
  `asi_justificacion` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'En caso que el alumno presente alguna justificacion por la ausencia',
  `idcatedra` int(3) NOT NULL COMMENT 'Cátedra en la cual se llama asistencia',
  `idusuario` int(10) NOT NULL COMMENT 'Usuario relacionado ala lista de asistencia',
  `idaula` int(3) NOT NULL,
  PRIMARY KEY (`idasistencia`),
  KEY `fk_ASISTENCIAS_CATEDRAS1_idx` (`idcatedra`),
  KEY `fk_ASISTENCIAS_USUARIOS1_idx` (`idusuario`),
  KEY `fk_asistencias_aulas1_idx` (`idaula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalle de asistencias' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE IF NOT EXISTS `aulas` (
  `idaula` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `aul_denominacion` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT 'denominacion o nombre del aula',
  `aul_plazasdisponibles` int(2) NOT NULL COMMENT 'Lugares o plazas disponibles dentro del aula',
  `aul_plazashabilitadas` int(2) NOT NULL COMMENT 'lugares o plazas que se habilitaron para el aula',
  `id_carrera` int(3) DEFAULT NULL,
  `idplan` int(3) DEFAULT NULL,
  `idturno` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idaula`),
  KEY `fk_aulas_carreras1_idx` (`id_carrera`),
  KEY `fk_aulas_plan_estudios1_idx` (`idplan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalle de aulas' AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`idaula`, `aul_denominacion`, `aul_plazasdisponibles`, `aul_plazashabilitadas`, `id_carrera`, `idplan`, `idturno`) VALUES
(4, 'Aula 1', 98, 100, 3, 9, 'M'),
(5, 'Aula 1', 100, 100, 3, 9, 'T'),
(6, 'Aula 1', 100, 100, 3, 9, 'N'),
(7, 'Aula 2', 100, 100, 3, 10, 'M'),
(8, 'Aula 2', 100, 100, 3, 10, 'T'),
(9, 'Aula 2', 100, 100, 3, 10, 'N'),
(10, 'Aula 3', 100, 100, 3, 11, 'M'),
(11, 'Aula 3', 100, 100, 3, 11, 'T'),
(12, 'Aula 3', 100, 100, 3, 11, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `baneo`
--

CREATE TABLE IF NOT EXISTS `baneo` (
  `idbaneo` int(10) NOT NULL AUTO_INCREMENT,
  `bamotivo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `bafechainicio` date NOT NULL,
  `bafechafin` date NOT NULL,
  `baestado` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `idusuario` int(10) NOT NULL,
  PRIMARY KEY (`idbaneo`),
  KEY `fk_baneo_usuarios1_idx` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `baneo`
--

INSERT INTO `baneo` (`idbaneo`, `bamotivo`, `bafechainicio`, `bafechafin`, `baestado`, `idusuario`) VALUES
(1, 'Prueba', '2015-11-13', '2015-11-13', 'desactivado', 13),
(2, '444', '2015-11-13', '2015-11-13', 'desactivado', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `id_carrera` int(3) NOT NULL AUTO_INCREMENT COMMENT 'campo identificador de la tabla',
  `car_denominacion` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'nombre o denominación de la carrera',
  PRIMARY KEY (`id_carrera`),
  UNIQUE KEY `denominacion_UNIQUE` (`car_denominacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalle de carreras' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `car_denominacion`) VALUES
(3, 'Ingeniería en Informática'),
(4, 'Licenciatura en Diseño Gráfico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catedras`
--

CREATE TABLE IF NOT EXISTS `catedras` (
  `idcatedra` int(3) NOT NULL AUTO_INCREMENT COMMENT 'campo de identificador de la tabla',
  `cat_denominacion` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Nombre o denominacion de la cátedra',
  `cat_diascatedra` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Días que se desarrollara la cátedra',
  PRIMARY KEY (`idcatedra`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalles de cátedras' AUTO_INCREMENT=90 ;

--
-- Volcado de datos para la tabla `catedras`
--

INSERT INTO `catedras` (`idcatedra`, `cat_denominacion`, `cat_diascatedra`) VALUES
(1, 'Introducción ala Informática', ''),
(2, 'Análisis Matemático I', ''),
(3, 'Introducción ala Base de Datos', ''),
(4, 'Ingles Técnico I', ''),
(5, 'Análisis Matemático II', ''),
(6, 'Estructura de Datos I', ''),
(7, 'Introducción ala Programación', ''),
(8, 'Ingles Técnico II', ''),
(9, 'Matemática Discreta', ''),
(10, 'Estructura de Datos II', ''),
(11, 'Diseño y Construcción de Páginas Web (HTML)', ''),
(12, 'Ingles Técnico III', ''),
(13, 'Laboratorio I', ''),
(14, 'Base de Datos I', ''),
(15, 'Física I', ''),
(16, 'Fundamento ala P.O.O', ''),
(17, 'Geometría Analítica', ''),
(18, 'Laboratorio II', ''),
(19, 'Maso terapia Practico III', ''),
(20, 'Sistema y Métodos', ''),
(21, 'Trabajo Final de Programación', ''),
(22, 'Sistemas I', ''),
(23, 'Probabilidad y Estadística', ''),
(24, 'Ingenieria del Software I', ''),
(25, 'Redes e Internet', ''),
(26, 'Sistemas Operativos', ''),
(27, 'Ingenieria del Software II', ''),
(28, 'Seguridad en Redes ', ''),
(29, 'Organizacion de Empresas', ''),
(30, 'Sistemas II', ''),
(31, 'Calculo Numérico', ''),
(32, 'Arquitectura de Ordenadores', ''),
(33, 'Base de Datos III', ''),
(34, 'Diseño Web Avanzado', ''),
(35, 'Metodología de la Investigación', ''),
(36, 'Gestión de Proyecto Informatico', ''),
(37, 'Sistemas III', ''),
(38, 'Seguridad y Auditoria Informática', ''),
(40, 'Física II', ''),
(41, 'Contabilidad', ''),
(42, 'Ética Profesional', ''),
(43, 'Evaluación de Sistemas Informáticos', ''),
(44, 'Presentación y Defensa del Sistema Desarrollado', ''),
(45, 'Ingeniería del Conocimiento I', ''),
(46, 'Lenguaje y Autómata', ''),
(47, 'Gestión de Calidad', ''),
(48, 'Tutoria I', ''),
(49, 'Ingeniería del Conocimiento II', ''),
(50, 'Compiladores I', ''),
(51, 'Inteligencia Artificial I', ''),
(52, 'Compiladores II', ''),
(53, 'Inteligencia Artificial II', ''),
(54, 'Sistema Paralelo y Distribuido', ''),
(55, 'Tutoria III', ''),
(56, 'Tutoria II', ''),
(57, 'Diseño Gráfico I', ''),
(58, 'Gráfica Digital I', ''),
(59, 'Taller de Diseño Gráfico I', ''),
(60, 'Diseño Gráfico II', ''),
(61, 'Gráfica Digital II', ''),
(62, 'Taller de Diseño Gráfico II', ''),
(63, 'Historia del Arte y el Diseño I', ''),
(64, 'Diseño Gráfico III', ''),
(65, 'Gráfica Digital III', ''),
(66, 'Historia del Arte y el Diseño II', ''),
(67, 'Gráfica Digital VI', ''),
(68, 'Tipografía I', ''),
(69, 'Señalética', ''),
(70, 'Gráfica Digital V', ''),
(71, 'Tipografía III', ''),
(72, 'Métodos de impresión', ''),
(73, 'Publicidad I', ''),
(74, 'Gráfica Digital VI', ''),
(75, 'Fotografía I', ''),
(76, 'Publicidad II', ''),
(77, 'Gráfica Digital VII', ''),
(78, 'Fotografía II', ''),
(79, 'Gráfica Digital VIII', ''),
(80, 'Marketing', ''),
(81, 'Packaging', ''),
(82, 'Publicidad III', ''),
(83, 'Diseño Editorial', ''),
(84, 'Metodología de la Investigación I', ''),
(85, 'Metodología de la Investigación II', ''),
(86, 'Planeamiento Estratégico', ''),
(87, 'Taller Audio Visual', ''),
(88, 'Proyectos de Inversión ', ''),
(89, 'Campaña Gráfica y Presupuesto', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cate_plan`
--

CREATE TABLE IF NOT EXISTS `cate_plan` (
  `idplan` int(3) NOT NULL COMMENT 'Campo identificador de la Tabla',
  `idcatedra` int(3) NOT NULL COMMENT 'Campo identificador de la Tabla',
  `diascatedra` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idplan`,`idcatedra`),
  KEY `fk_CATEDRAS_has_PLAN_ESTUDIOS_PLAN_ESTUDIOS1_idx` (`idplan`),
  KEY `fk_CATEDRAS_has_PLAN_ESTUDIOS_CATEDRAS1_idx` (`idcatedra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registtro y Detalle de cátedras y Planes de estudios';

--
-- Volcado de datos para la tabla `cate_plan`
--

INSERT INTO `cate_plan` (`idplan`, `idcatedra`, `diascatedra`) VALUES
(9, 1, 'Lunes'),
(9, 2, 'Martes'),
(9, 3, 'Miercoles'),
(9, 4, 'Jueves'),
(10, 5, 'Viernes'),
(10, 6, 'Lunes'),
(10, 7, 'Martes'),
(10, 8, 'Miercoles'),
(11, 9, 'Jueves'),
(11, 10, 'Viernes'),
(11, 11, 'Lunes'),
(11, 12, 'Martes'),
(12, 13, 'Miercoles'),
(12, 14, 'Jueves'),
(12, 15, 'Viernes'),
(12, 16, 'Lunes'),
(13, 17, 'Martes'),
(13, 18, 'Miercoles'),
(13, 40, 'Jueves'),
(13, 41, 'Viernes'),
(14, 19, 'Lunes'),
(14, 20, 'Martes'),
(14, 21, 'Miercoles'),
(15, 22, 'Jueves'),
(15, 23, 'Viernes'),
(15, 24, 'Lunes'),
(15, 25, 'Martes'),
(16, 26, 'Miercoles'),
(16, 27, 'Jueves'),
(16, 28, 'Viernes'),
(16, 42, 'Lunes'),
(17, 29, 'Martes'),
(17, 30, 'Miercoles'),
(17, 31, 'Jueves'),
(17, 33, 'Viernes'),
(18, 32, 'Lunes'),
(18, 34, 'Martes'),
(19, 35, 'Miercoles'),
(19, 36, 'Jueves'),
(19, 37, 'Viernes'),
(20, 38, 'Lunes'),
(20, 43, 'Martes'),
(20, 44, 'Miercoles'),
(21, 45, 'Jueves'),
(21, 46, 'Viernes'),
(21, 47, 'Lunes'),
(21, 48, 'Martes'),
(22, 49, 'Miercoles'),
(22, 50, 'Jueves'),
(22, 51, 'Viernes'),
(22, 56, 'Lunes'),
(23, 52, 'Martes'),
(23, 53, 'Miercoles'),
(23, 54, 'Jueves'),
(23, 55, 'Viernes'),
(24, 57, 'Lunes'),
(24, 58, 'Martes'),
(24, 59, 'Miercoles'),
(25, 60, 'Jueves'),
(25, 61, 'Viernes'),
(25, 62, 'Lunes'),
(26, 63, 'Martes'),
(26, 64, 'Miercoles'),
(26, 65, 'Jueves'),
(27, 66, 'Lunes'),
(27, 67, 'Martes'),
(27, 68, 'Miercoles'),
(28, 69, 'Jueves'),
(28, 70, 'Viernes'),
(28, 71, 'Lunes'),
(29, 72, 'Martes'),
(29, 73, 'Miercoles'),
(29, 74, 'Jueves'),
(30, 75, 'Viernes'),
(30, 76, 'Lunes'),
(30, 77, 'Martes'),
(31, 78, 'Miercoles'),
(31, 79, 'Jueves'),
(31, 80, 'Jueves'),
(32, 81, 'Viernes'),
(32, 82, 'Lunes'),
(32, 83, 'Martes'),
(33, 84, 'Martes'),
(33, 85, 'Miercoles'),
(33, 86, 'Jueves'),
(34, 87, 'Jueves'),
(34, 88, 'Viernes'),
(34, 89, 'Lunes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) CHARACTER SET utf8 NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `user_agent` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `last_activity` int(10) DEFAULT NULL,
  `user_data` text CHARACTER SET utf8,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(45) CHARACTER SET utf8 NOT NULL,
  `comentario` varchar(150) CHARACTER SET utf8 NOT NULL,
  `fecha` datetime NOT NULL,
  `idtarea` int(3) NOT NULL,
  `ruta_archivo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nombre_archivo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `fk_comments_tareas1_idx` (`idtarea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE IF NOT EXISTS `inscripcion` (
  `idinscripcion` int(10) NOT NULL AUTO_INCREMENT,
  `ins_nombre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ins_nrocedula` int(10) unsigned NOT NULL,
  `ins_direccion` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ins_telefono` int(10) NOT NULL,
  `ins_email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `ins_password` varchar(40) CHARACTER SET utf8 NOT NULL,
  `ins_pregunta` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ins_respuesta` varchar(40) CHARACTER SET utf8 NOT NULL,
  `ins_visto` int(1) NOT NULL,
  `ins_turno` varchar(1) CHARACTER SET utf8 NOT NULL,
  `idaula` int(3) NOT NULL,
  `idplan` int(3) NOT NULL,
  `id_carrera` int(3) NOT NULL,
  PRIMARY KEY (`idinscripcion`),
  KEY `fk_inscripcion_aulas1_idx` (`idaula`),
  KEY `fk_inscripcion_plan_estudios1_idx` (`idplan`),
  KEY `fk_inscripcion_carreras1_idx` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_examenes`
--

CREATE TABLE IF NOT EXISTS `notas_examenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcatedra` int(3) NOT NULL,
  `idplan` int(3) NOT NULL,
  `idusuario` int(10) NOT NULL,
  `parcial` int(2) DEFAULT NULL,
  `recuperatorio` int(2) DEFAULT NULL,
  `primer_ordinario` int(2) DEFAULT NULL,
  `segundo_ordinario` int(2) DEFAULT NULL,
  `complementario` int(3) DEFAULT NULL,
  `extraordinario` int(3) DEFAULT NULL,
  `mesa_especial` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notas_examenes_catedras1_idx` (`idcatedra`),
  KEY `fk_notas_examenes_plan_estudios1_idx` (`idplan`),
  KEY `fk_notas_examenes_usuarios1_idx` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_tarea`
--

CREATE TABLE IF NOT EXISTS `notas_tarea` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `puntos_asignados` int(3) DEFAULT NULL,
  `puntos_logrados` int(3) DEFAULT NULL,
  `idcatedra` int(3) NOT NULL,
  `idtarea` int(3) NOT NULL,
  `idusuario` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notas_tarea_catedras1_idx` (`idcatedra`),
  KEY `fk_notas_tarea_tareas1_idx` (`idtarea`),
  KEY `fk_notas_tarea_usuarios1_idx` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_estudios`
--

CREATE TABLE IF NOT EXISTS `plan_estudios` (
  `idplan` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `pla_denominacion` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT 'Nombre o denominación del Plan de Estudio',
  `pla_fechainicio` date DEFAULT NULL,
  `pla_fechafin` date DEFAULT NULL,
  PRIMARY KEY (`idplan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro de Plan de estudio para aulas' AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `plan_estudios`
--

INSERT INTO `plan_estudios` (`idplan`, `pla_denominacion`, `pla_fechainicio`, `pla_fechafin`) VALUES
(9, 'Informática Primer Módulo', '2015-11-01', '2015-11-30'),
(10, 'Informática Segundo Módulo', '2015-11-01', '2015-11-30'),
(11, 'Informática Tercer Módulo', '2015-11-01', '2015-11-30'),
(12, 'Informática Cuarto Módulo', '2015-11-01', '2015-11-30'),
(13, 'Informática Quinto Módulo', '2015-11-01', '2015-11-30'),
(14, 'Informática Sexto Módulo', '2015-11-01', '2015-11-30'),
(15, 'Informática Séptimo Módulo', '2015-11-01', '2015-11-30'),
(16, 'Informática Octavo Módulo', '2015-11-01', '2015-11-30'),
(17, 'Informática Noveno Módulo', '2015-11-01', '2015-11-30'),
(18, 'Informática Décimo Módulo', '2015-11-01', '2015-11-30'),
(19, 'Informática Décimo 1er Módulo', '2015-11-01', '2015-11-30'),
(20, 'Informática Décimo 2do Módulo', '2015-11-01', '2015-11-30'),
(21, 'Informática Décimo 3er Módulo', '2015-11-01', '2015-11-30'),
(22, 'Informática Décimo 4to Módulo', '2015-11-01', '2015-11-30'),
(23, 'Informática Décimo 5to Módulo', '2015-11-01', '2015-11-30'),
(24, 'Diseño Gráfico Primer Módulo', '2015-11-01', '2015-11-30'),
(25, 'Diseño Gráfico Segundo Módulo', '2015-11-01', '2015-11-30'),
(26, 'Diseño Gráfico Tercer Módulo', '2015-11-01', '2015-11-30'),
(27, 'Diseño Gráfico Cuarto Módulo', '2015-11-01', '2015-11-30'),
(28, 'Diseño Gráfico Quinto Módulo', '2015-11-01', '2015-11-23'),
(29, 'Diseño Gráfico Sexto Módulo', '2015-11-01', '2015-11-30'),
(30, 'Diseño Gráfico Séptimo Módulo', '2015-11-01', '2015-11-30'),
(31, 'Diseño Gráfico Octavo Módulo', '2015-11-01', '2015-11-30'),
(32, 'Diseño Gráfico Noveno Módulo', '2015-11-01', '2015-11-30'),
(33, 'Diseño Gráfico Décimo Módulo', '2015-11-01', '2015-11-30'),
(34, 'Diseño Gráfico Décimo 1er Módu', '2015-11-01', '2015-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion`
--

CREATE TABLE IF NOT EXISTS `recuperacion` (
  `idrecuperacion` int(10) NOT NULL AUTO_INCREMENT,
  `recupregunta` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'tabla para recuperacion de contraseña',
  `recurespuesta` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `idusuario` int(10) NOT NULL,
  PRIMARY KEY (`idrecuperacion`),
  KEY `fk_RECUPERACION_USUARIOS1_idx` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `recuperacion`
--

INSERT INTO `recuperacion` (`idrecuperacion`, `recupregunta`, `recurespuesta`, `idusuario`) VALUES
(1, 'Cual es tu heroe Favorito', 'ec0e2603172c73a8b644bb9456c1ff6e', 23),
(2, 'Cual es tu heroe Favorito', 'ec0e2603172c73a8b644bb9456c1ff6e', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reset`
--

CREATE TABLE IF NOT EXISTS `reset` (
  `idreset` int(2) NOT NULL AUTO_INCREMENT,
  `token` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `idusuario` int(10) NOT NULL,
  PRIMARY KEY (`idreset`),
  KEY `fk_reset_usuarios1_idx` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE IF NOT EXISTS `tareas` (
  `idtarea` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `tar_descripcion` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT 'Descripcion de la Tarea ',
  `tar_fechaasignacion` date NOT NULL COMMENT 'Fecha en que la Tarea fue creada',
  `tar_fechaentrega` date NOT NULL COMMENT 'Fecha de entrega de la Tarea',
  `tar_puntostarea` int(2) NOT NULL COMMENT 'Puntos que se asigna a una Tarea',
  `idcatedra` int(3) NOT NULL,
  `idaula` int(3) NOT NULL,
  `tar_nombrearchivo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tar_rutaarchivo` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idtarea`),
  KEY `fk_TAREAS_CATEDRAS1_idx` (`idcatedra`),
  KEY `fk_tareas_aulas1_idx` (`idaula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y Detalles de tareas' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcalendario`
--

CREATE TABLE IF NOT EXISTS `tcalendario` (
  `idagenda` int(10) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `evento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `prioridad` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `idaula` int(3) NOT NULL,
  `idusuario` int(10) NOT NULL,
  PRIMARY KEY (`idagenda`),
  KEY `fk_tcalendario_aulas1_idx` (`idaula`),
  KEY `fk_tcalendario_usuarios1_idx` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `usu_nombre` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT 'Nombre y Apellido  del usuario',
  `usu_nrocedula` int(10) NOT NULL COMMENT 'Número de cédula de identidad del usuario',
  `usu_direccion` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'Dirección actual del usuario',
  `usu_telefono` int(10) NOT NULL COMMENT 'Número actual para contactar al usuario',
  `usu_email` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Correo electronico actual para contactar al usuario',
  `usu_password` varchar(40) CHARACTER SET utf8 NOT NULL COMMENT 'Contraseña del usuario',
  `idperfil` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `nro_cedula_UNIQUE` (`usu_nrocedula`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalles de los usuarios' AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `usu_nombre`, `usu_nrocedula`, `usu_direccion`, `usu_telefono`, `usu_email`, `usu_password`, `idperfil`) VALUES
(12, 'admin', 12, 'Pai Perez', 123456789, 'admin@admin.com', '202cb962ac59075b964b07152d234b70', '1'),
(13, 'Ing.Diego Casco', 123, 'Pai Perez', 123456789, 'diegocasco@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(14, 'Lic. Raquel Romero', 1234, 'Pai Perez', 12345678, 'raquelromero@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(15, 'Lic. Antonia Coronel', 12345, 'Pai Perez', 12345678, 'antoniacoronel@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(16, 'Lic. Bettina López', 123456, 'Pai Perez', 12345678, 'bettinalopez@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(17, 'Ing. Ever Casco', 1234567, 'Pai Perez', 12345678, 'evercasco@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(18, 'Ing. Ricardo Sosa', 12345678, 'Pai Perez', 12345678, 'ricardososa@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(19, 'Lic. Juan Alonzo', 123456789, 'Pai Perez', 12345678, 'juanalonzo@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(20, 'Lic. Carlos Martinez', 123456780, 'Pai Perez', 12345678, 'carlosmartinez@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(21, 'V.M José Flores', 1234567891, 'Pai Perez', 12345678, 'joseflores@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(22, 'Ing. Andrea Riego', 1234567892, 'Pai Perez', 12345678, 'andreariego@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(23, 'Ruben Toledo', 4345503, 'Magallanes 1947 casi Pozo Favorito', 971339788, 'toledorubendario91@gmail.com', '202cb962ac59075b964b07152d234b70', '3'),
(26, 'jose', 45789945, 'luque', 123, 'jose@alumno.com', '202cb962ac59075b964b07152d234b70', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu_au`
--

CREATE TABLE IF NOT EXISTS `usu_au` (
  `idusuario` int(10) NOT NULL COMMENT 'Campo identificador de la tabla',
  `idaula` int(5) NOT NULL COMMENT 'Campo identificador de la tabla',
  PRIMARY KEY (`idaula`,`idusuario`),
  KEY `fk_USUARIOS_has_AULAS_AULAS1_idx` (`idaula`),
  KEY `fk_USUARIOS_has_AULAS_USUARIOS1_idx` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='registro y detalle de aulas y usuarios';

--
-- Volcado de datos para la tabla `usu_au`
--

INSERT INTO `usu_au` (`idusuario`, `idaula`) VALUES
(23, 4),
(26, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu_cate`
--

CREATE TABLE IF NOT EXISTS `usu_cate` (
  `idusuario` int(10) NOT NULL COMMENT 'Campo identificador de la tabla',
  `idcatedra` int(3) NOT NULL COMMENT 'Campo identificador de la tabla',
  PRIMARY KEY (`idcatedra`,`idusuario`),
  KEY `fk_USUARIOS_has_CATEDRAS_CATEDRAS1_idx` (`idcatedra`),
  KEY `fk_USUARIOS_has_CATEDRAS_USUARIOS1_idx` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalle de usuarios y catedras';

--
-- Volcado de datos para la tabla `usu_cate`
--

INSERT INTO `usu_cate` (`idusuario`, `idcatedra`) VALUES
(13, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_asistencias`
--
CREATE TABLE IF NOT EXISTS `vista_asistencias` (
`usu_nombre` varchar(30)
,`idusuario` int(10)
,`cat_denominacion` varchar(50)
,`aul_denominacion` varchar(30)
,`asi_estado` varchar(8)
,`asi_fecha` date
,`idcatedra` int(3)
,`asi_justificacion` varchar(30)
,`idaula` int(3)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_tareas`
--
CREATE TABLE IF NOT EXISTS `vista_tareas` (
`idcatedra` int(3)
,`idaula` int(3)
,`idtarea` int(3)
,`tar_descripcion` varchar(30)
,`tar_fechaasignacion` date
,`tar_fechaentrega` date
,`estado` varchar(12)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `vista_asistencias`
--
DROP TABLE IF EXISTS `vista_asistencias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_asistencias` AS select `usu`.`usu_nombre` AS `usu_nombre`,`usu`.`idusuario` AS `idusuario`,`ca`.`cat_denominacion` AS `cat_denominacion`,`au`.`aul_denominacion` AS `aul_denominacion`,if((`asi`.`asi_estado` = 'P'),'Presente','Ausente') AS `asi_estado`,`asi`.`asi_fecha` AS `asi_fecha`,`asi`.`idcatedra` AS `idcatedra`,`asi`.`asi_justificacion` AS `asi_justificacion`,`asi`.`idaula` AS `idaula` from (((`asistencias` `asi` join `usuarios` `usu` on((`usu`.`idusuario` = `asi`.`idusuario`))) join `catedras` `ca` on((`ca`.`idcatedra` = `asi`.`idcatedra`))) join `aulas` `au` on((`au`.`idaula` = `asi`.`idaula`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_tareas`
--
DROP TABLE IF EXISTS `vista_tareas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_tareas` AS select `ta`.`idcatedra` AS `idcatedra`,`ta`.`idaula` AS `idaula`,`ta`.`idtarea` AS `idtarea`,`ta`.`tar_descripcion` AS `tar_descripcion`,`ta`.`tar_fechaasignacion` AS `tar_fechaasignacion`,`ta`.`tar_fechaentrega` AS `tar_fechaentrega`,if((`n`.`idtarea` <> 'null'),'Corregido','Sin Corregir') AS `estado` from (`tareas` `ta` left join `notas_tarea` `n` on((`ta`.`idtarea` = `n`.`idtarea`)));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `fk_asistencias_aulas1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ASISTENCIAS_CATEDRAS1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ASISTENCIAS_USUARIOS1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `fk_aulas_carreras1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aulas_plan_estudios1` FOREIGN KEY (`idplan`) REFERENCES `plan_estudios` (`idplan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `baneo`
--
ALTER TABLE `baneo`
  ADD CONSTRAINT `fk_baneo_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cate_plan`
--
ALTER TABLE `cate_plan`
  ADD CONSTRAINT `fk_CATEDRAS_has_PLAN_ESTUDIOS_CATEDRAS1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_CATEDRAS_has_PLAN_ESTUDIOS_PLAN_ESTUDIOS1` FOREIGN KEY (`idplan`) REFERENCES `plan_estudios` (`idplan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_tareas1` FOREIGN KEY (`idtarea`) REFERENCES `tareas` (`idtarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `fk_inscripcion_aulas1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscripcion_carreras1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscripcion_plan_estudios1` FOREIGN KEY (`idplan`) REFERENCES `plan_estudios` (`idplan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notas_examenes`
--
ALTER TABLE `notas_examenes`
  ADD CONSTRAINT `fk_notas_examenes_catedras1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notas_examenes_plan_estudios1` FOREIGN KEY (`idplan`) REFERENCES `plan_estudios` (`idplan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notas_examenes_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notas_tarea`
--
ALTER TABLE `notas_tarea`
  ADD CONSTRAINT `fk_notas_tarea_catedras1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notas_tarea_tareas1` FOREIGN KEY (`idtarea`) REFERENCES `tareas` (`idtarea`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notas_tarea_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD CONSTRAINT `fk_RECUPERACION_USUARIOS1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reset`
--
ALTER TABLE `reset`
  ADD CONSTRAINT `fk_reset_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_tareas_aulas1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_TAREAS_CATEDRAS1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tcalendario`
--
ALTER TABLE `tcalendario`
  ADD CONSTRAINT `fk_tcalendario_aulas1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tcalendario_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usu_au`
--
ALTER TABLE `usu_au`
  ADD CONSTRAINT `fk_USUARIOS_has_AULAS_AULAS1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_USUARIOS_has_AULAS_USUARIOS1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usu_cate`
--
ALTER TABLE `usu_cate`
  ADD CONSTRAINT `fk_USUARIOS_has_CATEDRAS_CATEDRAS1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_USUARIOS_has_CATEDRAS_USUARIOS1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
