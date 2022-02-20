-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2022 a las 20:37:13
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `leelim_backend`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_employer`
--

CREATE TABLE `account_employer` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `id_employer` text NOT NULL,
  `password` text NOT NULL,
  `role` text NOT NULL,
  `range` text NOT NULL,
  `todo_list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]' CHECK (json_valid(`todo_list`)),
  `date_create` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_join_us` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `account_employer`
--

INSERT INTO `account_employer` (`id`, `name`, `surname`, `email`, `id_employer`, `password`, `role`, `range`, `todo_list`, `date_create`, `date_join_us`) VALUES
(1, 'QQ', 'QQ', 'email@leelim.es', '1', '2', 'moderator', 'q', '[]', '2021-05-04 20:53:13', '2021-05-04 20:53:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_list`
--

CREATE TABLE `email_list` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `email_list`
--

INSERT INTO `email_list` (`id`, `email`, `password`, `name`, `description`, `date_create`) VALUES
(1, 'info@leelim.es', '12345678', 'Información', 'Email para informaciones, ayudas y soporte.', '2021-05-09 20:16:06'),
(2, 'privacy@leelim.es', '12345678', 'Privacidad y Cookies', 'Email para información sobre politica de privacidad y cookies; temas legales', '2021-05-09 20:18:32'),
(3, 'refund@leelim.es', '12345678', 'Devoluciones de pedidos', 'Email sobre devoluciones de pedidos', '2021-05-09 20:23:23'),
(4, 'joinus@leelim.es', '12345678', 'Puesto de trabajo', 'Email para recibir portfolios y CVs para puestos de trabajo', '2021-05-09 20:24:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_employer`
--

CREATE TABLE `role_employer` (
  `id` int(11) NOT NULL,
  `role_name` text NOT NULL,
  `analytic` tinyint(1) NOT NULL,
  `order` tinyint(1) NOT NULL,
  `shipping` tinyint(1) NOT NULL,
  `payment` tinyint(1) NOT NULL,
  `asset` tinyint(1) NOT NULL DEFAULT 0,
  `email` tinyint(1) NOT NULL,
  `contact` tinyint(1) NOT NULL DEFAULT 0,
  `product` tinyint(1) NOT NULL DEFAULT 0,
  `season` tinyint(1) NOT NULL DEFAULT 0,
  `tools` tinyint(1) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `role_employer`
--

INSERT INTO `role_employer` (`id`, `role_name`, `analytic`, `order`, `shipping`, `payment`, `asset`, `email`, `contact`, `product`, `season`, `tools`, `date_create`) VALUES
(1, 'moderator', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2021-05-06 20:51:29'),
(2, 'guest', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-05-11 14:43:34'),
(3, 'test', 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, '2021-05-11 14:43:34');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `account_employer`
--
ALTER TABLE `account_employer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `email_list`
--
ALTER TABLE `email_list`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_employer`
--
ALTER TABLE `role_employer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `account_employer`
--
ALTER TABLE `account_employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `email_list`
--
ALTER TABLE `email_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `role_employer`
--
ALTER TABLE `role_employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
