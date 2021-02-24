-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2021 a las 22:56:52
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

--
-- Volcado de datos para la tabla `notification`
--

INSERT INTO `notification` (`id`, `subject`, `message`, `user_id`) VALUES
(13, 'shift', 'Usuario 1 solicita un turno para Sanación y Armonización Energética, con fecha y hora: 2021-02-17 09:20:00. Su número de contacto es: 1234.', 3),
(15, 'shift', 'Usuario 1 solicita un turno para Sanación y Armonización Energética, con fecha y hora: 2021-02-17 09:20:00. Su número de contacto es: 1234.', 5),
(16, 'shift', 'Usuario 1 solicita un turno para Masaje Venusiano, con fecha y hora: 2021-02-24 10:00:00. Su número de contacto es: 1234.', 3),
(18, 'shift', 'Usuario 1 solicita un turno para Masaje Venusiano, con fecha y hora: 2021-02-24 10:00:00. Su número de contacto es: 1234.', 5),
(19, 'question', 'Usuario 1 hizo una pregunta.', 3),
(21, 'question', 'Usuario 1 hizo una pregunta.', 5),
(24, 'shift', 'Usuario 1 solicita un turno para Reiki, con fecha y hora: 2021-02-22 10:10:00. Su número de contacto es: 1234.', 3),
(26, 'shift', 'Usuario 1 solicita un turno para Reiki, con fecha y hora: 2021-02-22 10:10:00. Su número de contacto es: 1234.', 5),
(27, 'question', 'Usuario 1 hizo una pregunta.', 3),
(29, 'question', 'Usuario 1 hizo una pregunta.', 5),
(30, 'question', 'Usuario 1 hizo una pregunta.', 3),
(32, 'question', 'Usuario 1 hizo una pregunta.', 5),
(33, 'question', 'Usuario 1 hizo una pregunta.', 3),
(35, 'question', 'Usuario 1 hizo una pregunta.', 5),
(36, 'question', 'Usuario 1 hizo una pregunta.', 3),
(38, 'question', 'Usuario 1 hizo una pregunta.', 5),
(39, 'question', 'Usuario 1 hizo una pregunta.', 3),
(41, 'question', 'Usuario 1 hizo una pregunta.', 5),
(44, 'shift', 'Usuario 1 solicita un turno para Masaje Venusiano, con fecha y hora: 2021-02-18 15:15:00. Su número de contacto es: 1234.', 3),
(46, 'shift', 'Usuario 1 solicita un turno para Masaje Venusiano, con fecha y hora: 2021-02-18 15:15:00. Su número de contacto es: 1234.', 5),
(48, 'shift', 'Usuario 1 solicita un turno para Reiki a distancia. Corta duración., con fecha y hora: 2021-02-25 15:30:00. Su número de contacto es: 1234.', 3),
(50, 'shift', 'Usuario 1 solicita un turno para Reiki a distancia. Corta duración., con fecha y hora: 2021-02-25 15:30:00. Su número de contacto es: 1234.', 5),
(51, 'shift', 'Usuario 1 solicita un turno para Lectura de Tarot Terapéutico, con fecha y hora: 2021-02-28 16:30:00. Su número de contacto es: 1234.', 3),
(53, 'shift', 'Usuario 1 solicita un turno para Lectura de Tarot Terapéutico, con fecha y hora: 2021-02-28 16:30:00. Su número de contacto es: 1234.', 5),
(54, 'shift', 'Usuario 1 solicita un turno para Escudo Protector Energético Celta, con fecha y hora: 2021-03-02 15:40:00. Su número de contacto es: 1234.', 3),
(56, 'shift', 'Usuario 1 solicita un turno para Escudo Protector Energético Celta, con fecha y hora: 2021-03-02 15:40:00. Su número de contacto es: 1234.', 5),
(57, 'shift', 'Usuario 1 solicita un turno para Reiki a distancia. Corta duración., con fecha y hora: 2021-03-10 14:40:00. Su número de contacto es: 1234.', 3),
(59, 'shift', 'Usuario 1 solicita un turno para Reiki a distancia. Corta duración., con fecha y hora: 2021-03-10 14:40:00. Su número de contacto es: 1234.', 5),
(61, 'shift', 'Usuario 1 solicita un turno para Reiki presencial, con fecha y hora: 2021-03-04 15:43:00. Su número de contacto es: 1234.', 3),
(63, 'shift', 'Usuario 1 solicita un turno para Reiki presencial, con fecha y hora: 2021-03-04 15:43:00. Su número de contacto es: 1234.', 5),
(64, 'shift', 'Usuario 1 solicita un turno para Reiki a distancia. Corta duración., con fecha y hora: 2021-03-10 15:30:00. Su número de contacto es: 1234.', 3),
(66, 'shift', 'Usuario 1 solicita un turno para Reiki a distancia. Corta duración., con fecha y hora: 2021-03-10 15:30:00. Su número de contacto es: 1234.', 5),
(67, 'shift', 'Usuario 1 solicita un turno para Masaje Venusiano, con fecha y hora: 2021-03-05 20:30:00. Su número de contacto es: 2262000000.', 3),
(69, 'shift', 'Usuario 1 solicita un turno para Masaje Venusiano, con fecha y hora: 2021-03-05 20:30:00. Su número de contacto es: 2262000000.', 5),
(70, 'shift', 'Usuario 1 solicita un turno para Sanación y Armonización Energética, con fecha y hora: 2021-03-12 17:00:00. Su número de contacto es: 2262000000.', 3),
(72, 'shift', 'Usuario 1 solicita un turno para Sanación y Armonización Energética, con fecha y hora: 2021-03-12 17:00:00. Su número de contacto es: 2262000000.', 5),
(73, 'shift', 'Usuario 1 solicita un turno para Lectura de Tarot Terapéutico, con fecha y hora: 2021-02-28 17:10:00. Su número de contacto es: 2262000000.', 3),
(75, 'shift', 'Usuario 1 solicita un turno para Lectura de Tarot Terapéutico, con fecha y hora: 2021-02-28 17:10:00. Su número de contacto es: 2262000000.', 5),
(81, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(83, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(84, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(86, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(87, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(89, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(90, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(92, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(93, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(95, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(96, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(98, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(99, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(101, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(102, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(104, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(105, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(107, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(108, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(110, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(111, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(113, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(114, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(115, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 4),
(116, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(117, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(118, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 4),
(119, 'workshop', 'Usuario 1 desea hacer el taller Taller Despertar. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(120, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(121, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 4),
(122, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(123, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(124, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 4),
(125, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(126, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 3),
(127, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 4),
(128, 'workshop', 'Usuario 1 desea hacer el taller njn. Su email es: usuario1@gmail.com, y su número de teléfono es: 2262000000.', 5),
(129, 'question', 'Usuario 1 hizo una pregunta.', 3),
(130, 'question', 'Usuario 1 hizo una pregunta.', 4),
(131, 'question', 'Usuario 1 hizo una pregunta.', 5),
(132, 'shift', 'Usuario 1 solicita un turno para Reiki a distancia. Larga duración., con fecha y hora: 2021-02-24 19:58:00. Su número de contacto es: 2262000000.', 3),
(133, 'shift', 'Usuario 1 solicita un turno para Reiki a distancia. Larga duración., con fecha y hora: 2021-02-24 19:58:00. Su número de contacto es: 2262000000.', 4),
(134, 'shift', 'Usuario 1 solicita un turno para Reiki a distancia. Larga duración., con fecha y hora: 2021-02-24 19:58:00. Su número de contacto es: 2262000000.', 5);

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
(5, 'chau', 6),
(6, 'Preguntanding', 6),
(7, 'Estoy haciendo una pregunta como usuario 1', 6),
(8, 'Preguntando otra vez', 6),
(9, 'Preguntando otra vez', 6),
(10, 'Preguntando una vez más', 6),
(11, 'Otra', 6),
(12, 'Una pregunta', 6);

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
(27, '2021-02-28 16:30:00', 5, 6, 'Usuario 1', 1),
(30, '2021-02-23 14:30:00', 1, 0, 'Paciente', 1),
(31, '2021-03-04 15:43:00', 1, 6, 'Usuario 1', 1),
(33, '2021-03-10 15:30:00', 3, 6, 'Usuario 1', 1),
(34, '2021-03-05 20:30:00', 4, 6, 'Usuario 1', 1),
(35, '2021-03-12 17:00:00', 6, 6, 'Usuario 1', 1),
(36, '2021-02-24 19:58:00', 2, 6, 'Usuario 1', 0);

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
(1, 'Reiki presencial', 'Presencial. Terapia complementaria que ...', 5),
(2, 'Reiki a distancia. Larga duración.', 'Se practica a distancia y ....', 3),
(3, 'Reiki a distancia. Corta duración.', 'Tiene las mismas características que el Reiki presencial,pero se practica a distancia y con menos intensidad.', 3),
(4, 'Masaje Venusiano', 'Masaje en rostro, cabeza y parte del pecho. Es un verdadero lifting facial que ayuda...', 4),
(5, 'Lectura de Tarot Terapéutico', 'Dejá que los 22 arcanos mayores te aconsejen', 5),
(6, 'Sanación y Armonización Energética', 'Esta terapia ayuda a estar en un completo equilibrio emocional, físico y mental. Se realiza a distancia y dura aproximadamente una hora y en la que el paciente debe procurar estar tranquilo/a.', 0),
(25, 'Escudo Protector Energético Celta', 'A distancia', 4);

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
(6, 'Usuario 1', 'usuario1@gmail.com', '2262000000', '$2y$10$VX2MUVgSCwHOhgybuckt3.436NWrkEoMtVMpiqR5J79FpsYq1rm2e', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workshop`
--

CREATE TABLE `workshop` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `contents` varchar(500) NOT NULL,
  `modality` varchar(300) NOT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `workshop`
--

INSERT INTO `workshop` (`id`, `name`, `caption`, `contents`, `modality`, `image`) VALUES
(1, 'Taller Despertar', 'Aprendé a hacer tu sueños realidad!', 'Ley de Atracción. Mantras. Qué son y cómo crearlo…s. Videos explicativos. Acompañamiento permanente', '100 % online. Una vez efectuado el pago, se envía un .pdf con todo el contenido del taller y los links a los videos y audios.', NULL),
(7, 'njn', 'mnmnm', 'njn', 'nmnm', NULL),
(8, 'nnm,n,m', 'nn,n,m', 'nmn,', 'nn', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `therapy`
--
ALTER TABLE `therapy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `workshop`
--
ALTER TABLE `workshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
