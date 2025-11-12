-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/11/2025 às 17:09
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
  `comentario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacao`
--

INSERT INTO `avaliacao` (`idAvaliacao`, `idAluno`, `idProfessor`, `idDisciplina`, `bimestre`, `notaClareza`, `notaDidatica`, `notaInteracao`, `notaMotivacao`, `notaDominioConteudo`, `notaOrganizacao`, `notaRecursos`, `comentario`) VALUES
(1, 4, 4, 4, '2º Bimestre', 5, 5, 5, 5, 5, 5, 5, 'muito bom, maravilhoso'),
(2, 4, 4, 10, '1º Bimestre', 3, 2, 1, 2, 1, 5, 1, 'hasjdhashdahsd');

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(11) NOT NULL,
  `nomeCurso` varchar(100) NOT NULL,
  `nivel` enum('Técnico','Tecnólogo','Bacharelado','Licenciatura') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`idCurso`, `nomeCurso`, `nivel`) VALUES
(1, 'Técnico em Desenvolvimento de Sistemas (TDS)', 'Técnico'),
(2, 'Técnico em Meio Ambiente', 'Técnico'),
(3, 'Edificação', 'Técnico');

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

INSERT INTO `disciplina` (`idDisciplina`, `nomeDisciplina`) VALUES
(2, 'Matemática'),
(3, 'Português'),
(4, 'Banco de Dados'),
(5, 'Química I'),
(6, 'matemática'),
(7, 'Química'),
(8, 'Português'),
(9, 'Biologia I'),
(10, 'Orientação a Objetos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `codigoTurma` varchar(15) NOT NULL,
  `anoTurma` int(11) NOT NULL,
  `turno` enum('Matutino','Vespertino','Noturno','Integral') NOT NULL,
  `idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `idUsuario`, `codigoTurma`, `anoTurma`, `turno`, `idCurso`) VALUES
(2, 1, '676687', 2022, 'Matutino', 1),
(10, NULL, '676686', 2022, 'Vespertino', 3),
(11, NULL, '676685', 2022, 'Matutino', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmaalunos`
--

CREATE TABLE `turmaalunos` (
  `idTurmaAlunos` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTurmaDisciplina` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmaalunos`
--

INSERT INTO `turmaalunos` (`idTurmaAlunos`, `idUsuario`, `idTurmaDisciplina`, `idTurma`) VALUES
(1, 4, 0, 2),
(2, 4, 0, 2),
(3, 4, 0, 2),
(4, 4, 0, 2),
(5, 4, 0, 2),
(6, 1, 0, 2),
(7, 6, 0, 11),
(8, 7, 0, 10),
(9, 7, 0, 10);

-- --------------------------------------------------------

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
-- Despejando dados para a tabela `turmadisciplina`
--

INSERT INTO `turmadisciplina` (`idTurmaDisciplina`, `idTurma`, `idDisciplina`, `idProfessor`) VALUES
(2, 2, 2, 4),
(3, 2, 3, 4),
(4, 2, 4, 4),
(5, 2, 5, 4),
(6, 10, 6, 4),
(7, 10, 7, 4),
(8, 10, 8, 4),
(9, 11, 9, 4),
(10, 2, 10, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idCurso` int(11) DEFAULT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipoUsuario` enum('aluno','professor','admin') NOT NULL DEFAULT 'aluno',
  `siape` int(11) DEFAULT NULL,
  `declaracaoMatricula` varchar(255) DEFAULT NULL,
  `numMatricula` varchar(20) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `idCurso`, `nomeUsuario`, `senha`, `email`, `tipoUsuario`, `siape`, `declaracaoMatricula`, `numMatricula`, `foto_perfil`) VALUES
(1, 1, 'heataer', '$2y$10$Y49i5tPHcdluuLVZSEQH1OEUlKXDgazm5PlDQtJBRYor/iIf2xgYe', 'heataer@gmail.com', 'aluno', NULL, NULL, '2435657', NULL),
(2, NULL, 'jefferson', '$1$tvVhcEZO$cT41dxrJtfkKowfrEd.zb/', 'jefferson@gmail.com', 'professor', 123123123, NULL, NULL, NULL),
(3, NULL, 'heloise', '$1$.DOxOK.Q$4NGYR3cd3CgnHEocbJqX00', 'heloise@gmail.com', 'admin', NULL, NULL, NULL, 'arquivo_690924899dd02.jpg'),
(4, 1, 'erick jhorge', '$2y$10$y6mlokZbQ7ghIpzgP35UQepsNqNpzWKaVM3DsNWMfU.ZDZV2A4vKK', 'erick@gmail.com', 'aluno', NULL, 'arquivo_69035a121b0f8.pdf', '1234566', NULL),
(5, NULL, 'ana carla', '$2y$10$8GvQWsPiX8WWJugUSdMljOn8C0QAxFmheoLnWpAY8H03eh75/nO0e', 'anacarla@gmail.com', 'professor', 123456, NULL, NULL, 'arquivo_6894a1046123e.jpg'),
(6, 2, 'tailane', '$2y$10$K/vseikGYxQE/6A4RvV1gu1d/tCw3Q0HT2uqHwAeIV24ADbmguf9e', 'tailane@gmail.com', 'aluno', NULL, 'arquivo_690c9a3be42ca.pdf', '123456', NULL),
(7, 3, 'arian', '$2y$10$ahV9HpaEMRPoquZnroOqKedTf2J.1VxmZOfLrlSzPP.dnoNJpzKhm', 'arian@gmail.com', 'aluno', NULL, 'arquivo_690c9aba85dcd.pdf', '123456', NULL);

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
  ADD KEY `idDisciplina` (`idDisciplina`);

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
  ADD KEY `fk_turma_usuario1` (`idUsuario`),
  ADD KEY `fk_turma_curso` (`idCurso`);

--
-- Índices de tabela `turmaalunos`
--
ALTER TABLE `turmaalunos`
  ADD PRIMARY KEY (`idTurmaAlunos`),
  ADD KEY `fk_turmasAlunos_usuarios1` (`idUsuario`),
  ADD KEY `fk_turmaAlunos_turmaDisciplina` (`idTurmaDisciplina`),
  ADD KEY `fk_turmaAlunos_turma` (`idTurma`);

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
  ADD KEY `fk_usuarios_cursos` (`idCurso`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `idAvaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `turmaalunos`
--
ALTER TABLE `turmaalunos`
  MODIFY `idTurmaAlunos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `turmadisciplina`
--
ALTER TABLE `turmadisciplina`
  MODIFY `idTurmaDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`idProfessor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `avaliacao_ibfk_3` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_curso` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`),
  ADD CONSTRAINT `fk_turma_usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `turmaalunos`
--
ALTER TABLE `turmaalunos`
  ADD CONSTRAINT `fk_turmaAlunos_turma` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE,
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
