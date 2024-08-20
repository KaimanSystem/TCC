-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/08/2024 às 20:23
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
-- Banco de dados: `cadastro-gustavo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `tempo_login` datetime DEFAULT NULL,
  `tempo_logout` datetime DEFAULT NULL,
  `id_computador` int(11) DEFAULT NULL,
  `safe_key` varchar(255) NOT NULL,
  `token_recuperacao` varchar(32) DEFAULT NULL,
  `data_token` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `email`, `senha`, `matricula`, `telefone`, `tempo_login`, `tempo_logout`, `id_computador`, `safe_key`, `token_recuperacao`, `data_token`) VALUES
(1, 'test', 'test@gmail.com', '123', 'JC1234', '12997160603', '2024-08-16 00:24:39', '2024-08-15 16:47:51', 0, '', NULL, NULL),
(2, 'TESTZAO', 'TESTZAO@gmail.com', '123', 'JC123456', '129971606', NULL, NULL, NULL, '', NULL, NULL),
(3, 'aff', 'luiz.gustavo1@aluno.ifsp.edu.br', '123', 'JC123445', '12997160603', NULL, NULL, NULL, '', NULL, NULL),
(5, 'aaaa', 'isso@gmail.com', '3131', '31313', '12997160603', NULL, NULL, NULL, '', NULL, NULL),
(6, 'Ellen', 'ellen@yahoo.com', 'pppjj', '21333', '34567890', '2024-08-10 18:08:30', NULL, 0, '', NULL, NULL),
(7, 'Luiz Gustavo de Oliveira', 'luiz.gavo1@aluno.ifsp.edu.br', '23131', 'JC12345353', '12997160603', NULL, NULL, NULL, '', NULL, NULL),
(10, 'Luiz Gustavo de Oliveira', 'luiz.gavo1@aluno.com', '12131', 'JC144444', '12997160603', NULL, NULL, NULL, '', NULL, NULL),
(12, 'Luiz Gustavo de Oliveira', 'luiz.go1@aluno.com', '414141', 'JC144535353', '12997160603', NULL, NULL, NULL, '', NULL, NULL),
(13, 'Raytê Mendes', 'rayte@gmail.com', '1234', '1234', '12991291827', '2024-08-10 22:50:54', NULL, 0, '', NULL, NULL),
(14, 'test123', 'email@test.com', '1234', 'JC123456789', '12997160603', NULL, NULL, NULL, '', NULL, NULL),
(15, 'Sofia Vasconcellos de Carvalho', 'sofia.vasconcellos@aluno.ifsp.edu.br', '277353', 'JC3013502', '(12) 99731-7730', NULL, NULL, NULL, '', NULL, NULL),
(16, 'Luiz Gustavoo', 'Luiz1@gmail.com', '1234', 'JC3011984', '12997160603', '2024-08-15 19:13:09', NULL, 0, 'bolo de chocolate', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunidade`
--

CREATE TABLE `comunidade` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `tempo_login` datetime DEFAULT NULL,
  `tempo_logout` datetime DEFAULT NULL,
  `cpf` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `servidores`
--

CREATE TABLE `servidores` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `tempo_login` datetime DEFAULT NULL,
  `tempo_logout` datetime DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servidores`
--

INSERT INTO `servidores` (`id`, `nome`, `email`, `senha`, `telefone`, `tempo_login`, `tempo_logout`, `is_admin`) VALUES
(1, '', 'admin@example.com', 'admin123', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuários`
--

CREATE TABLE `usuários` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(110) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `matricula` varchar(65) NOT NULL,
  `telefone` int(11) NOT NULL,
  `cpf` varchar(30) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `token_recuperacao` varchar(255) DEFAULT NULL,
  `data_token` datetime DEFAULT NULL,
  `tempo_login` datetime DEFAULT NULL,
  `tempo_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuários`
--

INSERT INTO `usuários` (`id`, `nome`, `email`, `senha`, `matricula`, `telefone`, `cpf`, `is_admin`, `token_recuperacao`, `data_token`, `tempo_login`, `tempo_logout`) VALUES
(1, 'Administrador', 'admin@example.com', 'admin123', 'JC01', 123456789, NULL, 1, NULL, NULL, NULL, NULL),
(2, 'test', 'test@gmail.com', '1234', 'JC1234', 9999, NULL, 0, NULL, '2024-08-10 17:03:07', '2024-08-10 20:42:48', '2024-08-10 03:11:20'),
(9, 'Tainá Mikelli Spina', 'mikelli.t@aluno.ifsp.edu.br', '12345', 'JC3014673', 2147483647, NULL, 0, NULL, NULL, NULL, NULL),
(10, 'luiz', 'luiz@gmail.com', '1234', 'JC1234', 9999, NULL, 0, NULL, NULL, '2024-08-10 20:42:48', '2024-08-10 03:11:20'),
(11, 'PIN', 'PIN', '1234', '1234', 1111, NULL, 0, NULL, NULL, NULL, NULL),
(12, 'luiz', 'joao@gmail.com', '1234', 'JC1234', 13414141, NULL, 0, NULL, NULL, '2024-08-10 20:42:48', '2024-08-10 03:11:20'),
(13, 'luiz', 'joao@gmail.com', '11111111', 'JC1234333', 1414141, NULL, 0, NULL, NULL, NULL, NULL),
(14, 'Luiz Gustavo de Oliveira', 'luiz.gustavo1@aluno.ifsp.edu.br', '1234', '', 2147483647, NULL, 0, NULL, NULL, NULL, NULL),
(15, 'Luiz Gustavo de Oliveira', 'luiz.gustavo1@aluno.ifsp.edu.br', '1234', '', 2147483647, NULL, 0, NULL, NULL, NULL, NULL),
(16, 'Luiz Gustavo de Oliveira', 'luiz.gustavo1@aluno.ifsp.edu.br', '12314', '', 2147483647, NULL, 0, NULL, NULL, NULL, NULL),
(17, 'luiz', 'joao@gmail.com', '1213131', '', 144444444, NULL, 0, NULL, NULL, NULL, NULL),
(18, 'Luiz Gustavo de Oliveira', 'luiz.gustavo1@aluno.ifsp.edu.br', '1313131', '', 2147483647, NULL, 0, NULL, NULL, NULL, NULL),
(19, 'Luiz Gustavo de Oliveira', 'luiz.gustavo1@aluno.ifsp.edu.br', '1313131', '', 2147483647, NULL, 0, NULL, NULL, NULL, NULL),
(20, 'Luiz Gustavo de Oliveira', 'luiz.gustavo1@aluno.ifsp.edu.br', '123', '', 2147483647, '12345', 0, NULL, NULL, '2024-08-10 08:11:28', '2024-08-10 08:11:37');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `matricula` (`matricula`);

--
-- Índices de tabela `comunidade`
--
ALTER TABLE `comunidade`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `servidores`
--
ALTER TABLE `servidores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `usuários`
--
ALTER TABLE `usuários`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `comunidade`
--
ALTER TABLE `comunidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `servidores`
--
ALTER TABLE `servidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuários`
--
ALTER TABLE `usuários`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
