-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-02-2021 a las 01:03:39
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ikaruna`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `text` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `question`
--

INSERT INTO `question` (`id`, `text`, `user_id`) VALUES
(5, 'chau', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `therapy_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(256) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `shift`
--

INSERT INTO `shift` (`id`, `date`, `therapy_id`, `patient_id`, `patient_name`, `status`) VALUES
(7, '2021-02-24 09:30:00', 4, 6, '0', 0),
(8, '2021-02-24 11:40:00', 5, 6, '0', 0),
(9, '2021-02-18 16:30:00', 1, 4, '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `therapy`
--

CREATE TABLE `therapy` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `therapist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `therapy`
--

INSERT INTO `therapy` (`id`, `name`, `description`, `therapist_id`) VALUES
(1, 'Reiki', 'Presencial. Terapia complementaria que ...', 5),
(2, 'Reiki a distancia. Larga duración.', 'Se practica a distancia y ....', 0),
(3, 'Reiki a distancia. Corta duración.', 'Tiene las mismas características que el Reiki presencial,pero se practica a distancia y con menos intensidad.', 3),
(4, 'Masaje Venusiano', 'Masaje en rostro, cabeza y parte del pecho. Es un verdadero lifting facial que ayuda...', 4),
(5, 'Lectura de Tarot Terapéutico', '22 arcanos', 5),
(6, 'Sanación y Armonización Energética', 'Esta terapia ayuda a estar en un completo equilibrio emocional, físico y mental. Se realiza a distancia y dura aproximadamente una hora y en la que el paciente debe procurar estar tranquilo/a.', 0),
(20, 'terapia nueva', 'bbjnj', 0),
(21, 'terapia nueva', 'bbjnj', 0),
(22, 'mn', 'mmm', 0),
(23, 'nm', 'nueva', 0),
(24, 'nueva', 'terapia', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `password`, `admin`) VALUES
(3, 'Gri', 'griseldadelcastello@gmail.com', '2262485889', '$2y$10$xdkMlqlitq/rTnL.iBKidO7/ZkIOZhjcHJk2tD.vRJUuI1XlhhmOO', 1),
(4, 'Sole', 'soledadmerino.1994@gmail.com', '2262630591', '$2y$10$wBp9qlSnzTZpIZXxGq/ZeeHJiKxpenhiu9kwCJ.1Y0ytLvbbHw/6S', 1),
(5, 'Gri ySole', 'ikaruna@gmail.com', '123', '$2y$10$ZVF24pJOVuEQXPqUNGT16.7hqMTPfJUKoUTLWEQUC1dPiCGD4J7Uu', 1),
(6, 'Usuario 1', 'usuario1@gmail.com', '1234', '$2y$10$VX2MUVgSCwHOhgybuckt3.436NWrkEoMtVMpiqR5J79FpsYq1rm2e', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workshop`
--

CREATE TABLE `workshop` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `contents` varchar(500) NOT NULL,
  `modality` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `workshop`
--

INSERT INTO `workshop` (`id`, `name`, `caption`, `contents`, `modality`) VALUES
(1, 'Taller Despertar', 'Aprendé a hacer tu sueños realidad!', 'Introducción.\r\nLey de Atracción.\r\nMantras. Qué son y cómo crearlos.\r\nSigilos. Qué son y cómo crearlos.\r\nActividades para la creación de mantras y sigilos.\r\nMeditaciones guiadas en audios.\r\nVideos explicativos.\r\nAcompañamiento permanente.', '100 % online. Una vez efectuado el pago, se envía un .pdf con todo el contenido del taller y los links a los videos y audios.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `therapy`
--
ALTER TABLE `therapy`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `therapy`
--
ALTER TABLE `therapy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `workshop`
--
ALTER TABLE `workshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
