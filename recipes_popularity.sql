-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2016 a las 13:48:41
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `coctails`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recipes_popularity`
--

CREATE TABLE `recipes_popularity` (
  `url` varchar(250) NOT NULL,
  `title` varchar(255) NOT NULL,
  `favorited` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recipes_popularity`
--

INSERT INTO `recipes_popularity` (`url`, `title`, `favorited`) VALUES
('1', '', 53),
('2', '', 17),
('3', '', 45),
('4', '', 15),
('5', '', 10),
('6', '', 25);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recipes_popularity`
--
ALTER TABLE `recipes_popularity`
  ADD PRIMARY KEY (`url`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
