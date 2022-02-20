-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2022 a las 20:36:23
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
-- Base de datos: `leelim`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_message`
--

CREATE TABLE `contact_message` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone_number` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `answered` tinyint(1) NOT NULL DEFAULT 0,
  `answered_by` text DEFAULT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contact_message`
--

INSERT INTO `contact_message` (`id`, `name`, `email`, `phone_number`, `title`, `content`, `answered`, `answered_by`, `date_create`) VALUES
(1, 'ZLL', 'zheng9112003@gmail.com', 656676126, 'Error de compra', 'Estab itentando comprar y me dio un error', 1, 'email', '2021-05-22 21:18:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gallery_album_list`
--

CREATE TABLE `gallery_album_list` (
  `id` int(11) NOT NULL,
  `season` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`image`)),
  `product_list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`product_list`)),
  `color_list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`color_list`)),
  `data_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gallery_season`
--

CREATE TABLE `gallery_season` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `cover_img` text NOT NULL,
  `data_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gallery_season`
--

INSERT INTO `gallery_season` (`id`, `name`, `cover_img`, `data_create`) VALUES
(1, '2020AW', '/static/img/database/gallery/tag/20210521/2020AW1621601842.jpg', '2021-05-21 14:57:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local_shop`
--

CREATE TABLE `local_shop` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `province` text NOT NULL,
  `postal_code` int(11) NOT NULL,
  `date_create` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `local_shop`
--

INSERT INTO `local_shop` (`id`, `name`, `address`, `city`, `latitude`, `longitude`, `province`, `postal_code`, `date_create`) VALUES
(1, 'Lee Lim USA', 'C/ ADrees 12 Down city', 'Whasintong', 28.521076, -81.465523, 'Valencia', 46020, '2021-04-05 21:03:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_history`
--

CREATE TABLE `order_history` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]',
  `order_details` text DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`address`)),
  `billing_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`billing_address`)),
  `total_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '{}' CHECK (json_valid(`total_value`)),
  `status` text NOT NULL DEFAULT 'paid',
  `status_code` int(11) NOT NULL DEFAULT 1,
  `order_code` text NOT NULL COMMENT '(AN) OR (LL)+unix_actual+random_two_letter+ES',
  `payment_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`payment_data`)),
  `shipping_code` text DEFAULT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `order_history`
--

INSERT INTO `order_history` (`id`, `account_id`, `order`, `order_details`, `address`, `billing_address`, `total_value`, `status`, `status_code`, `order_code`, `payment_data`, `shipping_code`, `date_create`) VALUES
(1, 0, '[{\"item\":{\"id\":2,\"id_code\":\"FP11\",\"name\":\"Brown Shearling Leather Multi Purpose Bag 2\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"price\":340},\"color\":\"#f0f0f0\",\"size\":\"<?$value?>\",\"amount\":\"2\"}]', '', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"612361236\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LL\",\"surname\":\"Z\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"}', '{\"subtotal\":680,\"extra\":142.8,\"total\":822.8}', 'sent', 3, 'AN1621622570NM5ES', '{\"payment_method\":\"credit-card\",\"data\":{\"id\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"object\":\"payment_intent\",\"amount\":82280,\"amount_capturable\":0,\"amount_received\":82280,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[{\"id\":\"ch_1ItdJLJ9HHZbmVICU3dOLelL\",\"object\":\"charge\",\"amount\":82280,\"amount_captured\":82280,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1ItdJMJ9HHZbmVICGlmzUkVn\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"STRIPE* LEE LIM - ONLI\",\"captured\":true,\"created\":1621622583,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":17,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2024,\"fingerprint\":\"dKcgUyRAwF8OcjpQ\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1Ihgw6J9HHZbmVIC\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/rcpt_JWggTxt7xFa4oayUOQ4cO2YmJ2fvEtC\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/charges?payment_intent=pi_1ItdJKJ9HHZbmVIC5qHAekTC\"},\"client_secret\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC_secret_yPtvjnAIDFcFvJHCb0nxjrqP9\",\"confirmation_method\":\"automatic\",\"created\":1621622582,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}', '12345678', '2021-05-21 20:42:50'),
(2, 0, '[{\"item\":{\"id\":2,\"id_code\":\"FP11\",\"name\":\"Brown Shearling Leather Multi Purpose Bag 2\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"price\":340},\"color\":\"#f0f0f0\",\"size\":\"<?$value?>\",\"amount\":\"2\"}]', '', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"612361236\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LL\",\"surname\":\"Z\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"}', '{\"subtotal\":680,\"extra\":142.8,\"total\":822.8}', 'sent', 3, 'AN1621622570NM5ES', '{\"payment_method\":\"credit-card\",\"data\":{\"id\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"object\":\"payment_intent\",\"amount\":82280,\"amount_capturable\":0,\"amount_received\":82280,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[{\"id\":\"ch_1ItdJLJ9HHZbmVICU3dOLelL\",\"object\":\"charge\",\"amount\":82280,\"amount_captured\":82280,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1ItdJMJ9HHZbmVICGlmzUkVn\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"STRIPE* LEE LIM - ONLI\",\"captured\":true,\"created\":1621622583,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":17,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2024,\"fingerprint\":\"dKcgUyRAwF8OcjpQ\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1Ihgw6J9HHZbmVIC\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/rcpt_JWggTxt7xFa4oayUOQ4cO2YmJ2fvEtC\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/charges?payment_intent=pi_1ItdJKJ9HHZbmVIC5qHAekTC\"},\"client_secret\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC_secret_yPtvjnAIDFcFvJHCb0nxjrqP9\",\"confirmation_method\":\"automatic\",\"created\":1621622582,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}', '12345678', '2021-05-21 20:42:50'),
(3, 0, '[{\"item\":{\"id\":2,\"id_code\":\"FP11\",\"name\":\"Brown Shearling Leather Multi Purpose Bag 2\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"price\":340},\"color\":\"#f0f0f0\",\"size\":\"<?$value?>\",\"amount\":\"2\"}]', '', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"612361236\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LL\",\"surname\":\"Z\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"}', '{\"subtotal\":680,\"extra\":142.8,\"total\":822.8}', 'sent', 3, 'AN1621622570NM5ES', '{\"payment_method\":\"credit-card\",\"data\":{\"id\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"object\":\"payment_intent\",\"amount\":82280,\"amount_capturable\":0,\"amount_received\":82280,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[{\"id\":\"ch_1ItdJLJ9HHZbmVICU3dOLelL\",\"object\":\"charge\",\"amount\":82280,\"amount_captured\":82280,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1ItdJMJ9HHZbmVICGlmzUkVn\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"STRIPE* LEE LIM - ONLI\",\"captured\":true,\"created\":1621622583,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":17,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2024,\"fingerprint\":\"dKcgUyRAwF8OcjpQ\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1Ihgw6J9HHZbmVIC\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/rcpt_JWggTxt7xFa4oayUOQ4cO2YmJ2fvEtC\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/charges?payment_intent=pi_1ItdJKJ9HHZbmVIC5qHAekTC\"},\"client_secret\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC_secret_yPtvjnAIDFcFvJHCb0nxjrqP9\",\"confirmation_method\":\"automatic\",\"created\":1621622582,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}', '123456', '2021-05-21 20:42:50'),
(4, 0, '[{\"item\":{\"id\":2,\"id_code\":\"FP11\",\"name\":\"Brown Shearling Leather Multi Purpose Bag 2\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"price\":340},\"color\":\"#f0f0f0\",\"size\":\"<?$value?>\",\"amount\":\"2\"}]', '', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"612361236\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LL\",\"surname\":\"Z\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"}', '{\"subtotal\":680,\"extra\":142.8,\"total\":822.8}', 'sent', 3, 'AN1621622570NM5ES', '{\"payment_method\":\"credit-card\",\"data\":{\"id\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"object\":\"payment_intent\",\"amount\":82280,\"amount_capturable\":0,\"amount_received\":82280,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[{\"id\":\"ch_1ItdJLJ9HHZbmVICU3dOLelL\",\"object\":\"charge\",\"amount\":82280,\"amount_captured\":82280,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1ItdJMJ9HHZbmVICGlmzUkVn\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"STRIPE* LEE LIM - ONLI\",\"captured\":true,\"created\":1621622583,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":17,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2024,\"fingerprint\":\"dKcgUyRAwF8OcjpQ\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1Ihgw6J9HHZbmVIC\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/rcpt_JWggTxt7xFa4oayUOQ4cO2YmJ2fvEtC\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/charges?payment_intent=pi_1ItdJKJ9HHZbmVIC5qHAekTC\"},\"client_secret\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC_secret_yPtvjnAIDFcFvJHCb0nxjrqP9\",\"confirmation_method\":\"automatic\",\"created\":1621622582,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}', '1234567890', '2021-05-21 20:42:50'),
(5, 0, '[{\"item\":{\"id\":2,\"id_code\":\"FP11\",\"name\":\"Brown Shearling Leather Multi Purpose Bag 2\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"price\":340},\"color\":\"#f0f0f0\",\"size\":\"<?$value?>\",\"amount\":\"2\"}]', '', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"612361236\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LL\",\"surname\":\"Z\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"}', '{\"subtotal\":680,\"extra\":142.8,\"total\":822.8}', 'sent', 3, 'AN1621622570NM5ES', '{\"payment_method\":\"credit-card\",\"data\":{\"id\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"object\":\"payment_intent\",\"amount\":82280,\"amount_capturable\":0,\"amount_received\":82280,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[{\"id\":\"ch_1ItdJLJ9HHZbmVICU3dOLelL\",\"object\":\"charge\",\"amount\":82280,\"amount_captured\":82280,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1ItdJMJ9HHZbmVICGlmzUkVn\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"STRIPE* LEE LIM - ONLI\",\"captured\":true,\"created\":1621622583,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":17,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2024,\"fingerprint\":\"dKcgUyRAwF8OcjpQ\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1Ihgw6J9HHZbmVIC\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/rcpt_JWggTxt7xFa4oayUOQ4cO2YmJ2fvEtC\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/charges?payment_intent=pi_1ItdJKJ9HHZbmVIC5qHAekTC\"},\"client_secret\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC_secret_yPtvjnAIDFcFvJHCb0nxjrqP9\",\"confirmation_method\":\"automatic\",\"created\":1621622582,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}', '12345678', '2021-05-21 20:42:50'),
(6, 0, '[{\"item\":{\"id\":2,\"id_code\":\"FP11\",\"name\":\"Brown Shearling Leather Multi Purpose Bag 2\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"price\":340},\"color\":\"#f0f0f0\",\"size\":\"<?$value?>\",\"amount\":\"2\"}]', '', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"612361236\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LL\",\"surname\":\"Z\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"}', '{\"subtotal\":680,\"extra\":142.8,\"total\":822.8}', 'sent', 3, 'AN1621622570NM5ES', '{\"payment_method\":\"credit-card\",\"data\":{\"id\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"object\":\"payment_intent\",\"amount\":82280,\"amount_capturable\":0,\"amount_received\":82280,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[{\"id\":\"ch_1ItdJLJ9HHZbmVICU3dOLelL\",\"object\":\"charge\",\"amount\":82280,\"amount_captured\":82280,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1ItdJMJ9HHZbmVICGlmzUkVn\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"STRIPE* LEE LIM - ONLI\",\"captured\":true,\"created\":1621622583,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":17,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2024,\"fingerprint\":\"dKcgUyRAwF8OcjpQ\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1Ihgw6J9HHZbmVIC\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/rcpt_JWggTxt7xFa4oayUOQ4cO2YmJ2fvEtC\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/charges?payment_intent=pi_1ItdJKJ9HHZbmVIC5qHAekTC\"},\"client_secret\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC_secret_yPtvjnAIDFcFvJHCb0nxjrqP9\",\"confirmation_method\":\"automatic\",\"created\":1621622582,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}', '00000000000', '2021-05-21 20:42:50'),
(7, 0, '[{\"item\":{\"id\":2,\"id_code\":\"FP11\",\"name\":\"Brown Shearling Leather Multi Purpose Bag 2\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"price\":340},\"color\":\"#f0f0f0\",\"size\":\"<?$value?>\",\"amount\":\"2\"}]', '', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"612361236\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LL\",\"surname\":\"Z\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"}', '{\"subtotal\":680,\"extra\":142.8,\"total\":822.8}', 'sent', 3, 'AN1621622570NM5ES', '{\"payment_method\":\"credit-card\",\"data\":{\"id\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"object\":\"payment_intent\",\"amount\":82280,\"amount_capturable\":0,\"amount_received\":82280,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[{\"id\":\"ch_1ItdJLJ9HHZbmVICU3dOLelL\",\"object\":\"charge\",\"amount\":82280,\"amount_captured\":82280,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1ItdJMJ9HHZbmVICGlmzUkVn\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"STRIPE* LEE LIM - ONLI\",\"captured\":true,\"created\":1621622583,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":17,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2024,\"fingerprint\":\"dKcgUyRAwF8OcjpQ\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1Ihgw6J9HHZbmVIC\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/rcpt_JWggTxt7xFa4oayUOQ4cO2YmJ2fvEtC\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/charges?payment_intent=pi_1ItdJKJ9HHZbmVIC5qHAekTC\"},\"client_secret\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC_secret_yPtvjnAIDFcFvJHCb0nxjrqP9\",\"confirmation_method\":\"automatic\",\"created\":1621622582,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}', '0987654321', '2021-05-21 20:42:50'),
(8, 0, '[{\"item\":{\"id\":2,\"id_code\":\"FP11\",\"name\":\"Brown Shearling Leather Multi Purpose Bag 2\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"price\":340},\"color\":\"#f0f0f0\",\"size\":\"<?$value?>\",\"amount\":\"2\"}]', '', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"612361236\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LL\",\"surname\":\"Z\",\"street\":\"Calle la arro\",\"number\":\"21 bajo\",\"postal_code\":\"40030\",\"city\":\"VAVA\"}', '{\"subtotal\":680,\"extra\":142.8,\"total\":822.8}', 'sent', 3, 'AN1621622570NM5ES', '{\"payment_method\":\"credit-card\",\"data\":{\"id\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"object\":\"payment_intent\",\"amount\":82280,\"amount_capturable\":0,\"amount_received\":82280,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[{\"id\":\"ch_1ItdJLJ9HHZbmVICU3dOLelL\",\"object\":\"charge\",\"amount\":82280,\"amount_captured\":82280,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1ItdJMJ9HHZbmVICGlmzUkVn\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"STRIPE* LEE LIM - ONLI\",\"captured\":true,\"created\":1621622583,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":17,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC\",\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2024,\"fingerprint\":\"dKcgUyRAwF8OcjpQ\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1Ihgw6J9HHZbmVIC\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/rcpt_JWggTxt7xFa4oayUOQ4cO2YmJ2fvEtC\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1ItdJLJ9HHZbmVICU3dOLelL\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/charges?payment_intent=pi_1ItdJKJ9HHZbmVIC5qHAekTC\"},\"client_secret\":\"pi_1ItdJKJ9HHZbmVIC5qHAekTC_secret_yPtvjnAIDFcFvJHCb0nxjrqP9\",\"confirmation_method\":\"automatic\",\"created\":1621622582,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1ItdJLJ9HHZbmVICif6mwt5G\",\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}', '11111111111', '2021-05-21 20:42:50'),
(9, 0, '[{\"item\":{\"id\":2,\"id_code\":\"FP11\",\"name\":\"Brown Shearling Leather Multi Purpose Bag 2\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"price\":340},\"color\":\"#f0f0f0\",\"size\":\"<?$value?>\",\"amount\":\"2\"},{\"item\":{\"id\":3,\"id_code\":\"RPPXL\",\"name\":\"Recycled Polyester PXL String Bikini\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210522\\/RPPXL1621686139_cover.jpg\",\"price\":150},\"color\":\"#000000\",\"size\":\"<?$value?>\",\"amount\":1}]', 'Caja', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"640087088\",\"street\":\"Caaa\",\"number\":\"gghh\",\"postal_code\":\"44444\",\"city\":\"Vaaa\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LL\",\"surname\":\"Z\",\"street\":\"Caaa\",\"number\":\"gghh\",\"postal_code\":\"44444\",\"city\":\"Vaaa\"}', '{\"subtotal\":830,\"extra\":174.3,\"total\":1004.3}', 'sent', 3, 'AN1621686819CO2ES', '{\"payment_method\":\"paypal\",\"data\":{\"id\":\"6RD808912E6730635\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"EUR\",\"value\":\"1004.30\",\"breakdown\":{\"item_total\":{\"currency_code\":\"EUR\",\"value\":\"830.00\"},\"shipping\":{\"currency_code\":\"EUR\",\"value\":\"0.00\"},\"tax_total\":{\"currency_code\":\"EUR\",\"value\":\"174.30\"}}},\"payee\":{\"email_address\":\"sb-yurfh5916554@business.example.com\",\"merchant_id\":\"V9F5VA92CQAHC\",\"display_data\":{\"brand_name\":\"LEE LIM\"}},\"description\":\"Compra en LEE LIM - Tienda Online\",\"soft_descriptor\":\"Pago del Pedido\",\"shipping\":{\"name\":{\"full_name\":\"Lin lei Zheng\"},\"address\":{\"address_line_1\":\"Caaa\",\"address_line_2\":\"gghh\",\"admin_area_2\":\"Vaaa\",\"postal_code\":\"44444\",\"country_code\":\"ES\"}},\"payments\":{\"captures\":[{\"id\":\"5DJ91919KL122870K\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"EUR\",\"value\":\"1004.30\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"EUR\",\"value\":\"1004.30\"},\"paypal_fee\":{\"currency_code\":\"EUR\",\"value\":\"34.50\"},\"net_amount\":{\"currency_code\":\"EUR\",\"value\":\"969.80\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/5DJ91919KL122870K\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/5DJ91919KL122870K\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/6RD808912E6730635\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2021-05-22T12:33:53Z\",\"update_time\":\"2021-05-22T12:33:53Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"Lin lei\",\"surname\":\"Zheng\"},\"email_address\":\"zll@zll.com\",\"payer_id\":\"MKAUTJ3TTTVS6\",\"address\":{\"country_code\":\"ES\"}},\"create_time\":\"2021-05-22T12:30:52Z\",\"update_time\":\"2021-05-22T12:33:53Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/6RD808912E6730635\",\"rel\":\"self\",\"method\":\"GET\"}]}}', 'klklklkljfdssdfghghjk', '2021-05-22 14:33:39'),
(10, 1, '[{\"item\":{\"id\":3,\"id_code\":\"RPPXL\",\"name\":\"Recycled Polyester PXL String Bikini\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210522\\/RPPXL1621686139_cover.jpg\",\"price\":150},\"color\":\"#000000\",\"size\":\"<?$value?>\",\"amount\":\"4\"}]', 'qq', '{\"address\":{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"666666666\",\"street\":\"yyyyyyy\",\"number\":\"yyyyyyy\",\"city\":\"qqqqqq\",\"postal_code\":\"44444\"},\"email\":\"zheng9112003@gmail.com\"}', '{\"name\":\"LLLLL\",\"surname\":\"LLLL\",\"street\":\"W\",\"number\":\"W\",\"postal_code\":\"33333\",\"city\":\"q\"}', '{\"subtotal\":600,\"extra\":126,\"total\":726}', 'sent', 3, 'LL1621687165AQ7ES', '{\"payment_method\":\"credit-card\",\"data\":{\"id\":\"pi_1Itu7DJ9HHZbmVICeI0YnJ9s\",\"object\":\"payment_intent\",\"amount\":72600,\"amount_capturable\":0,\"amount_received\":72600,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[{\"id\":\"ch_1Itu7EJ9HHZbmVIC3ET2Xu7R\",\"object\":\"charge\",\"amount\":72600,\"amount_captured\":72600,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1Itu7EJ9HHZbmVIC1ntDHw7H\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"STRIPE* LEE LIM - ONLI\",\"captured\":true,\"created\":1621687180,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":22,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1Itu7DJ9HHZbmVICeI0YnJ9s\",\"payment_method\":\"pm_1Itu7DJ9HHZbmVIC3f3KO6mM\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":4,\"exp_year\":2024,\"fingerprint\":\"dKcgUyRAwF8OcjpQ\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"4242\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1Ihgw6J9HHZbmVIC\\/ch_1Itu7EJ9HHZbmVIC3ET2Xu7R\\/rcpt_JWy3XZSqlZcn5yU01N9StqI7ANcvBWS\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1Itu7EJ9HHZbmVIC3ET2Xu7R\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}],\"has_more\":false,\"total_count\":1,\"url\":\"\\/v1\\/charges?payment_intent=pi_1Itu7DJ9HHZbmVICeI0YnJ9s\"},\"client_secret\":\"pi_1Itu7DJ9HHZbmVICeI0YnJ9s_secret_CxJL74bz8UPzR5H7reErvfjKz\",\"confirmation_method\":\"automatic\",\"created\":1621687179,\"currency\":\"eur\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":\"pm_1Itu7DJ9HHZbmVIC3f3KO6mM\",\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":\"LEE LIM - Online\",\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}', 'ESAMN2134422222CH', '2021-05-22 14:39:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_recovery`
--

