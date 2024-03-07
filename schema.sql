-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/03/2024 às 15:27
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
-- Banco de dados: `api_php`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cpf`, `endereco`, `email`) VALUES
(1, 'JOHNNY', '11111111112', '11111111112', 'johnny@email.com'),
(2, 'JUAREZ', '22222222211', '11111111112', 'juarez@email.com'),
(3, 'JOHNNY DEYMISSON2', '112342', '112342', 'johnny2@email.com'),
(4, 'JOHNNY DEYMISSON4', '12312445', '12312445', 'johnny22@email.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `forma_pagamento`
--

CREATE TABLE `forma_pagamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `parcelas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `forma_pagamento`
--

INSERT INTO `forma_pagamento` (`id`, `nome`, `parcelas`) VALUES
(1, 'VISA', 7),
(2, 'MASTERCARD', 5),
(3, 'PIX', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `quantidade` int(11) DEFAULT 0,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `quantidade`, `preco`) VALUES
(2, 'RAPADURA', 10, 8.00),
(3, 'COCA-COLA', 10, 10.25),
(5, 'CUSCUZ', 10, 10.00),
(6, 'FEIJÃO', 14, 9.00),
(7, 'GUARNARÁ 2L', 20, 8.99),
(8, 'PAÇOCA', 30, 2.50),
(9, 'SUCO DE LARANJA', 9, 11.24),

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_forma_pagamento` int(11) DEFAULT NULL,
  `produto` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`produto`)),
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`id`, `id_cliente`, `id_forma_pagamento`, `produto`, `data_venda`) VALUES
(98, 2, 2, '[{\"id\":2,\"nome\":\"RAPADURA\",\"preco\":8,\"quantidade\":3}]', '2024-03-07 04:29:03'),
(99, 1, 2, '[{\"id\":10,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1},{\"id\":2,\"nome\":\"RAPADURA\",\"preco\":8,\"quantidade\":1}]', '2024-03-07 04:34:05'),
(100, 1, 1, '\"[{\\\"id\\\":11,\\\"nome\\\":\\\"SUCO DE LARANJA\\\",\\\"preco\\\":11.24,\\\"quantidade\\\":1}]\"', '2024-03-07 04:35:01'),
(101, 1, 3, '[{\"id\":13,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 04:43:26'),
(102, 2, 3, '[{\"id\":10,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 04:45:08'),
(103, 1, 3, '[{\"id\":10,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 04:45:21'),
(104, 1, 3, '[{\"id\":11,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 04:45:59'),
(105, 1, 3, '[{\"id\":13,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 04:48:13'),
(106, 1, 2, '[{\"id\":11,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 04:57:04'),
(107, 1, 2, '[{\"id\":5,\"nome\":\"CUSCUZ\",\"preco\":10,\"quantidade\":3}]', '2024-03-07 11:37:29'),
(108, 1, 3, '[{\"id\":9,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 14:02:42'),
(110, 1, 1, '[{\"id\":9,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 14:03:23'),
(111, 2, 2, '[{\"id\":11,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 14:12:17'),
(112, 1, 3, '[{\"id\":11,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 14:14:27'),
(113, 1, 1, '[{\"id\":11,\"nome\":\"SUCO DE LARANJA\",\"preco\":11.24,\"quantidade\":1}]', '2024-03-07 14:15:22');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_forma_pagamento` (`id_forma_pagamento`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`id_forma_pagamento`) REFERENCES `forma_pagamento` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
