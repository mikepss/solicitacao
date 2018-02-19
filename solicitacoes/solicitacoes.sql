-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26-Abr-2016 às 22:57
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solicitacoes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `supervisor` int(11) DEFAULT NULL,
  `turno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `area`
--

INSERT INTO `area` (`id`, `nome`, `supervisor`, `turno`) VALUES
(1, 'Agente de Segurança', 1, 'Matutino'),
(2, 'Agente de Segurança', 2, 'Vespertino'),
(3, 'Agente de Segurança', 3, 'Noturno'),
(4, 'Supervisor', 4, 'Integral');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ferias`
--

CREATE TABLE `ferias` (
  `id` int(11) NOT NULL,
  `data_solicitada` datetime DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `dias` int(11) DEFAULT NULL,
  `pecunia` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `aprovacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ferias`
--

INSERT INTO `ferias` (`id`, `data_solicitada`, `data_inicio`, `dias`, `pecunia`, `id_usuario`, `aprovacao`) VALUES
(1, '2016-04-26 17:53:00', '2016-04-30', 25, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `emailsup` varchar(100) NOT NULL,
  `area` int(11) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `diaferias` int(11) NOT NULL,
  `diatroca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `matricula`, `senha`, `email`, `emailsup`, `area`, `nivel`, `diaferias`, `diatroca`) VALUES
(1, 'Michael Pereira', 14291, '123', 'michael@unicamp.br', 'sidney@unicamp.br', 1, 1, 25, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ferias`
--
ALTER TABLE `ferias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ferias`
--
ALTER TABLE `ferias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