CREATE TABLE `password_recovery` (
  `id` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `email_account` text NOT NULL,
  `verify_code` int(11) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_list`
--

CREATE TABLE `product_list` (
  `id` int(11) NOT NULL,
  `product_code` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `material` text NOT NULL,
  `season` text NOT NULL,
  `category` text NOT NULL,
  `gender` text NOT NULL,
  `price` double NOT NULL,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`image`)),
  `option` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`option`)),
  `order_times` int(11) NOT NULL DEFAULT 0,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product_list`
--

INSERT INTO `product_list` (`id`, `product_code`, `name`, `description`, `material`, `season`, `category`, `gender`, `price`, `image`, `option`, `order_times`, `date_create`) VALUES
(1, 'NOP11', 'Brown Shearling Leather Multi Purpose Bag', '\"Not a Gun Bag\". Shearling with brown leather details. Adjustable shoulder strap with pin-buckle fastening. Magnetic press-stud tab fastening at flap. Bag and belt friendly top ring buckle. Snapped on belt loop at back. Logo at interior and back of the bag. ', '3% Spandex, 37% Polyester, 60% Silk', '2020AW', 'bag', 'unisex', 390, '{\"color_img\":\"\\/static\\/img\\/database\\/product\\/20210521\\/NOP111621602002_color.jpg\",\"size_img\":\"\\/static\\/img\\/database\\/product\\/20210521\\/NOP111621602002_size.jpg\",\"cover_img\":\"\\/static\\/img\\/database\\/product\\/20210521\\/NOP111621602002_cover.jpg\",\"hover_img\":\"\\/static\\/img\\/database\\/product\\/20210521\\/NOP111621602002_hover.jpg\",\"extra_img\":[\"\\/static\\/img\\/database\\/product\\/20210521\\/NOP111621602002_extra_0.jpg\",\"\\/static\\/img\\/database\\/product\\/20210521\\/NOP111621602002_extra_1.jpg\",\"\\/static\\/img\\/database\\/product\\/20210521\\/NOP111621602002_extra_2.jpg\"]}', '{\"color\":[\"#f9f9f9\"],\"size\":[\"M\"]}', 0, '2021-05-21 15:00:02'),
(2, 'FP11', 'Brown Shearling Leather Multi Purpose Bag 2', '\"Not a Gun Bag\". Shearling with brown leather details. Adjustable shoulder strap with pin-buckle fastening. Magnetic press-stud tab fastening at flap. Bag and belt friendly top ring buckle. Snapped on belt loop at back. Logo at interior and back of the bag. ', '3% Spandex, 37% Polyester, 60% Silk', '2020AW', 'bag', 'unisex', 340, '{\"color_img\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_color.jpg\",\"size_img\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_size.jpg\",\"cover_img\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_cover.jpg\",\"hover_img\":\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_hover.jpg\",\"extra_img\":[\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_extra_0.jpg\",\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_extra_1.jpg\",\"\\/static\\/img\\/database\\/product\\/20210521\\/FP111621614376_extra_2.jpg\"]}', '{\"color\":[\"#f0f0f0\"],\"size\":[\"Talla unica\"]}', 0, '2021-05-21 18:26:16'),
(3, 'RPPXL', 'Recycled Polyester PXL String Bikini', 'Stretch nylon bikini top featuring printed PRIVATE POLICY PXL pattern in black and white.  Self-tie fastening with silver hardware at back. Fully lined. 80% Recycled Polyester is being used in this garment.', ' 3% Spandex, 37% Polyester, 60% Silk', '2020AW', 'clothing', 'woman', 150, '{\"color_img\":\"\\/static\\/img\\/database\\/product\\/20210522\\/RPPXL1621686139_color.jpg\",\"size_img\":\"\\/static\\/img\\/database\\/product\\/20210522\\/RPPXL1621686139_size.jpg\",\"cover_img\":\"\\/static\\/img\\/database\\/product\\/20210522\\/RPPXL1621686139_cover.jpg\",\"hover_img\":\"\\/static\\/img\\/database\\/product\\/20210522\\/RPPXL1621686139_hover.jpg\",\"extra_img\":[\"\\/static\\/img\\/database\\/product\\/20210522\\/RPPXL1621686139_extra_0.jpg\",\"\\/static\\/img\\/database\\/product\\/20210522\\/RPPXL1621686139_extra_1.jpg\"]}', '{\"color\":[\"#000000\"],\"size\":[\"S\",\"M\",\"L\"]}', 5, '2021-05-22 14:22:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `search_engine`
--

CREATE TABLE `search_engine` (
  `id` int(11) NOT NULL,
  `keyword` text NOT NULL,
  `search_times` int(11) NOT NULL DEFAULT 1,
  `date_update` datetime NOT NULL DEFAULT current_timestamp(),
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `birthday` date NOT NULL,
  `receive_information` tinyint(1) NOT NULL DEFAULT 1,
  `verify_account` int(11) NOT NULL DEFAULT 0,
  `cart` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]',
  `address_location` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]',
  `wallet` double NOT NULL DEFAULT 0,
  `wallet_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]',
  `user_location` text DEFAULT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_account`
--

INSERT INTO `user_account` (`id`, `name`, `surname`, `email`, `password`, `birthday`, `receive_information`, `verify_account`, `cart`, `address_location`, `wallet`, `wallet_history`, `user_location`, `date_create`) VALUES
(1, 'LL', 'Z', 'email@gmail.com', '1', '2003-11-09', 1, 0, '[{\"item\":{\"id\":3,\"id_code\":\"RPPXL\",\"name\":\"Recycled Polyester PXL String Bikini\",\"image\":\"\\/static\\/img\\/database\\/product\\/20210522\\/RPPXL1621686139_cover.jpg\",\"price\":150},\"color\":\"#000000\",\"size\":\"<?$value?>\",\"amount\":\"4\"}]', '[{\"name\":\"LL\",\"surname\":\"Z\",\"tel\":\"666666666\",\"street\":\"yyyyyyy\",\"number\":\"yyyyyyy\",\"city\":\"qqqqqq\",\"postal_code\":\"44444\"}]', 0, '[]', '127.0.0.1', '2021-05-22 14:35:36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contact_message`
--
ALTER TABLE `contact_message`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gallery_album_list`
--
ALTER TABLE `gallery_album_list`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gallery_season`
--
ALTER TABLE `gallery_season`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `local_shop`
--
ALTER TABLE `local_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_recovery`
--
ALTER TABLE `password_recovery`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `search_engine`
--
ALTER TABLE `search_engine`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contact_message`
--
ALTER TABLE `contact_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gallery_album_list`
--
ALTER TABLE `gallery_album_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gallery_season`
--
ALTER TABLE `gallery_season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `local_shop`
--
ALTER TABLE `local_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `password_recovery`
--
ALTER TABLE `password_recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `search_engine`
--
ALTER TABLE `search_engine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
