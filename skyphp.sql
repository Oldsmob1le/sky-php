-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 29 2024 г., 00:59
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
-- База данных: `skyphp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_number` varchar(50) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `flight_duration` time NOT NULL,
  `departure_airport_code` varchar(10) NOT NULL,
  `arrival_airport_code` varchar(10) NOT NULL,
  `base_price` int(11) DEFAULT NULL,
  `baggage` int(11) DEFAULT NULL,
  `aircraft_model` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `flights`
--

INSERT INTO `flights` (`id`, `flight_number`, `origin`, `destination`, `departure_time`, `arrival_time`, `flight_duration`, `departure_airport_code`, `arrival_airport_code`, `base_price`, `baggage`, `aircraft_model`) VALUES
(1, 'FL123', 'Москва', 'Казань', '10:00:00', '00:00:00', '02:00:00', 'SVO', 'KZN', 3000, 2500, '737-800NG'),
(2, 'FL456', 'Казань', 'Сочи', '14:00:00', '00:00:00', '04:00:00', 'KZN', 'AER', 4000, 2500, '737-800NG'),
(3, 'FL789', 'Новосибирск', 'Сочи', '14:00:00', '18:00:00', '04:00:00', 'OVB', 'AER', 6000, 2000, '777-300ER'),
(4, 'FL799', 'Москва', 'Сочи', '11:00:00', '15:30:00', '04:30:00', 'MSK', 'AER', 3700, 2500, '737-MAX 8'),
(5, 'FL812', 'Казань', 'Москва', '14:30:00', '18:00:00', '02:30:00', 'KZN', 'MSK', 4100, 2500, '737-MAX 8'),
(6, 'FL824', 'Самара', 'Казань', '15:20:00', '17:35:00', '02:15:00', 'KUF', 'MSK', 3850, 2500, '777-300F');

-- --------------------------------------------------------

--
-- Структура таблицы `seat_map`
--

