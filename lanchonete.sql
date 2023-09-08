-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Set-2023 às 17:13
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

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
CREATE DATABASE lanchonete;
USE lanchonete;
-- --------------------------------------------------------

--
-- Estrutura da tabela `dishes`
--

CREATE TABLE `dishes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `is_drink` tinyint(1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `price`, `description`, `size`, `is_drink`, `img`, `created_at`) VALUES
(1, 'Tacu Tacu', 60, 'O tacu-tacu é um prato tradicional do Peru que combina arroz e feijão. Os grãos são misturados e refogados com cebola, alho e pimentão. A mistura é compactada na frigideira até formar uma crosta dourada. ', 'Grande', 0, '64f9e03e7378b.jfif', '2023-09-07 11:37:50'),
(2, 'Salchipapas', 40, 'A salchipapas é uma comida rápida e popular no Peru. É uma combinação das palavras \"salchicha\" (salsicha) e \"papas\" (batatas). O prato consiste em salsichas fritas e batatas fritas cortadas em palitos, servidas geralmente com molhos como ketchup, maionese', 'Médio', 0, '64f9e10a96d32.webp', '2023-09-07 11:41:14'),
(3, 'Lomo Saltado', 80, 'O lomo saltado é um prato emblemático da culinária peruana que combina influências chinesas e peruanas. É conhecido por sua combinação única de sabores e texturas.', 'Grande', 0, '64f9e16a9edfc.jpg', '2023-09-07 11:42:50'),
(4, 'Causa a la limeña', 20, 'A causa a la limeña é uma entrada fria e colorida. É uma deliciosa combinação de sabores suaves e picantes.\r\n', 'Pequeno', 0, '64f9e1e16a9e3.jpg', '2023-09-07 11:44:49'),
(5, 'Pisco Sour', 15, 'O Pisco Sour é um coquetel emblemático do Peru, feito à base de pisco, uma aguardente de uva típica da região. Leva pisco, suco de limão, xarope de açúcar, clara de ovo e algumas gotas de amargo de Angostura. É agitado vigorosamente para criar uma espuma ', '500 ml', 1, '64fb39c31a0da.jfif', '2023-09-08 12:12:03'),
(6, 'Chilcano', 18, 'O Chilcano é feito com pisco e ginger ale (ou cerveja de gengibre), e é geralmente servido com gelo e uma fatia de limão ou lima. A bebida tem um sabor levemente adocicado e efervescente, com uma nota picante do ginger ale que contrasta bem com a suavidad', '500 ml', 1, '64fb39ed1c761.jpg', '2023-09-08 12:12:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dishes_ingredients`
--

CREATE TABLE `dishes_ingredients` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dishes_ingredients`
--

INSERT INTO `dishes_ingredients` (`id`, `quantity`, `dish_id`, `ingredient_id`, `created_at`) VALUES
(1, 1, 1, 1, '2023-09-07 11:37:50'),
(2, 1, 1, 2, '2023-09-07 11:37:50'),
(3, 1, 1, 3, '2023-09-07 11:37:50'),
(4, 1, 1, 4, '2023-09-07 11:37:51'),
(5, 1, 1, 5, '2023-09-07 11:37:51'),
(6, 1, 1, 6, '2023-09-07 11:37:51'),
(7, 2, 2, 7, '2023-09-07 11:41:14'),
(8, 2, 2, 8, '2023-09-07 11:41:14'),
(9, 1, 2, 9, '2023-09-07 11:41:14'),
(10, 1, 2, 10, '2023-09-07 11:41:15'),
(11, 1, 2, 11, '2023-09-07 11:41:15'),
(12, 1, 3, 3, '2023-09-07 11:42:51'),
(13, 1, 3, 4, '2023-09-07 11:42:51'),
(14, 1, 3, 6, '2023-09-07 11:42:51'),
(15, 1, 3, 12, '2023-09-07 11:42:51'),
(16, 1, 3, 13, '2023-09-07 11:42:51'),
(17, 1, 3, 14, '2023-09-07 11:42:51'),
(18, 1, 4, 3, '2023-09-07 11:44:49'),
(19, 1, 4, 5, '2023-09-07 11:44:49'),
(20, 1, 4, 6, '2023-09-07 11:44:49'),
(21, 1, 4, 7, '2023-09-07 11:44:49'),
(22, 1, 4, 11, '2023-09-07 11:44:49'),
(23, 1, 4, 15, '2023-09-07 11:44:49'),
(24, 1, 4, 16, '2023-09-07 11:44:50'),
(25, 1, 5, 17, '2023-09-08 12:12:03'),
(26, 1, 6, 18, '2023-09-08 12:12:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `quantity`, `created_at`) VALUES
(1, 'Feijão canário', 99, '2023-09-07 11:31:51'),
(2, 'Arroz', 99, '2023-09-07 11:32:07'),
(3, 'Cebola roxa', 147, '2023-09-07 11:32:16'),
(4, 'Alho', 199, '2023-09-07 11:32:25'),
(5, 'Pimenta-ají amarela', 147, '2023-09-07 11:32:37'),
(6, 'Pimenta', 297, '2023-09-07 11:32:49'),
(7, 'Batata', 299, '2023-09-07 11:33:14'),
(8, 'Salsicha', 300, '2023-09-07 11:33:19'),
(9, 'Ketchup', 100, '2023-09-07 11:33:29'),
(10, 'Mostarda', 100, '2023-09-07 11:33:35'),
(11, 'Maionese', 99, '2023-09-07 11:33:40'),
(12, 'Carne bovina', 200, '2023-09-07 11:33:49'),
(13, 'Molho de soja', 100, '2023-09-07 11:33:57'),
(14, 'Tomate', 300, '2023-09-07 11:34:04'),
(15, 'Abacate', 148, '2023-09-07 11:35:09'),
(16, 'Frango', 198, '2023-09-07 11:35:20'),
(17, 'Pisco Sour', 50, '2023-09-08 12:11:00'),
(18, 'Chilcano', 50, '2023-09-08 12:11:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `change_value` float NOT NULL,
  `district` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `complement` varchar(255) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_confirmation` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders_dishes`
--

CREATE TABLE `orders_dishes` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `is_adm` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `cpf`, `is_adm`, `created_at`) VALUES
(1, 'Administrador', 'admin@merenderos.com', '$2y$10$AiN7bK7ng8oiLcrh1FhvruyI2cz6G5FOSs8evnSgVlW9a5/do9QfK', '12345678', 1, '2023-09-07 11:30:33');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `dishes_ingredients`
--
ALTER TABLE `dishes_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dish_id` (`dish_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Índices para tabela `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `orders_dishes`
--
ALTER TABLE `orders_dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dish_id` (`dish_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `dishes_ingredients`
--
ALTER TABLE `dishes_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `orders_dishes`
--
ALTER TABLE `orders_dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `dishes_ingredients`
--
ALTER TABLE `dishes_ingredients`
  ADD CONSTRAINT `dishes_ingredients_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`),
  ADD CONSTRAINT `dishes_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`);

--
-- Limitadores para a tabela `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `orders_dishes`
--
ALTER TABLE `orders_dishes`
  ADD CONSTRAINT `orders_dishes_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`),
  ADD CONSTRAINT `orders_dishes_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
