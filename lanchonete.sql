-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/08/2023 às 14:57
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lanchonete`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dish`
--

INSERT INTO `dish` (`id`, `name`, `price`, `description`, `img`, `created_at`, `deleted_at`) VALUES
(1, 'Picarones', 20, 'Lorem ipsum dolor sit amet, consectetur adipiscing', 'picarones.jpg', '2023-08-31 09:14:23', NULL),
(2, 'Tacu Tacu', 30, '', 'tacutacu.jpg', '2023-08-31 09:34:24', NULL),
(3, 'Ají de Galinha', 15, '', 'aji.jpg', '2023-08-31 09:34:24', NULL),
(4, 'Cuy', 40, '', 'cuy.jpg', '2023-08-31 09:34:24', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `dish_ingredient`
--

CREATE TABLE `dish_ingredient` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `change_value` float NOT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_confirmation` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_dish`
--

CREATE TABLE `order_dish` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) DEFAULT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_adm` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dish_ingredient`
--
ALTER TABLE `dish_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dish_id` (`dish_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Índices de tabela `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dish_id` (`dish_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `order_dish`
--
ALTER TABLE `order_dish`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id` (`orders_id`),
  ADD KEY `dish_id` (`dish_id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `dish_ingredient`
--
ALTER TABLE `dish_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `dish_ingredient`
--
ALTER TABLE `dish_ingredient`
  ADD CONSTRAINT `dish_ingredient_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`),
  ADD CONSTRAINT `dish_ingredient_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`);

--
-- Restrições para tabelas `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Restrições para tabelas `order_dish`
--
ALTER TABLE `order_dish`
  ADD CONSTRAINT `order_dish_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_dish_ibfk_2` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`);

INSERT INTO `dish` (`id`, `name`, `price`, `description`, `img`, `created_at`, `deleted_at`) VALUES
(1, 'Picarones', 20, 'Lorem ipsum dolor sit amet, consectetur adipiscing', 'picarones.jpg', '2023-08-31 09:14:23', NULL),
(2, 'Tacu Tacu', 30, '', 'tacutacu.jpg', '2023-08-31 09:34:24', NULL),
(3, 'Ají de Galinha', 15, '', 'aji.jpg', '2023-08-31 09:34:24', NULL),
(4, 'Cuy', 40, '', 'cuy.jpg', '2023-08-31 09:34:24', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