CREATE TABLE `seat_map` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `seat_category` enum('Business','Economy','Lowcost') NOT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(167, 1, '4A', 'Business', 0, '10000.00'),
(168, 1, '4B', 'Business', 1, '10000.00'),
(169, 1, '4C', 'Business', 1, '10000.00'),
(170, 1, '5A', 'Business', 1, '10000.00'),
(171, 1, '5B', 'Business', 0, '10000.00'),
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
(184, 1, '9C', 'Economy', 0, '5000.00'),
(185, 1, '10A', 'Economy', 1, '5000.00'),
(186, 1, '10B', 'Economy', 1, '5000.00'),
(187, 1, '10C', 'Economy', 1, '5000.00'),
(188, 1, '11A', 'Economy', 1, '5000.00'),
(189, 1, '11B', 'Economy', 0, '5000.00'),
(190, 1, '11C', 'Economy', 1, '5000.00'),
(191, 1, '12A', 'Economy', 1, '5000.00'),
(192, 1, '12B', 'Economy', 0, '5000.00'),
(193, 1, '12C', 'Economy', 1, '5000.00'),
(194, 1, '13A', 'Economy', 1, '5000.00'),
(195, 1, '13B', 'Economy', 0, '5000.00'),
(196, 1, '13C', 'Economy', 1, '5000.00'),
(197, 1, '14A', 'Economy', 1, '5000.00'),
(198, 1, '14B', 'Economy', 1, '5000.00'),
(199, 1, '14C', 'Economy', 1, '5000.00'),
(200, 1, '15A', 'Economy', 1, '5000.00'),
(201, 1, '15B', 'Economy', 0, '5000.00'),
(202, 1, '15C', 'Economy', 1, '5000.00'),
(203, 1, '16A', 'Economy', 1, '5000.00'),
(204, 1, '16B', 'Economy', 1, '5000.00'),
(205, 1, '16C', 'Economy', 1, '5000.00'),
(206, 1, '17A', 'Economy', 0, '5000.00'),
(207, 1, '17B', 'Economy', 1, '5000.00'),
(208, 1, '17C', 'Economy', 1, '5000.00'),
(209, 1, '18A', 'Economy', 1, '5000.00'),
(210, 1, '18B', 'Economy', 1, '5000.00'),
(211, 1, '18C', 'Economy', 1, '5000.00'),
(212, 1, '19A', 'Economy', 0, '5000.00'),
(213, 1, '19B', 'Economy', 1, '5000.00'),
(214, 1, '19C', 'Economy', 1, '5000.00'),
(215, 1, '20A', 'Lowcost', 1, '3000.00'),
(216, 1, '20B', 'Lowcost', 0, '3000.00'),
(217, 1, '20C', 'Lowcost', 0, '3000.00'),
(218, 1, '21A', 'Lowcost', 1, '3000.00'),
(219, 1, '21B', 'Lowcost', 1, '3000.00'),
(220, 1, '21C', 'Lowcost', 1, '3000.00'),
(221, 1, '22A', 'Lowcost', 1, '3000.00'),
(222, 1, '22B', 'Lowcost', 0, '3000.00'),
(223, 1, '22C', 'Lowcost', 1, '3000.00'),
(224, 1, '23A', 'Lowcost', 1, '3000.00'),
(225, 1, '23B', 'Lowcost', 1, '3000.00'),
(226, 1, '23C', 'Lowcost', 1, '3000.00'),
(227, 2, '1A', 'Business', 1, '12000.00'),
(228, 2, '1B', 'Business', 0, '12000.00'),
(229, 2, '1C', 'Business', 1, '12000.00'),
(230, 2, '2A', 'Business', 1, '12000.00'),
(231, 2, '2B', 'Business', 1, '12000.00'),
(232, 2, '2C', 'Business', 1, '12000.00'),
(233, 2, '3A', 'Business', 0, '12000.00'),
(234, 2, '3B', 'Business', 1, '12000.00'),
(235, 2, '3C', 'Business', 1, '12000.00'),
(236, 2, '4A', 'Business', 0, '12000.00'),
(237, 2, '4B', 'Business', 1, '12000.00'),
(238, 2, '4C', 'Business', 1, '12000.00'),
(239, 2, '5A', 'Business', 1, '12000.00'),
(240, 2, '5B', 'Business', 1, '12000.00'),
(241, 2, '5C', 'Business', 1, '12000.00'),
(242, 2, '6A', 'Business', 1, '12000.00'),
(243, 2, '6B', 'Business', 1, '12000.00'),
(244, 2, '6C', 'Business', 0, '12000.00'),
(245, 2, '7A', 'Business', 1, '12000.00'),
(246, 2, '7B', 'Business', 1, '12000.00'),
(247, 2, '7C', 'Business', 1, '12000.00'),
(248, 2, '8A', 'Business', 1, '12000.00'),
(249, 2, '8B', 'Business', 1, '12000.00'),
(250, 2, '8C', 'Business', 0, '12000.00'),
(251, 2, '9A', 'Economy', 1, '6000.00'),
(252, 2, '9B', 'Economy', 1, '6000.00'),
(253, 2, '9C', 'Economy', 1, '6000.00'),
(254, 2, '10A', 'Economy', 1, '6000.00'),
(255, 2, '10B', 'Economy', 0, '6000.00'),
(256, 2, '10C', 'Economy', 1, '6000.00'),
(257, 2, '11A', 'Economy', 1, '6000.00'),
(258, 2, '11B', 'Economy', 1, '6000.00'),
(259, 2, '11C', 'Economy', 1, '6000.00'),
(260, 2, '12A', 'Economy', 1, '6000.00'),
(261, 2, '12B', 'Economy', 1, '6000.00'),
(262, 2, '12C', 'Economy', 0, '6000.00'),
(263, 2, '13A', 'Economy', 1, '6000.00'),
(264, 2, '13B', 'Economy', 0, '6000.00'),
(265, 2, '13C', 'Economy', 1, '6000.00'),
(266, 2, '14A', 'Economy', 1, '6000.00'),
(267, 2, '14B', 'Economy', 1, '6000.00'),
(268, 2, '14C', 'Economy', 1, '6000.00'),
(269, 2, '15A', 'Economy', 1, '6000.00'),
(270, 2, '15B', 'Economy', 0, '6000.00'),
(271, 2, '15C', 'Economy', 0, '6000.00'),
(272, 2, '16A', 'Economy', 1, '6000.00'),
(273, 2, '16B', 'Economy', 1, '6000.00'),
(274, 2, '16C', 'Economy', 1, '6000.00'),
(275, 2, '17A', 'Economy', 1, '6000.00'),
(276, 2, '17B', 'Economy', 0, '6000.00'),
(277, 2, '17C', 'Economy', 1, '6000.00'),
(278, 2, '18A', 'Economy', 1, '6000.00'),
(279, 2, '18B', 'Economy', 1, '6000.00'),
(280, 2, '18C', 'Economy', 0, '6000.00'),
(281, 2, '19A', 'Economy', 1, '6000.00'),
(282, 2, '19B', 'Economy', 1, '6000.00'),
(283, 2, '19C', 'Economy', 1, '6000.00'),
(284, 2, '20A', 'Lowcost', 1, '4000.00'),
(285, 2, '20B', 'Lowcost', 1, '4000.00'),
(286, 2, '20C', 'Lowcost', 1, '4000.00'),
(287, 2, '21A', 'Lowcost', 1, '4000.00'),
(288, 2, '21B', 'Lowcost', 0, '4000.00'),
(289, 2, '21C', 'Lowcost', 0, '4000.00'),
(290, 2, '22A', 'Lowcost', 0, '4000.00'),
(291, 2, '22B', 'Lowcost', 1, '4000.00'),
(292, 2, '22C', 'Lowcost', 1, '4000.00'),
(293, 2, '23A', 'Lowcost', 0, '4000.00'),
(294, 2, '23B', 'Lowcost', 1, '4000.00'),
(295, 2, '23C', 'Lowcost', 1, '4000.00'),
(296, 3, '1A', 'Business', 1, '10000.00'),
(297, 3, '1B', 'Business', 1, '10000.00'),
(298, 3, '1C', 'Business', 1, '10000.00'),
(299, 3, '2A', 'Business', 0, '10000.00'),
(300, 3, '2B', 'Business', 1, '10000.00'),
(301, 3, '2C', 'Business', 1, '10000.00'),
(302, 3, '3A', 'Business', 1, '10000.00'),
(303, 3, '3B', 'Business', 1, '10000.00'),
(304, 3, '3C', 'Business', 0, '10000.00'),
(305, 3, '4A', 'Business', 1, '10000.00'),
(306, 3, '4B', 'Business', 0, '10000.00'),
(307, 3, '4C', 'Business', 0, '10000.00'),
(308, 3, '5A', 'Business', 1, '10000.00'),
(309, 3, '5B', 'Business', 0, '10000.00'),
(310, 3, '5C', 'Business', 1, '10000.00'),
(311, 3, '6A', 'Business', 0, '10000.00'),
(312, 3, '6B', 'Business', 1, '10000.00'),
(313, 3, '6C', 'Business', 0, '10000.00'),
(314, 3, '7A', 'Business', 1, '10000.00'),
(315, 3, '7B', 'Business', 0, '10000.00'),
(316, 3, '7C', 'Business', 0, '10000.00'),
(317, 3, '8A', 'Business', 0, '10000.00'),
(318, 3, '8B', 'Business', 0, '10000.00'),
(319, 3, '8C', 'Business', 1, '10000.00'),
(320, 3, '9A', 'Economy', 0, '5000.00'),
(321, 3, '9B', 'Economy', 0, '5000.00'),
(322, 3, '9C', 'Economy', 0, '5000.00'),
(323, 3, '10A', 'Economy', 0, '5000.00'),
(324, 3, '10B', 'Economy', 1, '5000.00'),
(325, 3, '10C', 'Economy', 1, '5000.00'),
(326, 3, '11A', 'Economy', 0, '5000.00'),
(327, 3, '11B', 'Economy', 1, '5000.00'),
(328, 3, '11C', 'Economy', 0, '5000.00'),
(329, 3, '12A', 'Economy', 1, '5000.00'),
(330, 3, '12B', 'Economy', 1, '5000.00'),
(331, 3, '12C', 'Economy', 0, '5000.00'),
(332, 3, '13A', 'Economy', 1, '5000.00'),
(333, 3, '13B', 'Economy', 1, '5000.00'),
(334, 3, '13C', 'Economy', 1, '5000.00'),
(335, 3, '14A', 'Economy', 1, '5000.00'),
(336, 3, '14B', 'Economy', 1, '5000.00'),
(337, 3, '14C', 'Economy', 1, '5000.00'),
(338, 3, '15A', 'Economy', 0, '5000.00'),
(339, 3, '15B', 'Economy', 1, '5000.00'),
(340, 3, '15C', 'Economy', 1, '5000.00'),
(341, 3, '16A', 'Economy', 0, '5000.00'),
(342, 3, '16B', 'Economy', 0, '5000.00'),
(343, 3, '16C', 'Economy', 1, '5000.00'),
(344, 3, '17A', 'Economy', 1, '5000.00'),
(345, 3, '17B', 'Economy', 0, '5000.00'),
(346, 3, '17C', 'Economy', 1, '5000.00'),
(347, 3, '18A', 'Economy', 1, '5000.00'),
(348, 3, '18B', 'Economy', 0, '5000.00'),
(349, 3, '18C', 'Economy', 0, '5000.00'),
(350, 3, '19A', 'Economy', 1, '5000.00'),
(351, 3, '19B', 'Economy', 1, '5000.00'),
(352, 3, '19C', 'Economy', 0, '5000.00'),
(353, 3, '20A', 'Lowcost', 0, '3000.00'),
(354, 3, '20B', 'Lowcost', 0, '3000.00'),
(355, 3, '20C', 'Lowcost', 0, '3000.00'),
(356, 3, '21A', 'Lowcost', 0, '3000.00'),
(357, 3, '21B', 'Lowcost', 1, '3000.00'),
(358, 3, '21C', 'Lowcost', 1, '3000.00'),
(359, 3, '22A', 'Lowcost', 1, '3000.00'),
(360, 3, '22B', 'Lowcost', 0, '3000.00'),
(361, 3, '22C', 'Lowcost', 1, '3000.00'),
(362, 3, '23A', 'Lowcost', 0, '3000.00'),
(363, 3, '23B', 'Lowcost', 0, '3000.00'),
(364, 3, '23C', 'Lowcost', 1, '3000.00'),
(365, 4, '1A', 'Business', 0, '10000.00'),
(366, 4, '1B', 'Business', 1, '10000.00'),
(367, 4, '1C', 'Business', 1, '10000.00'),
(368, 4, '2A', 'Business', 0, '10000.00'),
(369, 4, '2B', 'Business', 0, '10000.00'),
(370, 4, '2C', 'Business', 0, '10000.00'),
(371, 4, '3A', 'Business', 0, '10000.00'),
(372, 4, '3B', 'Business', 0, '10000.00'),
(373, 4, '3C', 'Business', 1, '10000.00'),
(374, 4, '4A', 'Business', 1, '10000.00'),
(375, 4, '4B', 'Business', 1, '10000.00'),
(376, 4, '4C', 'Business', 0, '10000.00'),
(377, 4, '5A', 'Business', 1, '10000.00'),
(378, 4, '5B', 'Business', 1, '10000.00'),
(379, 4, '5C', 'Business', 1, '10000.00'),
(380, 4, '6A', 'Business', 0, '10000.00'),
(381, 4, '6B', 'Business', 1, '10000.00'),
(382, 4, '6C', 'Business', 1, '10000.00'),
(383, 4, '7A', 'Business', 0, '10000.00'),
(384, 4, '7B', 'Business', 1, '10000.00'),
(385, 4, '7C', 'Business', 0, '10000.00'),
(386, 4, '8A', 'Business', 1, '10000.00'),
(387, 4, '8B', 'Business', 0, '10000.00'),
(388, 4, '8C', 'Business', 0, '10000.00'),
(389, 4, '9A', 'Economy', 0, '5000.00'),
(390, 4, '9B', 'Economy', 1, '5000.00'),
(391, 4, '9C', 'Economy', 1, '5000.00'),
(392, 4, '10A', 'Economy', 0, '5000.00'),
(393, 4, '10B', 'Economy', 1, '5000.00'),
(394, 4, '10C', 'Economy', 1, '5000.00'),
(395, 4, '11A', 'Economy', 1, '5000.00'),
(396, 4, '11B', 'Economy', 1, '5000.00'),
(397, 4, '11C', 'Economy', 1, '5000.00'),
(398, 4, '12A', 'Economy', 1, '5000.00'),
(399, 4, '12B', 'Economy', 1, '5000.00'),
(400, 4, '12C', 'Economy', 0, '5000.00'),
(401, 4, '13A', 'Economy', 1, '5000.00'),
(402, 4, '13B', 'Economy', 0, '5000.00'),
(403, 4, '13C', 'Economy', 1, '5000.00'),
(404, 4, '14A', 'Economy', 1, '5000.00'),
(405, 4, '14B', 'Economy', 1, '5000.00'),
(406, 4, '14C', 'Economy', 0, '5000.00'),
(407, 4, '15A', 'Economy', 1, '5000.00'),
(408, 4, '15B', 'Economy', 0, '5000.00'),
(409, 4, '15C', 'Economy', 1, '5000.00'),
(410, 4, '16A', 'Economy', 0, '5000.00'),
(411, 4, '16B', 'Economy', 0, '5000.00'),
(412, 4, '16C', 'Economy', 1, '5000.00'),
(413, 4, '17A', 'Economy', 1, '5000.00'),
(414, 4, '17B', 'Economy', 1, '5000.00'),
(415, 4, '17C', 'Economy', 1, '5000.00'),
(416, 4, '18A', 'Economy', 1, '5000.00'),
(417, 4, '18B', 'Economy', 0, '5000.00'),
(418, 4, '18B', 'Economy', 1, '5000.00'),
(419, 4, '18C', 'Economy', 1, '5000.00'),
(420, 4, '19A', 'Economy', 1, '5000.00'),
(421, 4, '19B', 'Economy', 0, '5000.00'),
(423, 4, '20A', 'Lowcost', 0, '3700.00'),
(424, 4, '20B', 'Lowcost', 0, '3700.00'),
(425, 4, '20C', 'Lowcost', 0, '3700.00'),
(426, 4, '21A', 'Lowcost', 1, '3700.00'),
(427, 4, '21B', 'Lowcost', 0, '3700.00'),
(428, 4, '21C', 'Lowcost', 1, '3700.00'),
(429, 4, '22A', 'Lowcost', 1, '3700.00'),
(430, 4, '22B', 'Lowcost', 1, '3700.00'),
(431, 4, '22C', 'Lowcost', 1, '3700.00'),
(432, 4, '23A', 'Lowcost', 0, '3700.00'),
(433, 4, '23B', 'Lowcost', 1, '3700.00'),
(434, 4, '23C', 'Lowcost', 1, '3700.00'),
(435, 5, '1A', 'Business', 1, '10000.00'),
(436, 5, '1B', 'Business', 0, '10000.00'),
(437, 5, '1C', 'Business', 1, '10000.00'),
(438, 5, '2A', 'Business', 1, '10000.00'),
(439, 5, '2B', 'Business', 0, '10000.00'),
(440, 5, '2C', 'Business', 1, '10000.00'),
(441, 5, '3A', 'Business', 0, '10000.00'),
(442, 5, '3B', 'Business', 1, '10000.00'),
(443, 5, '3C', 'Business', 1, '10000.00'),
(444, 5, '4A', 'Business', 0, '10000.00'),
(445, 5, '4B', 'Business', 1, '10000.00'),
(446, 5, '4C', 'Business', 1, '10000.00'),
(447, 5, '5A', 'Business', 0, '10000.00'),
(448, 5, '5B', 'Business', 0, '10000.00'),
(449, 5, '5C', 'Business', 0, '10000.00'),
(450, 5, '6A', 'Business', 1, '10000.00'),
(451, 5, '6B', 'Business', 1, '10000.00'),
(452, 5, '6C', 'Business', 0, '10000.00'),
(453, 5, '7A', 'Business', 0, '10000.00'),
(454, 5, '7B', 'Business', 0, '10000.00'),
(455, 5, '7C', 'Business', 0, '10000.00'),
(456, 5, '8A', 'Business', 0, '10000.00'),
(457, 5, '8B', 'Business', 0, '10000.00'),
(458, 5, '8C', 'Business', 0, '10000.00'),
(459, 5, '9A', 'Economy', 0, '5000.00'),
(460, 5, '9B', 'Economy', 1, '5000.00'),
(461, 5, '9C', 'Economy', 0, '5000.00'),
(462, 5, '10A', 'Economy', 0, '5000.00'),
(463, 5, '10B', 'Economy', 1, '5000.00'),
(464, 5, '10C', 'Economy', 1, '5000.00'),
(465, 5, '11A', 'Economy', 0, '5000.00'),
(466, 5, '11B', 'Economy', 1, '5000.00'),
(467, 5, '11C', 'Economy', 1, '5000.00'),
(468, 5, '12A', 'Economy', 1, '5000.00'),
(469, 5, '12B', 'Economy', 0, '5000.00'),
(470, 5, '12C', 'Economy', 1, '5000.00'),
(471, 5, '13A', 'Economy', 0, '5000.00'),
(472, 5, '13B', 'Economy', 1, '5000.00'),
(473, 5, '13C', 'Economy', 1, '5000.00'),
(474, 5, '14A', 'Economy', 0, '5000.00'),
(475, 5, '14B', 'Economy', 1, '5000.00'),
(476, 5, '14C', 'Economy', 1, '5000.00'),
(477, 5, '15A', 'Economy', 1, '5000.00'),
(478, 5, '15B', 'Economy', 1, '5000.00'),
(479, 5, '15C', 'Economy', 1, '5000.00'),
(480, 5, '16A', 'Economy', 0, '5000.00'),
(481, 5, '16B', 'Economy', 1, '5000.00'),
(482, 5, '16C', 'Economy', 1, '5000.00'),
(483, 5, '17A', 'Economy', 1, '5000.00'),
(484, 5, '17B', 'Economy', 1, '5000.00'),
(485, 5, '17C', 'Economy', 1, '5000.00'),
(486, 5, '18A', 'Economy', 0, '5000.00'),
(487, 5, '18B', 'Economy', 1, '5000.00'),
(488, 5, '18C', 'Economy', 0, '5000.00'),
(489, 5, '19A', 'Economy', 0, '5000.00'),
(490, 5, '19B', 'Economy', 0, '5000.00'),
(491, 5, '19C', 'Economy', 1, '5000.00'),
(492, 5, '20A', 'Lowcost', 0, '4100.00'),
(493, 5, '20B', 'Lowcost', 1, '4100.00'),
(494, 5, '20C', 'Lowcost', 1, '4100.00'),
(495, 5, '21A', 'Lowcost', 0, '4100.00'),
(496, 5, '21B', 'Lowcost', 0, '4100.00'),
(497, 5, '21C', 'Lowcost', 0, '4100.00'),
(498, 5, '22A', 'Lowcost', 0, '4100.00'),
(499, 5, '22B', 'Lowcost', 0, '4100.00'),
(500, 5, '22C', 'Lowcost', 1, '4100.00'),
(501, 5, '23A', 'Lowcost', 1, '4100.00'),
(502, 5, '23B', 'Lowcost', 0, '4100.00'),
(503, 5, '23C', 'Lowcost', 0, '4100.00'),
(504, 6, '1A', 'Business', 0, '10000.00'),
(505, 6, '1B', 'Business', 1, '10000.00'),
(506, 6, '1C', 'Business', 1, '10000.00'),
(507, 6, '2A', 'Business', 1, '10000.00'),
(508, 6, '2B', 'Business', 1, '10000.00'),
(509, 6, '2C', 'Business', 1, '10000.00'),
(510, 6, '3A', 'Business', 0, '10000.00'),
(511, 6, '3B', 'Business', 0, '10000.00'),
(512, 6, '3C', 'Business', 0, '10000.00'),
(513, 6, '4A', 'Business', 0, '10000.00'),
(514, 6, '4B', 'Business', 1, '10000.00'),
(515, 6, '4C', 'Business', 0, '10000.00'),
(516, 6, '5A', 'Business', 1, '10000.00'),
(517, 6, '5B', 'Business', 1, '10000.00'),
(518, 6, '5C', 'Business', 0, '10000.00'),
(519, 6, '6A', 'Business', 1, '10000.00'),
(520, 6, '6B', 'Business', 0, '10000.00'),
(521, 6, '6C', 'Business', 1, '10000.00'),
(522, 6, '7A', 'Business', 1, '10000.00'),
(523, 6, '7B', 'Business', 0, '10000.00'),
(524, 6, '7C', 'Business', 0, '10000.00'),
(525, 6, '8A', 'Business', 0, '10000.00'),
(526, 6, '8B', 'Business', 0, '10000.00'),
(527, 6, '8C', 'Business', 0, '10000.00'),
(528, 6, '9A', 'Economy', 0, '5000.00'),
(529, 6, '9B', 'Economy', 1, '5000.00'),
(530, 6, '9C', 'Economy', 1, '5000.00'),
(531, 6, '10A', 'Economy', 1, '5000.00'),
(532, 6, '10B', 'Economy', 1, '5000.00'),
(533, 6, '10C', 'Economy', 0, '5000.00'),
(534, 6, '11A', 'Economy', 0, '5000.00'),
(535, 6, '11B', 'Economy', 1, '5000.00'),
(536, 6, '11C', 'Economy', 1, '5000.00'),
(537, 6, '12A', 'Economy', 1, '5000.00'),
(538, 6, '12B', 'Economy', 0, '5000.00'),
(539, 6, '12C', 'Economy', 0, '5000.00'),
(540, 6, '13A', 'Economy', 0, '5000.00'),
(541, 6, '13B', 'Economy', 0, '5000.00'),
(542, 6, '13C', 'Economy', 0, '5000.00'),
(543, 6, '14A', 'Economy', 1, '5000.00'),
(544, 6, '14B', 'Economy', 0, '5000.00'),
(545, 6, '14C', 'Economy', 0, '5000.00'),
(546, 6, '15A', 'Economy', 1, '5000.00'),
(547, 6, '15B', 'Economy', 0, '5000.00'),
(548, 6, '15C', 'Economy', 0, '5000.00'),
(549, 6, '16A', 'Economy', 0, '5000.00'),
(550, 6, '16B', 'Economy', 1, '5000.00'),
(551, 6, '16C', 'Economy', 0, '5000.00'),
(552, 6, '17A', 'Economy', 1, '5000.00'),
(553, 6, '17B', 'Economy', 1, '5000.00'),
(554, 6, '17C', 'Economy', 1, '5000.00'),
(555, 6, '18A', 'Economy', 0, '5000.00'),
(556, 6, '18B', 'Economy', 0, '5000.00'),
(557, 6, '18C', 'Economy', 1, '5000.00'),
(558, 6, '19A', 'Economy', 1, '5000.00'),
(559, 6, '19B', 'Economy', 1, '5000.00'),
(560, 6, '19C', 'Economy', 0, '5000.00'),
(561, 6, '20A', 'Lowcost', 0, '3850.00'),
(562, 6, '20B', 'Lowcost', 0, '3850.00'),
(563, 6, '20C', 'Lowcost', 0, '3850.00'),
(564, 6, '21A', 'Lowcost', 1, '3850.00'),
(565, 6, '21B', 'Lowcost', 0, '3850.00'),
(566, 6, '21C', 'Lowcost', 1, '3850.00'),
(567, 6, '22A', 'Lowcost', 1, '3850.00'),
(568, 6, '22B', 'Lowcost', 1, '3850.00'),
(569, 6, '22C', 'Lowcost', 0, '3850.00'),
(570, 6, '23A', 'Lowcost', 0, '3850.00'),
(571, 6, '23B', 'Lowcost', 1, '3850.00'),
(572, 6, '23C', 'Lowcost', 1, '3850.00');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`) VALUES
(1, 'Дополнительный багаж', 'При перевозке избыточного багажа возможна оплата дополнительного багажа, обеспечивая удобство и гибкость в путешествиях без лишних забот.', '2500.00'),
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
  `seat_numbers` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT current_timestamp(),
  `flight_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `flight_id`, `seat_numbers`, `purchase_date`, `flight_date`) VALUES
(18, 1, 2, '10A', '2024-05-28', '2024-05-29');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_services`
--

CREATE TABLE `ticket_services` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` enum('Мужчина','Женщина') DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `birthday`, `gender`, `password`, `role`) VALUES
(1, 'Абдулин Никита Русланович', 'admin@mail.ru', '2005-01-31', 'Мужчина', '$2y$10$F/eviyzOHL9D3ltCZBVYy.N/kjS54F9Dge45EnHrc987WCXMnkl8K', 2),
(2, 'Василий Иосифович Сталин', 'ussr1945@mail.ru', '2024-05-12', 'Мужчина', '$2y$10$qbb4FHB/faDL3uhAw8ceo.V4jnXcSqSSvmm8qncSHDRrGvjBOr0fe', 1),
(1231481, 'Михаил Иванович Чех', 'michail@mail.ru', '2024-04-12', 'Мужчина', '$2y$10$r.f/l5O.MaANibCTZUL5Le9MxGo2BUbEjvarjFSpYHalDrfw5J2om', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `seat_map`
--
ALTER TABLE `seat_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=573;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1231482;

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
