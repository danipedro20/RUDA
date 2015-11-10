SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema ruda
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ruda` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `ruda` ;

-- -----------------------------------------------------
-- Table `ruda`.`carreras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`carreras` (
  `id_carrera` INT(3) NOT NULL AUTO_INCREMENT COMMENT 'campo identificador de la tabla',
  `car_denominacion` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL COMMENT 'nombre o denominación de la carrera',
  PRIMARY KEY (`id_carrera`),
  UNIQUE INDEX `denominacion_UNIQUE` (`car_denominacion` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Registro y detalle de carreras';


-- -----------------------------------------------------
-- Table `ruda`.`plan_estudios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`plan_estudios` (
  `idplan` INT(3) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `pla_denominacion` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL COMMENT 'Nombre o denominación del Plan de Estudio',
  `pla_fechainicio` DATE NULL DEFAULT NULL,
  `pla_fechafin` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`idplan`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Registro de Plan de estudio para aulas';


-- -----------------------------------------------------
-- Table `ruda`.`aulas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`aulas` (
  `idaula` INT(3) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `aul_denominacion` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL COMMENT 'denominacion o nombre del aula',
  `aul_plazasdisponibles` INT(2) NOT NULL COMMENT 'Lugares o plazas disponibles dentro del aula',
  `aul_plazashabilitadas` INT(2) NOT NULL COMMENT 'lugares o plazas que se habilitaron para el aula',
  `id_carrera` INT(3) NULL DEFAULT NULL,
  `idplan` INT(3) NULL DEFAULT NULL,
  `idturno` VARCHAR(1) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`idaula`),
  INDEX `fk_aulas_carreras1_idx` (`id_carrera` ASC),
  INDEX `fk_aulas_plan_estudios1_idx` (`idplan` ASC),
  CONSTRAINT `fk_aulas_carreras1`
    FOREIGN KEY (`id_carrera`)
    REFERENCES `ruda`.`carreras` (`id_carrera`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aulas_plan_estudios1`
    FOREIGN KEY (`idplan`)
    REFERENCES `ruda`.`plan_estudios` (`idplan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Registro y detalle de aulas';


-- -----------------------------------------------------
-- Table `ruda`.`catedras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`catedras` (
  `idcatedra` INT(3) NOT NULL AUTO_INCREMENT COMMENT 'campo de identificador de la tabla',
  `cat_denominacion` VARCHAR(50) CHARACTER SET 'utf8' NOT NULL COMMENT 'Nombre o denominacion de la cátedra',
  `cat_diascatedra` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Días que se desarrollara la cátedra',
  PRIMARY KEY (`idcatedra`))
ENGINE = InnoDB
AUTO_INCREMENT = 38
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Registro y detalles de cátedras';


-- -----------------------------------------------------
-- Table `ruda`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`usuarios` (
  `idusuario` INT(10) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `usu_nombre` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL COMMENT 'Nombre y Apellido  del usuario',
  `usu_nrocedula` INT(10) NOT NULL COMMENT 'Número de cédula de identidad del usuario',
  `usu_direccion` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL COMMENT 'Dirección actual del usuario',
  `usu_telefono` INT(10) NOT NULL COMMENT 'Número actual para contactar al usuario',
  `usu_email` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL COMMENT 'Correo electronico actual para contactar al usuario',
  `usu_password` VARCHAR(40) CHARACTER SET 'utf8' NOT NULL COMMENT 'Contraseña del usuario',
  `idperfil` VARCHAR(1) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `nro_cedula_UNIQUE` (`usu_nrocedula` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Registro y detalles de los usuarios';


-- -----------------------------------------------------
-- Table `ruda`.`asistencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`asistencias` (
  `idasistencia` INT(3) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `asi_estado` VARCHAR(1) CHARACTER SET 'utf8' NOT NULL COMMENT 'Estado del alumno si esta prsente o ausente (P o A)',
  `asi_fecha` DATE NOT NULL COMMENT 'Fecha Actual ',
  `asi_justificacion` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL COMMENT 'En caso que el alumno presente alguna justificacion por la ausencia',
  `idcatedra` INT(3) NOT NULL COMMENT 'Cátedra en la cual se llama asistencia',
  `idusuario` INT(10) NOT NULL COMMENT 'Usuario relacionado ala lista de asistencia',
  `idaula` INT(3) NOT NULL,
  PRIMARY KEY (`idasistencia`),
  INDEX `fk_ASISTENCIAS_CATEDRAS1_idx` (`idcatedra` ASC),
  INDEX `fk_ASISTENCIAS_USUARIOS1_idx` (`idusuario` ASC),
  INDEX `fk_asistencias_aulas1_idx` (`idaula` ASC),
  CONSTRAINT `fk_asistencias_aulas1`
    FOREIGN KEY (`idaula`)
    REFERENCES `ruda`.`aulas` (`idaula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASISTENCIAS_CATEDRAS1`
    FOREIGN KEY (`idcatedra`)
    REFERENCES `ruda`.`catedras` (`idcatedra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASISTENCIAS_USUARIOS1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `ruda`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Registro y detalle de asistencias';


-- -----------------------------------------------------
-- Table `ruda`.`baneo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`baneo` (
  `idbaneo` INT(10) NOT NULL AUTO_INCREMENT,
  `bamotivo` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `bafechainicio` DATE NOT NULL,
  `bafechafin` DATE NOT NULL,
  `baestado` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL,
  `idusuario` INT(10) NOT NULL,
  PRIMARY KEY (`idbaneo`),
  INDEX `fk_baneo_usuarios1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_baneo_usuarios1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `ruda`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ruda`.`cate_plan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`cate_plan` (
  `idplan` INT(3) NOT NULL COMMENT 'Campo identificador de la Tabla',
  `idcatedra` INT(3) NOT NULL COMMENT 'Campo identificador de la Tabla',
  `diascatedra` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`idplan`, `idcatedra`),
  INDEX `fk_CATEDRAS_has_PLAN_ESTUDIOS_PLAN_ESTUDIOS1_idx` (`idplan` ASC),
  INDEX `fk_CATEDRAS_has_PLAN_ESTUDIOS_CATEDRAS1_idx` (`idcatedra` ASC),
  CONSTRAINT `fk_CATEDRAS_has_PLAN_ESTUDIOS_CATEDRAS1`
    FOREIGN KEY (`idcatedra`)
    REFERENCES `ruda`.`catedras` (`idcatedra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CATEDRAS_has_PLAN_ESTUDIOS_PLAN_ESTUDIOS1`
    FOREIGN KEY (`idplan`)
    REFERENCES `ruda`.`plan_estudios` (`idplan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Registtro y Detalle de cátedras y Planes de estudios';


-- -----------------------------------------------------
-- Table `ruda`.`ci_sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`ci_sessions` (
  `session_id` VARCHAR(40) NOT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` VARCHAR(120) NULL DEFAULT NULL,
  `last_activity` INT(10) NULL DEFAULT NULL,
  `user_data` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`session_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ruda`.`tareas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`tareas` (
  `idtarea` INT(3) NOT NULL AUTO_INCREMENT COMMENT 'Campo identificador de la tabla',
  `tar_descripcion` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL COMMENT 'Descripcion de la Tarea ',
  `tar_fechaasignacion` DATE NOT NULL COMMENT 'Fecha en que la Tarea fue creada',
  `tar_fechaentrega` DATE NOT NULL COMMENT 'Fecha de entrega de la Tarea',
  `tar_puntostarea` INT(2) NOT NULL COMMENT 'Puntos que se asigna a una Tarea',
  `idcatedra` INT(3) NOT NULL,
  `idaula` INT(3) NOT NULL,
  `tar_nombrearchivo` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `tar_rutaarchivo` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`idtarea`),
  INDEX `fk_TAREAS_CATEDRAS1_idx` (`idcatedra` ASC),
  INDEX `fk_tareas_aulas1_idx` (`idaula` ASC),
  CONSTRAINT `fk_tareas_aulas1`
    FOREIGN KEY (`idaula`)
    REFERENCES `ruda`.`aulas` (`idaula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TAREAS_CATEDRAS1`
    FOREIGN KEY (`idcatedra`)
    REFERENCES `ruda`.`catedras` (`idcatedra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Registro y Detalles de tareas';


-- -----------------------------------------------------
-- Table `ruda`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`comments` (
  `idcomentario` INT(11) NOT NULL AUTO_INCREMENT,
  `autor` VARCHAR(45) NOT NULL,
  `comentario` VARCHAR(150) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `idtarea` INT(3) NOT NULL,
  `ruta_archivo` VARCHAR(100) NULL DEFAULT NULL,
  `nombre_archivo` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`idcomentario`),
  INDEX `fk_comments_tareas1_idx` (`idtarea` ASC),
  CONSTRAINT `fk_comments_tareas1`
    FOREIGN KEY (`idtarea`)
    REFERENCES `ruda`.`tareas` (`idtarea`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ruda`.`inscripcion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`inscripcion` (
  `idinscripcion` INT(10) NOT NULL AUTO_INCREMENT,
  `ins_nombre` VARCHAR(100) NOT NULL,
  `ins_nrocedula` INT(10) UNSIGNED NOT NULL,
  `ins_direccion` VARCHAR(100) NOT NULL,
  `ins_telefono` INT(10) NOT NULL,
  `ins_email` VARCHAR(30) NOT NULL,
  `ins_password` VARCHAR(40) NOT NULL,
  `ins_pregunta` VARCHAR(100) NOT NULL,
  `ins_respuesta` VARCHAR(40) NOT NULL,
  `ins_visto` TINYINT(1) NOT NULL,
  `ins_turno` VARCHAR(1) NOT NULL,
  `idaula` INT(3) NOT NULL,
  `idplan` INT(3) NOT NULL,
  `id_carrera` INT(3) NOT NULL,
  PRIMARY KEY (`idinscripcion`),
  INDEX `fk_inscripcion_aulas1_idx` (`idaula` ASC),
  INDEX `fk_inscripcion_plan_estudios1_idx` (`idplan` ASC),
  INDEX `fk_inscripcion_carreras1_idx` (`id_carrera` ASC),
  CONSTRAINT `fk_inscripcion_aulas1`
    FOREIGN KEY (`idaula`)
    REFERENCES `ruda`.`aulas` (`idaula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscripcion_carreras1`
    FOREIGN KEY (`id_carrera`)
    REFERENCES `ruda`.`carreras` (`id_carrera`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscripcion_plan_estudios1`
    FOREIGN KEY (`idplan`)
    REFERENCES `ruda`.`plan_estudios` (`idplan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ruda`.`notas_examenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`notas_examenes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `idcatedra` INT(3) NOT NULL,
  `idplan` INT(3) NOT NULL,
  `idusuario` INT(10) NOT NULL,
  `parcial` INT(2) NULL DEFAULT NULL,
  `recuperatorio` INT(2) NULL DEFAULT NULL,
  `primer_ordinario` INT(2) NULL DEFAULT NULL,
  `segundo_ordinario` INT(2) NULL DEFAULT NULL,
  `complementario` INT(3) NULL DEFAULT NULL,
  `extraordinario` INT(3) NULL DEFAULT NULL,
  `mesa_especial` INT(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_notas_examenes_catedras1_idx` (`idcatedra` ASC),
  INDEX `fk_notas_examenes_plan_estudios1_idx` (`idplan` ASC),
  INDEX `fk_notas_examenes_usuarios1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_notas_examenes_catedras1`
    FOREIGN KEY (`idcatedra`)
    REFERENCES `ruda`.`catedras` (`idcatedra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notas_examenes_plan_estudios1`
    FOREIGN KEY (`idplan`)
    REFERENCES `ruda`.`plan_estudios` (`idplan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notas_examenes_usuarios1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `ruda`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 60
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ruda`.`notas_tarea`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`notas_tarea` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `puntos_asignados` INT(3) NULL DEFAULT NULL,
  `puntos_logrados` INT(3) NULL DEFAULT NULL,
  `idcatedra` INT(3) NOT NULL,
  `idtarea` INT(3) NOT NULL,
  `idusuario` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_notas_tarea_catedras1_idx` (`idcatedra` ASC),
  INDEX `fk_notas_tarea_tareas1_idx` (`idtarea` ASC),
  INDEX `fk_notas_tarea_usuarios1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_notas_tarea_catedras1`
    FOREIGN KEY (`idcatedra`)
    REFERENCES `ruda`.`catedras` (`idcatedra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notas_tarea_tareas1`
    FOREIGN KEY (`idtarea`)
    REFERENCES `ruda`.`tareas` (`idtarea`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notas_tarea_usuarios1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `ruda`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ruda`.`recuperacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`recuperacion` (
  `idrecuperacion` INT(10) NOT NULL AUTO_INCREMENT,
  `recupregunta` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL COMMENT 'tabla para recuperacion de contraseña',
  `recurespuesta` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `idusuario` INT(10) NOT NULL,
  PRIMARY KEY (`idrecuperacion`),
  INDEX `fk_RECUPERACION_USUARIOS1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_RECUPERACION_USUARIOS1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `ruda`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ruda`.`reset`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`reset` (
  `idreset` INT(2) NOT NULL AUTO_INCREMENT,
  `token` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `fecha` DATE NOT NULL,
  `idusuario` INT(10) NOT NULL,
  PRIMARY KEY (`idreset`),
  INDEX `fk_reset_usuarios1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_reset_usuarios1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `ruda`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ruda`.`tcalendario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`tcalendario` (
  `idagenda` INT(10) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `evento` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `prioridad` VARCHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `idaula` INT(3) NOT NULL,
  `idusuario` INT(10) NOT NULL,
  PRIMARY KEY (`idagenda`),
  INDEX `fk_tcalendario_aulas1_idx` (`idaula` ASC),
  INDEX `fk_tcalendario_usuarios1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_tcalendario_aulas1`
    FOREIGN KEY (`idaula`)
    REFERENCES `ruda`.`aulas` (`idaula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tcalendario_usuarios1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `ruda`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 60
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `ruda`.`usu_au`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`usu_au` (
  `idusuario` INT(10) NOT NULL COMMENT 'Campo identificador de la tabla',
  `idaula` INT(5) NOT NULL COMMENT 'Campo identificador de la tabla',
  PRIMARY KEY (`idaula`, `idusuario`),
  INDEX `fk_USUARIOS_has_AULAS_AULAS1_idx` (`idaula` ASC),
  INDEX `fk_USUARIOS_has_AULAS_USUARIOS1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_USUARIOS_has_AULAS_AULAS1`
    FOREIGN KEY (`idaula`)
    REFERENCES `ruda`.`aulas` (`idaula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_USUARIOS_has_AULAS_USUARIOS1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `ruda`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'registro y detalle de aulas y usuarios';


-- -----------------------------------------------------
-- Table `ruda`.`usu_cate`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`usu_cate` (
  `idusuario` INT(10) NOT NULL COMMENT 'Campo identificador de la tabla',
  `idcatedra` INT(3) NOT NULL COMMENT 'Campo identificador de la tabla',
  PRIMARY KEY (`idcatedra`, `idusuario`),
  INDEX `fk_USUARIOS_has_CATEDRAS_CATEDRAS1_idx` (`idcatedra` ASC),
  INDEX `fk_USUARIOS_has_CATEDRAS_USUARIOS1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_USUARIOS_has_CATEDRAS_CATEDRAS1`
    FOREIGN KEY (`idcatedra`)
    REFERENCES `ruda`.`catedras` (`idcatedra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_USUARIOS_has_CATEDRAS_USUARIOS1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `ruda`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Registro y detalle de usuarios y catedras';

USE `ruda` ;

-- -----------------------------------------------------
-- Placeholder table for view `ruda`.`vista_asistencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`vista_asistencias` (`usu_nombre` INT, `idusuario` INT, `cat_denominacion` INT, `aul_denominacion` INT, `asi_estado` INT, `asi_fecha` INT, `idcatedra` INT, `asi_justificacion` INT, `idaula` INT);

-- -----------------------------------------------------
-- Placeholder table for view `ruda`.`vista_tareas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ruda`.`vista_tareas` (`idcatedra` INT, `idaula` INT, `idtarea` INT, `tar_descripcion` INT, `tar_fechaasignacion` INT, `tar_fechaentrega` INT, `estado` INT);

-- -----------------------------------------------------
-- View `ruda`.`vista_asistencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ruda`.`vista_asistencias`;
USE `ruda`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ruda`.`vista_asistencias` AS select `usu`.`usu_nombre` AS `usu_nombre`,`usu`.`idusuario` AS `idusuario`,`ca`.`cat_denominacion` AS `cat_denominacion`,`au`.`aul_denominacion` AS `aul_denominacion`,if((`asi`.`asi_estado` = 'P'),'Presente','Ausente') AS `asi_estado`,`asi`.`asi_fecha` AS `asi_fecha`,`asi`.`idcatedra` AS `idcatedra`,`asi`.`asi_justificacion` AS `asi_justificacion`,`asi`.`idaula` AS `idaula` from (((`ruda`.`asistencias` `asi` join `ruda`.`usuarios` `usu` on((`usu`.`idusuario` = `asi`.`idusuario`))) join `ruda`.`catedras` `ca` on((`ca`.`idcatedra` = `asi`.`idcatedra`))) join `ruda`.`aulas` `au` on((`au`.`idaula` = `asi`.`idaula`)));

-- -----------------------------------------------------
-- View `ruda`.`vista_tareas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ruda`.`vista_tareas`;
USE `ruda`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ruda`.`vista_tareas` AS select `ta`.`idcatedra` AS `idcatedra`,`ta`.`idaula` AS `idaula`,`ta`.`idtarea` AS `idtarea`,`ta`.`tar_descripcion` AS `tar_descripcion`,`ta`.`tar_fechaasignacion` AS `tar_fechaasignacion`,`ta`.`tar_fechaentrega` AS `tar_fechaentrega`,if((`n`.`idtarea` <> 'null'),'Corregido','Sin Corregir') AS `estado` from (`ruda`.`tareas` `ta` left join `ruda`.`notas_tarea` `n` on((`ta`.`idtarea` = `n`.`idtarea`)));

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
