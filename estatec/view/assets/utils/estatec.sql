-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 23-Maio-2023 às 05:13
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estatec`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estagios`
--

CREATE TABLE `estagios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `assunto` varchar(255) NOT NULL,
  `requisitos` text NOT NULL,
  `carga_horaria` varchar(50) NOT NULL,
  `atividades` text NOT NULL,
  `salario` varchar(255) NOT NULL,
  `data_validade` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estagios`
--

INSERT INTO `estagios` (`id`, `nome`, `assunto`, `requisitos`, `carga_horaria`, `atividades`, `salario`, `data_validade`) VALUES
(1, 'Consultório Odontológico', 'Estágio em Consultório Odontológico', 'Estudar na ETEC, noções básicas de informática, competências socioemocionais', 'segunda a sexta, das 14:00 às 18:00', 'atividades administrativas, gerenciamento de redes sociais', 'auxílio de transporte + 700 reais', '2023-11-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rm` varchar(10) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `rm`, `senha`, `created_at`) VALUES
(1, 'Ariel', 'ariel.aio@hotmail.com', '08670', 'Ariel2005*', '2023-05-23 10:45:18'),
(2, 'Forlas', 'forlas@hotmail.com', '08767', 'Forlas2006*', '2023-05-23 11:02:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estagios`
--
ALTER TABLE `estagios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estagios`
--
ALTER TABLE `estagios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
