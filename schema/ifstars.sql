-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/11/2025 às 04:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ifstars`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `idAvaliacao` int(11) NOT NULL,
  `idAluno` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `bimestre` enum('1º Bimestre','2º Bimestre','3º Bimestre','4º Bimestre') NOT NULL,
  `notaClareza` int(11) NOT NULL,
  `notaDidatica` int(11) NOT NULL,
  `notaInteracao` int(11) NOT NULL,
  `notaMotivacao` int(11) NOT NULL,
  `notaDominioConteudo` int(11) NOT NULL,
  `notaOrganizacao` int(11) NOT NULL,
  `notaRecursos` int(11) NOT NULL,
  `comentario` varchar(100) DEFAULT NULL,
  `idTurma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(11) NOT NULL,
  `nomeCurso` varchar(100) NOT NULL,
  `nivel` enum('tecnico','tecnologo','bacharelado','licenciatura') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curso`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `idDisciplina` int(11) NOT NULL,
  `nomeDisciplina` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplina`
--


-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL,
  `codigoTurma` int(15) NOT NULL,
  `anoTurma` int(11) NOT NULL,
  `turno` enum('Matutino','Vespertino','Noturno','Integral') NOT NULL,
  `idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmaalunos`
--

CREATE TABLE `turmaalunos` (
  `idTurmaAlunos` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--


--
-- Estrutura para tabela `turmadisciplina`
--

CREATE TABLE `turmadisciplina` (
  `idTurmaDisciplina` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--



--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idCurso` int(11) DEFAULT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `tipoUsuario` enum('aluno','professor','admin') NOT NULL DEFAULT 'aluno',
  `siape` int(11) DEFAULT NULL,
  `declaracaoMatricula` varchar(255) DEFAULT NULL,
  `numMatricula` varchar(20) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `status` enum('ativo','pendente','','') NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--
--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`idAvaliacao`),
  ADD KEY `idAluno` (`idAluno`),
  ADD KEY `idProfessor` (`idProfessor`),
  ADD KEY `idDisciplina` (`idDisciplina`),
  ADD KEY `fk_avaliacao_turma` (`idTurma`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`);

--
-- Índices de tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`idDisciplina`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idTurma`),
  ADD KEY `fk_turma_curso` (`idCurso`);

--
-- Índices de tabela `turmaalunos`
--
ALTER TABLE `turmaalunos`
  ADD PRIMARY KEY (`idTurmaAlunos`),
  ADD UNIQUE KEY `unique_aluno_turma` (`idUsuario`,`idTurma`),
  ADD KEY `fk_turmaalunos_turma` (`idTurma`);

--
-- Índices de tabela `turmadisciplina`
--
ALTER TABLE `turmadisciplina`
  ADD PRIMARY KEY (`idTurmaDisciplina`),
  ADD KEY `fk_turmadisciplina_turma` (`idTurma`),
  ADD KEY `fk_turmadisciplina_disciplina` (`idDisciplina`),
  ADD KEY `fk_discTurma_usuario` (`idProfessor`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuarios_cursos` (`idCurso`);



--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `idAvaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `turmaalunos`
--
ALTER TABLE `turmaalunos`
  MODIFY `idTurmaAlunos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `turmadisciplina`
--
ALTER TABLE `turmadisciplina`
  MODIFY `idTurmaDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`idProfessor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `avaliacao_ibfk_3` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_avaliacao_turma` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`);

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_curso` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`);

--
-- Restrições para tabelas `turmaalunos`
--
ALTER TABLE `turmaalunos`
  ADD CONSTRAINT `fk_turmaalunos_turma` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`),
  ADD CONSTRAINT `fk_turmasAlunos_usuarios1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `turmadisciplina`
--
ALTER TABLE `turmadisciplina`
  ADD CONSTRAINT `fk_discTurma_usuario` FOREIGN KEY (`idProfessor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `fk_turmadisciplina_disciplina` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turmadisciplina_turma` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuarios_cursos` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
