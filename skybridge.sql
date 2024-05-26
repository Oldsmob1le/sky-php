-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 26 2024 г., 23:09
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `skybridge`
--

-- --------------------------------------------------------

--
-- Структура таблицы `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `flight_duration` time NOT NULL,
  `departure_airport_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arrival_airport_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_price` int(11) DEFAULT NULL,
  `baggage` int(11) DEFAULT NULL,
  `aircraft_model` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `flights`
--

INSERT INTO `flights` (`id`, `flight_number`, `origin`, `destination`, `departure_time`, `arrival_time`, `flight_duration`, `departure_airport_code`, `arrival_airport_code`, `base_price`, `baggage`, `aircraft_model`) VALUES
(1, 'FL123', 'Москва', 'Казань', '10:00:00', '00:00:00', '02:00:00', 'SVO', 'KZN', 5700, 2500, '737-800NG'),
(2, 'FL456', 'Казань', 'Адлер', '14:00:00', '00:00:00', '04:00:00', 'KZN', 'AER', 4600, 2500, '737-800NG'),
(9, '231', 'вымымв', 'сыфысфсфы', '21:12:00', '12:12:00', '12:21:00', '1212', '2121', 1221, 1221, '2121');

-- --------------------------------------------------------

--
-- Структура таблицы `seat_map`
--

CREATE TABLE `seat_map` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `seat_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seat_category` enum('Business','Economy','Lowcost') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `seat_map`
--

INSERT INTO `seat_map` (`id`, `flight_id`, `seat_number`, `seat_category`, `is_available`, `price`) VALUES
(158, 1, '1A', 'Business', 1, '10000.00'),
(159, 1, '1B', 'Business', 0, '10000.00'),
(160, 1, '1C', 'Business', 1, '10000.00'),
(161, 1, '2A', 'Business', 1, '10000.00'),
(162, 1, '2B', 'Business', 1, '10000.00'),
(163, 1, '2C', 'Business', 1, '10000.00'),
(164, 1, '3A', 'Business', 1, '10000.00'),
(165, 1, '3B', 'Business', 0, '10000.00'),
(166, 1, '3C', 'Business', 1, '10000.00'),
(167, 1, '4A', 'Business', 1, '10000.00'),
(168, 1, '4B', 'Business', 1, '10000.00'),
(169, 1, '4C', 'Business', 1, '10000.00'),
(170, 1, '5A', 'Business', 1, '10000.00'),
(171, 1, '5B', 'Business', 1, '10000.00'),
(172, 1, '5C', 'Business', 1, '10000.00'),
(173, 1, '6A', 'Business', 1, '10000.00'),
(174, 1, '6B', 'Business', 0, '10000.00'),
(175, 1, '6C', 'Business', 1, '10000.00'),
(176, 1, '7A', 'Business', 1, '10000.00'),
(177, 1, '7B', 'Business', 1, '10000.00'),
(178, 1, '7C', 'Business', 1, '10000.00'),
(179, 1, '8A', 'Business', 1, '10000.00'),
(180, 1, '8B', 'Business', 0, '10000.00'),
(181, 1, '8C', 'Business', 1, '10000.00'),
(182, 1, '9A', 'Economy', 1, '5000.00'),
(183, 1, '9B', 'Economy', 1, '5000.00'),
(184, 1, '9C', 'Economy', 1, '5000.00'),
(185, 1, '10A', 'Economy', 1, '5000.00'),
(186, 1, '10B', 'Economy', 1, '5000.00'),
(187, 1, '10C', 'Economy', 1, '5000.00'),
(188, 1, '11A', 'Economy', 1, '5000.00'),
(189, 1, '11B', 'Economy', 1, '5000.00'),
(190, 1, '11C', 'Economy', 1, '5000.00'),
(191, 1, '12A', 'Economy', 1, '5000.00'),
(192, 1, '12B', 'Economy', 0, '5000.00'),
(193, 1, '12C', 'Economy', 1, '5000.00'),
(194, 1, '13A', 'Economy', 1, '5000.00'),
(195, 1, '13B', 'Economy', 1, '5000.00'),
(196, 1, '13C', 'Economy', 1, '5000.00'),
(197, 1, '14A', 'Economy', 1, '5000.00'),
(198, 1, '14B', 'Economy', 1, '5000.00'),
(199, 1, '14C', 'Economy', 1, '5000.00'),
(200, 1, '15A', 'Economy', 1, '5000.00'),
(201, 1, '15B', 'Economy', 1, '5000.00'),
(202, 1, '15C', 'Economy', 1, '5000.00'),
(203, 1, '16A', 'Economy', 1, '5000.00'),
(204, 1, '16B', 'Economy', 1, '5000.00'),
(205, 1, '16C', 'Economy', 1, '5000.00'),
(206, 1, '17A', 'Economy', 1, '5000.00'),
(207, 1, '17B', 'Economy', 1, '5000.00'),
(208, 1, '17C', 'Economy', 1, '5000.00'),
(209, 1, '18A', 'Economy', 1, '5000.00'),
(210, 1, '18B', 'Economy', 1, '5000.00'),
(211, 1, '18C', 'Economy', 1, '5000.00'),
(212, 1, '19A', 'Economy', 1, '5000.00'),
(213, 1, '19B', 'Economy', 1, '5000.00'),
(214, 1, '19C', 'Economy', 1, '5000.00'),
(215, 1, '20A', 'Lowcost', 1, '3000.00'),
(216, 1, '20B', 'Lowcost', 1, '3000.00'),
(217, 1, '20C', 'Lowcost', 1, '3000.00'),
(218, 1, '21A', 'Lowcost', 1, '3000.00'),
(219, 1, '21B', 'Lowcost', 1, '3000.00'),
(220, 1, '21C', 'Lowcost', 1, '3000.00'),
(221, 1, '22A', 'Lowcost', 1, '3000.00'),
(222, 1, '22B', 'Lowcost', 1, '3000.00'),
(223, 1, '22C', 'Lowcost', 1, '3000.00'),
(224, 1, '23A', 'Lowcost', 1, '3000.00'),
(225, 1, '23B', 'Lowcost', 1, '3000.00'),
(226, 1, '23C', 'Lowcost', 1, '3000.00'),
(227, 2, '1A', 'Business', 1, '12000.00'),
(228, 2, '1B', 'Business', 1, '12000.00'),
(229, 2, '1C', 'Business', 1, '12000.00'),
(230, 2, '2A', 'Business', 1, '12000.00'),
(231, 2, '2B', 'Business', 1, '12000.00'),
(232, 2, '2C', 'Business', 1, '12000.00'),
(233, 2, '3A', 'Business', 1, '12000.00'),
(234, 2, '3B', 'Business', 1, '12000.00'),
(235, 2, '3C', 'Business', 1, '12000.00'),
(236, 2, '4A', 'Business', 1, '12000.00'),
(237, 2, '4B', 'Business', 1, '12000.00'),
(238, 2, '4C', 'Business', 1, '12000.00'),
(239, 2, '5A', 'Business', 1, '12000.00'),
(240, 2, '5B', 'Business', 1, '12000.00'),
(241, 2, '5C', 'Business', 1, '12000.00'),
(242, 2, '6A', 'Business', 1, '12000.00'),
(243, 2, '6B', 'Business', 1, '12000.00'),
(244, 2, '6C', 'Business', 1, '12000.00'),
(245, 2, '7A', 'Business', 1, '12000.00'),
(246, 2, '7B', 'Business', 1, '12000.00'),
(247, 2, '7C', 'Business', 1, '12000.00'),
(248, 2, '8A', 'Business', 1, '12000.00'),
(249, 2, '8B', 'Business', 1, '12000.00'),
(250, 2, '8C', 'Business', 1, '12000.00'),
(251, 2, '9A', 'Economy', 1, '6000.00'),
(252, 2, '9B', 'Economy', 1, '6000.00'),
(253, 2, '9C', 'Economy', 1, '6000.00'),
(254, 2, '10A', 'Economy', 1, '6000.00'),
(255, 2, '10B', 'Economy', 1, '6000.00'),
(256, 2, '10C', 'Economy', 1, '6000.00'),
(257, 2, '11A', 'Economy', 1, '6000.00'),
(258, 2, '11B', 'Economy', 1, '6000.00'),
(259, 2, '11C', 'Economy', 1, '6000.00'),
(260, 2, '12A', 'Economy', 1, '6000.00'),
(261, 2, '12B', 'Economy', 1, '6000.00'),
(262, 2, '12C', 'Economy', 1, '6000.00'),
(263, 2, '13A', 'Economy', 1, '6000.00'),
(264, 2, '13B', 'Economy', 1, '6000.00'),
(265, 2, '13C', 'Economy', 1, '6000.00'),
(266, 2, '14A', 'Economy', 1, '6000.00'),
(267, 2, '14B', 'Economy', 1, '6000.00'),
(268, 2, '14C', 'Economy', 1, '6000.00'),
(269, 2, '15A', 'Economy', 1, '6000.00'),
(270, 2, '15B', 'Economy', 1, '6000.00'),
(271, 2, '15C', 'Economy', 1, '6000.00'),
(272, 2, '16A', 'Economy', 1, '6000.00'),
(273, 2, '16B', 'Economy', 1, '6000.00'),
(274, 2, '16C', 'Economy', 1, '6000.00'),
(275, 2, '17A', 'Economy', 1, '6000.00'),
(276, 2, '17B', 'Economy', 1, '6000.00'),
(277, 2, '17C', 'Economy', 1, '6000.00'),
(278, 2, '18A', 'Economy', 1, '6000.00'),
(279, 2, '18B', 'Economy', 1, '6000.00'),
(280, 2, '18C', 'Economy', 1, '6000.00'),
(281, 2, '19A', 'Economy', 1, '6000.00'),
(282, 2, '19B', 'Economy', 1, '6000.00'),
(283, 2, '19C', 'Economy', 1, '6000.00'),
(284, 2, '20A', 'Lowcost', 1, '4000.00'),
(285, 2, '20B', 'Lowcost', 1, '4000.00'),
(286, 2, '20C', 'Lowcost', 1, '4000.00'),
(287, 2, '21A', 'Lowcost', 1, '4000.00'),
(288, 2, '21B', 'Lowcost', 1, '4000.00'),
(289, 2, '21C', 'Lowcost', 1, '4000.00'),
(290, 2, '22A', 'Lowcost', 1, '4000.00'),
(291, 2, '22B', 'Lowcost', 1, '4000.00'),
(292, 2, '22C', 'Lowcost', 1, '4000.00'),
(293, 2, '23A', 'Lowcost', 1, '4000.00'),
(294, 2, '23B', 'Lowcost', 1, '4000.00'),
(295, 2, '23C', 'Lowcost', 1, '4000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`) VALUES
(1, 'Чартерные рейсы', 'Возможность заказа чартерного рейса для больших групп, корпоративных мероприятий или специальных событий.', '50000.00'),
(2, 'Персональный трансфер', 'Мы предлагаем нашим пассажирам услугу персонального трансфера на роскошном автомобиле с личным водителем.', '18000.00'),
(3, 'Услуга экспресс-регистрации', 'Позволяет пассажирам пройти регистрацию на рейс без необходимости стоять в длинной очереди.', '4000.00'),
(4, 'Доставка багажа', 'Предлагаем Вам воспользоваться услугой доставки багажа и горнолыжного снаряжения из аэропорта вылета в указанной вами при посадке в самолет анкете.', '3000.00'),
(5, 'Питание по желанию', 'Предлагаем Вам услугу питания по желанию. Пассажиры могут выбирать из различных блюд или даже заказывать специальные диетические или вегетарианские варианты.', '1990.00');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `seat_numbers` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT current_timestamp(),
  `flight_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `flight_id`, `seat_numbers`, `purchase_date`, `flight_date`) VALUES
(1, 1, 2, '99F', '2024-05-26', '2024-05-10');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_services`
--

CREATE TABLE `ticket_services` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` enum('Мужчина','Женщина') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `birthday`, `gender`, `password`, `role`) VALUES
(1, 'Абдулин Никита Русланович', 'admin@mail.ru', '2005-01-31', 'Мужчина', '$2y$10$F/eviyzOHL9D3ltCZBVYy.N/kjS54F9Dge45EnHrc987WCXMnkl8K', 2),
(2, 'Василий Иосифович Сталин', 'ussr1945@mail.ru', '2024-05-12', 'Мужчина', '$2y$10$qbb4FHB/faDL3uhAw8ceo.V4jnXcSqSSvmm8qncSHDRrGvjBOr0fe', 1),
(1231478, 'Олегов Олег Олегович', 'olegov@mail.ru', '2024-05-12', 'Мужчина', '$2y$10$GV90GwY.8n2cule07O5tmuw7v85Vpb/4c/vkKR1vsoaYZyXOMlJGC', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `seat_map`
--
ALTER TABLE `seat_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ticket_services`
--
ALTER TABLE `ticket_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `seat_map`
--
ALTER TABLE `seat_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1231479;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `seat_map`
--
ALTER TABLE `seat_map`
  ADD CONSTRAINT `seat_map_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
