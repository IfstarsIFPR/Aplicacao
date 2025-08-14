-- -----------------------------------------------------
-- Table `curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `nomeCurso` VARCHAR(100) NOT NULL,
  `nivel` ENUM('Técnico', 'Tecnólogo', 'Bacharelado', 'Licenciatura') NOT NULL,
  PRIMARY KEY (`idCurso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `idCurso` INT,
  `nomeUsuario` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `tipoUsuario` ENUM('aluno', 'professor', 'admin') NOT NULL DEFAULT 'aluno',
  `siape` INT NULL,
  `declaracaoMatricula` VARCHAR(255) NULL,
  `numMatricula` VARCHAR(20) NULL,
  PRIMARY KEY (`idUsuario`),
  CONSTRAINT `fk_usuarios_cursos`
    FOREIGN KEY (`idCurso`)
    REFERENCES `curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `disciplina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `disciplina` (
  `idDisciplina` INT NOT NULL AUTO_INCREMENT,
  `idCurso` INT NOT NULL,
  `nomeDisciplina` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idDisciplina`),
  CONSTRAINT `fk_disciplinas_cursos1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `turma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `turma` (
  `idTurma` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `codigoTurma` VARCHAR(15) NOT NULL,
  `anoTurma` INT NOT NULL,
  `turno` ENUM('Matutino', 'Vespertino', 'Noturno', 'Integral') NOT NULL,
  PRIMARY KEY (`idTurma`),
  CONSTRAINT `fk_turma_usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `turmaAlunos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `turmaAlunos` (
  `idTurmaAlunos` INT NOT NULL AUTO_INCREMENT,
  `idTurma` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idTurmaAlunos`),
  CONSTRAINT `fk_turmasAlunos_turmas1`
    FOREIGN KEY (`idTurma`)
    REFERENCES `turma` (`idTurma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_turmasAlunos_usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `turmaDisciplina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `turmaDisciplina` (
  `idTurmaDisciplina` INT NOT NULL AUTO_INCREMENT,
  `idTurma` INT NOT NULL,
  `idDisciplina` INT NOT NULL,
  PRIMARY KEY (`idTurmaDisciplina`),
  CONSTRAINT `fk_turmadisciplina_turma`
    FOREIGN KEY (`idTurma`)
    REFERENCES `turma` (`idTurma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_turmadisciplina_disciplina`
    FOREIGN KEY (`idDisciplina`)
    REFERENCES `disciplina` (`idDisciplina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `idAvaliacao` INT NOT NULL AUTO_INCREMENT,
  `idTurmaAlunos` INT NOT NULL,
  `bimestre` ENUM('1º Bimestre', '2º Bimestre', '3º Bimestre', '4º Bimestre') NOT NULL,
  `notaClareza` INT NOT NULL,
  `notaDidatica` INT NOT NULL,
  `notaInteracao` INT NOT NULL,
  `notaMotivacao` INT NOT NULL,
  `notaDominioConteudo` INT NOT NULL,
  `notaOrganizacao` INT NOT NULL,
  `notaRecursos` INT NOT NULL,
  `comentario` VARCHAR(100) NULL,
  PRIMARY KEY (`idAvaliacao`),
  UNIQUE INDEX `idx_unico_avaliacao` (`idTurmaAlunos` ASC, `bimestre` ASC),
  CONSTRAINT `fk_avaliacao_turmasAlunos1`
    FOREIGN KEY (`idTurmaAlunos`)
    REFERENCES `turmaAlunos` (`idTurmaAlunos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


INSERT INTO usuario (email, senha) 
VALUES ('heataer@gmail.com', '$2y$10$Y49i5tPHcdluuLVZSEQH1OEUlKXDgazm5PlDQtJBRYor/iIf2xgYe'); /* senha 123 */

INSERT INTO curso (nomeCurso, nivel) VALUES ('Técnico em Desenvolvimento de Sistemas (TDS)', 'Técnico');
