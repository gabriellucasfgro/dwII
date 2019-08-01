-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 26-Fev-2018 às 22:10
-- Versão do servidor: 5.7.21
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aula02`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_alunos`
--

CREATE TABLE `tb_alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `curso` varchar(80) CHARACTER SET utf16 NOT NULL,
  `turma` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_alunos`
--

INSERT INTO `tb_alunos` (`id`, `nome`, `curso`, `turma`) VALUES
(1, 'MARIA EDUARDA DA SILVA', 'INFORMÁTICA - EMI', 'INFO18'),
(2, 'DOUGLAS RODRIGO ALVES', 'MECÂNICA - EMI', 'MEC15'),
(11, 'ANA PAULA MARQUES', 'INFORMÁTICA-EMI', 'INFO17'),
(12, 'RENATO ALBERTO TELLES GOMES', 'INFORMÁTICA-EMI', 'INFO18'),
(13, 'DANIEL DA SILVA SOUZA JR', 'MECÂNICA - EMI', 'MEC15'),
(14, 'WELLINGTON DIAS ARAUJO E SILVA', 'MECÂNICA - EMI', 'MEC17'),
(15, 'MARCOS AURÉLIO', 'INFORMÁTICA - EMI', 'INFO14'),
(17, 'LUIZ GUSTAVO ARAÚJO', 'MEIO AMBIENTE - EMI', 'MAMB15'),
(20, 'TATIANE MARQUES RIBEIRO', 'MECÂNICA - EMI', 'MEC18'),
(21, 'MARIELA ROBERTA ALVES', 'INFORMÁTICA-EMI', 'INFO15'),
(22, 'JANAINA OLIVEIRA ROSA', 'MECÂNICA - EMI', 'MEC17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_evento`
--

CREATE TABLE `tb_evento` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `data` date NOT NULL,
  `carga_horaria` int(11) NOT NULL,
  `responsavel` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_evento`
--

INSERT INTO `tb_evento` (`id`, `nome`, `data`, `carga_horaria`, `responsavel`) VALUES
(1, 'SETIMA - SEMANA ACADÊMICA DE INFORMÁTICA', '2018-10-22', 40, 'WAGNER RODRIGO WEINERT'),
(2, 'SEMEPI - SEMANA DA EXTENSÃO, PESQUISA E INOVAÇÃO', '2018-06-25', 80, 'MATEUS GOMES DAS NEVES');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_evento_alunos`
--

CREATE TABLE `tb_evento_alunos` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_evento_alunos`
--

INSERT INTO `tb_evento_alunos` (`id`, `id_evento`, `id_aluno`) VALUES
(4, 2, 13),
(5, 2, 2),
(6, 2, 22),
(7, 2, 17),
(8, 2, 15),
(9, 1, 11),
(10, 1, 13),
(11, 1, 1),
(12, 1, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alunos`
--
ALTER TABLE `tb_alunos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_evento_alunos`
--
ALTER TABLE `tb_evento_alunos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alunos`
--
ALTER TABLE `tb_alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_evento_alunos`
--
ALTER TABLE `tb_evento_alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
