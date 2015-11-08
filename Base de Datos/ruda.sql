-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2015 a las 04:13:59
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalle de asistencias' AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`idasistencia`, `asi_estado`, `asi_fecha`, `asi_justificacion`, `idcatedra`, `idusuario`, `idaula`) VALUES
(14, 'A', '2015-11-01', 'NO justifico', 1, 7, 2),
(15, 'P', '2015-10-02', 'cambio', 1, 7, 2),
(16, 'A', '2015-11-07', '', 1, 8, 2),
(17, 'P', '2015-11-07', '', 1, 7, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalle de aulas' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`idaula`, `aul_denominacion`, `aul_plazasdisponibles`, `aul_plazashabilitadas`, `id_carrera`, `idplan`, `idturno`) VALUES
(2, 'Aula 1', 49, 50, 1, 1, 'M'),
(3, 'Aula 2', 49, 50, 1, 2, 'M');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `baneo`
--

INSERT INTO `baneo` (`idbaneo`, `bamotivo`, `bafechainicio`, `bafechafin`, `baestado`, `idusuario`) VALUES
(1, 'Prueba', '2015-10-16', '2015-10-17', 'desactivado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `id_carrera` int(3) NOT NULL AUTO_INCREMENT COMMENT 'campo identificador de la tabla',
  `car_denominacion` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'nombre o denominación de la carrera',
  PRIMARY KEY (`id_carrera`),
  UNIQUE KEY `denominacion_UNIQUE` (`car_denominacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalle de carreras' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `car_denominacion`) VALUES
(1, 'Enfermeria'),
(2, 'Ing. Informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catedras`
--

CREATE TABLE IF NOT EXISTS `catedras` (
  `idcatedra` int(3) NOT NULL AUTO_INCREMENT COMMENT 'campo de identificador de la tabla',
  `cat_denominacion` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Nombre o denominacion de la cátedra',
  `cat_diascatedra` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Días que se desarrollara la cátedra',
  PRIMARY KEY (`idcatedra`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalles de cátedras' AUTO_INCREMENT=38 ;

--
-- Volcado de datos para la tabla `catedras`
--

INSERT INTO `catedras` (`idcatedra`, `cat_denominacion`, `cat_diascatedra`) VALUES
(1, 'Metodología del Estudio', ''),
(2, 'Comunicación', ''),
(3, 'Introducción a la Enfermeria', ''),
(4, 'Anatomía I', ''),
(5, 'Biologia General I', ''),
(6, 'Biologia General II', ''),
(7, 'Anatomía II', ''),
(8, 'Histología Embriología', ''),
(9, 'Fundamentos en Enfermería', ''),
(10, 'Anatomía III', ''),
(11, 'Fisiología', ''),
(12, 'Enfermería Materno Infantil', ''),
(13, 'Tecnología en Enfermería I', ''),
(14, 'Microbiología', ''),
(15, 'Bioquímica', ''),
(16, 'Enfermería en Salud Adulto Clínico', ''),
(17, 'Tecnología en Enfermería II', ''),
(18, 'Farmacología Aplicada a la Enfermería I', ''),
(19, 'Tecnología en Enfermería III', ''),
(20, 'Tecnología Geríatrica y Gerontología', ''),
(21, 'Cálculos Básicos en Enfermería', ''),
(22, 'Aspectos Socioculturales', ''),
(23, 'Farmacología Aplicada a la Enfermería II', ''),
(24, 'Tecnología en Enfermería IV', ''),
(25, 'Salud Preventiva y Enfermería Comunitaria', ''),
(26, 'Ética y Deontología', ''),
(27, 'Nutrición y Dieto Terapia I', ''),
(28, 'Rehabilitación en Enfermería', ''),
(29, 'Enfermería en Urgencias I', ''),
(30, 'Psicología Gral', ''),
(31, 'Enfermería en Urgencias II', ''),
(32, 'Enfermería Gineco Obstétrica', ''),
(33, 'Enfermería en Salud Mental', ''),
(34, 'Nutrición y Dieto Terapia II', ''),
(35, 'Antropología', ''),
(36, 'Hematología', ''),
(37, 'Enfermería del Niño y del Adolecente', '');

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
(1, 1, NULL),
(1, 2, 'LUNES'),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(2, 6, NULL),
(2, 7, NULL),
(2, 8, NULL),
(2, 9, NULL),
(3, 10, NULL),
(3, 11, NULL),
(3, 12, NULL),
(3, 13, NULL),
(4, 14, 'Martes'),
(4, 15, 'Jueves'),
(4, 16, NULL),
(4, 17, NULL),
(5, 18, NULL),
(5, 19, NULL),
(5, 20, NULL),
(5, 21, NULL),
(5, 22, NULL),
(6, 23, NULL),
(6, 24, NULL),
(6, 25, NULL),
(6, 26, NULL),
(7, 27, NULL),
(7, 28, NULL),
(7, 29, NULL),
(7, 30, NULL),
(8, 31, NULL),
(8, 32, NULL),
(8, 33, NULL),
(8, 34, NULL),
(8, 35, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) DEFAULT NULL,
  `user_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(45) NOT NULL,
  `comentario` varchar(150) NOT NULL,
  `fecha` datetime NOT NULL,
  `idtarea` int(3) NOT NULL,
  `ruta_archivo` varchar(100) DEFAULT NULL,
  `nombre_archivo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `fk_comments_tareas1_idx` (`idtarea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`idcomentario`, `autor`, `comentario`, `fecha`, `idtarea`, `ruta_archivo`, `nombre_archivo`) VALUES
(12, 'ruben', 'prueba adjunto', '2015-10-23 18:33:13', 6, 'C:/xampp/htdocs/RUDA/assets/uploads/comentarios/Registro_Profesor.PNG', 'Registro_Profesor.PNG'),
(13, 'ruben', 'prueba sin adjunto', '2015-10-23 18:34:05', 6, 'NULL', 'NULL'),
(14, 'Ing. Freddy Aguero', 'holaaaa', '2015-10-28 14:51:43', 6, 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE IF NOT EXISTS `inscripcion` (
  `idinscripcion` int(10) NOT NULL AUTO_INCREMENT,
  `ins_nombre` varchar(100) NOT NULL,
  `ins_nrocedula` int(10) unsigned NOT NULL,
  `ins_direccion` varchar(100) NOT NULL,
  `ins_telefono` int(10) NOT NULL,
  `ins_email` varchar(30) NOT NULL,
  `ins_password` varchar(40) NOT NULL,
  `ins_pregunta` varchar(100) NOT NULL,
  `ins_respuesta` varchar(40) NOT NULL,
  `ins_visto` tinyint(1) NOT NULL,
  `ins_turno` varchar(1) NOT NULL,
  `idaula` int(3) NOT NULL,
  `idplan` int(3) NOT NULL,
  `id_carrera` int(3) NOT NULL,
  PRIMARY KEY (`idinscripcion`),
  KEY `fk_inscripcion_aulas1_idx` (`idaula`),
  KEY `fk_inscripcion_plan_estudios1_idx` (`idplan`),
  KEY `fk_inscripcion_carreras1_idx` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Volcado de datos para la tabla `notas_examenes`
--

INSERT INTO `notas_examenes` (`id`, `idcatedra`, `idplan`, `idusuario`, `parcial`, `recuperatorio`, `primer_ordinario`, `segundo_ordinario`, `complementario`, `extraordinario`, `mesa_especial`) VALUES
(58, 1, 1, 8, 20, NULL, 50, NULL, NULL, NULL, NULL),
(59, 1, 1, 7, 20, NULL, 50, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `notas_tarea`
--

INSERT INTO `notas_tarea` (`id`, `puntos_asignados`, `puntos_logrados`, `idcatedra`, `idtarea`, `idusuario`) VALUES
(1, 100, 50, 1, 7, 7);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro de Plan de estudio para aulas' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `plan_estudios`
--

INSERT INTO `plan_estudios` (`idplan`, `pla_denominacion`, `pla_fechainicio`, `pla_fechafin`) VALUES
(1, 'Enfermeria Primer Módulo', '2015-11-07', '2015-11-30'),
(2, 'Enfermeria Segundo Módulo', '2015-11-07', '2015-11-21'),
(3, 'Enfermeria Tercer  Módulo', '2015-11-08', '2015-11-30'),
(4, 'Enfermeria Cuarto   Módulo', '2015-11-07', '2015-11-21'),
(5, 'Enfermeria Quinto Módulo', '2015-11-13', '2015-11-30'),
(6, 'Enfermeria Sexto Módulo', '2015-11-07', '2015-11-30'),
(7, 'Enfermeria Séptimo Módulo', '2015-11-07', '2015-11-30'),
(8, 'Enfermeria Octavo Módulo', '2015-11-07', '2015-11-25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `recuperacion`
--

INSERT INTO `recuperacion` (`idrecuperacion`, `recupregunta`, `recurespuesta`, `idusuario`) VALUES
(1, 'Su numero de cedula es?', 'fcea920f7412b5da7be0cf42b8c93759', 8),
(2, 'gato', '3b24fa7e14555a1912e5bc2198f8e075', 7),
(3, 'Cual es tu heroe Favorito', 'ec0e2603172c73a8b644bb9456c1ff6e', 9),
(4, 'El nombre de tu perro', '666442f1bbc965815c5017a5d7bbd669', 11);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y Detalles de tareas' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idtarea`, `tar_descripcion`, `tar_fechaasignacion`, `tar_fechaentrega`, `tar_puntostarea`, `idcatedra`, `idaula`, `tar_nombrearchivo`, `tar_rutaarchivo`) VALUES
(6, 'prueba sin archivo adjunto', '2015-10-23', '2015-10-24', 100, 1, 2, 'NULL', 'NULL'),
(7, 'prueba 2 con archivo adjunto', '2015-10-23', '2015-10-24', 100, 1, 2, 'Registro_Profesor1.PNG', 'C:/xampp/htdocs/RUDA/assets/uploads/Registro_Profesor1.PNG'),
(8, 'prueba tarea domingo', '2015-11-01', '2015-11-03', 100, 1, 2, 'NULL', 'NULL');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=60 ;

--
-- Volcado de datos para la tabla `tcalendario`
--

INSERT INTO `tcalendario` (`idagenda`, `fecha`, `evento`, `prioridad`, `idaula`, `idusuario`) VALUES
(56, '2015-10-30', 'todas', '2', 2, 6),
(57, '2015-10-30', 'todas', '2', 3, 6),
(58, '2015-10-30', 'aula 1', '2', 2, 6),
(59, '2015-10-30', 'aula 2', '2', 3, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro y detalles de los usuarios' AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `usu_nombre`, `usu_nrocedula`, `usu_direccion`, `usu_telefono`, `usu_email`, `usu_password`, `idperfil`) VALUES
(4, 'admin', 123456, 'luque', 123, 'admin@admin.com', '202cb962ac59075b964b07152d234b70', '1'),
(6, 'Ing. Freddy Aguero', 123, 'Fernando de la Mora', 123, 'freddy@profesor.com', '202cb962ac59075b964b07152d234b70', '2'),
(7, 'ruben', 4345503, 'magallanes', 123, 'ruben@alumno.com', '202cb962ac59075b964b07152d234b70', '3'),
(8, 'Ing. Diego Casco', 1234567, 'luque', 123, 'toledorubendario921@gmail.com', '202cb962ac59075b964b07152d234b70', '3'),
(9, 'Daniel Ferreira', 1234, 'luque', 123, 'danipedro23@gmail.com', '202cb962ac59075b964b07152d234b70', '3'),
(11, 'jose ma', 12345, 'luque', 123, 'toledorubendario91@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2');

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
(7, 2),
(8, 2),
(9, 3);

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
(6, 1),
(6, 2),
(6, 6),
(6, 7);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `fk_asistencias_aulas1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ASISTENCIAS_CATEDRAS1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ASISTENCIAS_USUARIOS1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `fk_aulas_carreras1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aulas_plan_estudios1` FOREIGN KEY (`idplan`) REFERENCES `plan_estudios` (`idplan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `baneo`
--
ALTER TABLE `baneo`
  ADD CONSTRAINT `fk_baneo_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cate_plan`
--
ALTER TABLE `cate_plan`
  ADD CONSTRAINT `fk_CATEDRAS_has_PLAN_ESTUDIOS_CATEDRAS1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CATEDRAS_has_PLAN_ESTUDIOS_PLAN_ESTUDIOS1` FOREIGN KEY (`idplan`) REFERENCES `plan_estudios` (`idplan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_tareas1` FOREIGN KEY (`idtarea`) REFERENCES `tareas` (`idtarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `fk_inscripcion_aulas1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripcion_plan_estudios1` FOREIGN KEY (`idplan`) REFERENCES `plan_estudios` (`idplan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripcion_carreras1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas_examenes`
--
ALTER TABLE `notas_examenes`
  ADD CONSTRAINT `fk_notas_examenes_catedras1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_examenes_plan_estudios1` FOREIGN KEY (`idplan`) REFERENCES `plan_estudios` (`idplan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_examenes_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas_tarea`
--
ALTER TABLE `notas_tarea`
  ADD CONSTRAINT `fk_notas_tarea_catedras1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_tarea_tareas1` FOREIGN KEY (`idtarea`) REFERENCES `tareas` (`idtarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_tarea_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD CONSTRAINT `fk_RECUPERACION_USUARIOS1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reset`
--
ALTER TABLE `reset`
  ADD CONSTRAINT `fk_reset_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_TAREAS_CATEDRAS1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tareas_aulas1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcalendario`
--
ALTER TABLE `tcalendario`
  ADD CONSTRAINT `fk_tcalendario_aulas1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tcalendario_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usu_au`
--
ALTER TABLE `usu_au`
  ADD CONSTRAINT `fk_USUARIOS_has_AULAS_AULAS1` FOREIGN KEY (`idaula`) REFERENCES `aulas` (`idaula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIOS_has_AULAS_USUARIOS1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usu_cate`
--
ALTER TABLE `usu_cate`
  ADD CONSTRAINT `fk_USUARIOS_has_CATEDRAS_CATEDRAS1` FOREIGN KEY (`idcatedra`) REFERENCES `catedras` (`idcatedra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIOS_has_CATEDRAS_USUARIOS1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
