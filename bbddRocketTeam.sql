-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 04-04-2024 a las 17:49:14
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bbddRocketTeam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tranfer_hotel`
--

CREATE TABLE `tranfer_hotel` (
  `id_hotel` int NOT NULL,
  `id_zona` int DEFAULT NULL,
  `Comision` int DEFAULT NULL,
  `email_hotel` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tranfer_hotel`
--

INSERT INTO `tranfer_hotel` (`id_hotel`, `id_zona`, `Comision`, `email_hotel`, `password`) VALUES
(1, 2, 5, 'administracion@hotelBackend.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_admin`
--

CREATE TABLE `transfer_admin` (
  `id_admin` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `transfer_admin`
--

INSERT INTO `transfer_admin` (`id_admin`, `nombre`, `email`, `password`) VALUES
(1, 'Enric', 'emartinad@uoc.edu', '1234'),
(2, 'Jordi', 'jcarre@uoc.edu', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_precios`
--

CREATE TABLE `transfer_precios` (
  `id_precios` int NOT NULL,
  `id_vehiculo` int NOT NULL,
  `id_hotel` int NOT NULL,
  `Precio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_precios`
--

INSERT INTO `transfer_precios` (`id_precios`, `id_vehiculo`, `id_hotel`, `Precio`) VALUES
(1, 1, 1, 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_reservas`
--

CREATE TABLE `transfer_reservas` (
  `id_reserva` int NOT NULL,
  `localizador` varchar(100) NOT NULL,
  `id_hotel` int DEFAULT NULL COMMENT 'Es el hotel que realiza la reserva',
  `id_tipo_reserva` int NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_destino` int NOT NULL,
  `fecha_entrada` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `numero_vuelo_entrada` varchar(50) NOT NULL,
  `origen_vuelo_entrada` varchar(50) NOT NULL,
  `hora_vuelo_salida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_vuelo_salida` date NOT NULL,
  `num_viajeros` int NOT NULL,
  `id_vehiculo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_reservas`
--

INSERT INTO `transfer_reservas` (`id_reserva`, `localizador`, `id_hotel`, `id_tipo_reserva`, `email_cliente`, `fecha_reserva`, `fecha_modificacion`, `id_destino`, `fecha_entrada`, `hora_entrada`, `numero_vuelo_entrada`, `origen_vuelo_entrada`, `hora_vuelo_salida`, `fecha_vuelo_salida`, `num_viajeros`, `id_vehiculo`) VALUES
(1, '1', 1, 2, 'ematinad@uoc.edu', '2024-04-03 00:00:00', '2024-04-03 00:00:00', 1, '2024-05-01', '10:00:00', 'Y125A', 'Espanya', '2024-04-03 16:47:29', '2024-05-05', 2, 1),
(5, '2', 1, 3, 'jordi.carres@gmail.com', '2024-03-25 00:00:00', '2024-03-25 00:00:00', 1, '2024-04-01', '22:00:00', 'A125Y', 'Holanda', '2024-04-03 17:36:16', '2024-05-01', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_tipo_reserva`
--

CREATE TABLE `transfer_tipo_reserva` (
  `id_tipo_reserva` int NOT NULL,
  `Descripción` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_tipo_reserva`
--

INSERT INTO `transfer_tipo_reserva` (`id_tipo_reserva`, `Descripción`) VALUES
(1, 'Aeropuerto a hotel'),
(2, 'Hotel a aeropuerto'),
(3, 'Ida y vuelta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_vehiculo`
--

CREATE TABLE `transfer_vehiculo` (
  `id_vehiculo` int NOT NULL,
  `Descripción` varchar(100) NOT NULL,
  `email_conductor` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_vehiculo`
--

INSERT INTO `transfer_vehiculo` (`id_vehiculo`, `Descripción`, `email_conductor`, `password`) VALUES
(1, 'Toyota Pyrus', 'pepeTaxista@taxis.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_viajeros`
--

CREATE TABLE `transfer_viajeros` (
  `id_viajero` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `codigoPostal` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_viajeros`
--

INSERT INTO `transfer_viajeros` (`id_viajero`, `nombre`, `apellido1`, `apellido2`, `direccion`, `codigoPostal`, `ciudad`, `pais`, `email`, `password`) VALUES
(1, 'Jordi', 'C', 'Soms', 'C/ Em fa mandra', '08223', 'terrassa', 'España', 'jordi.carres@gmail.com', '1234'),
(2, 'Enric', 'Marin', 'Pepe', 'Fa mandra', '17410', 'Girona', 'España', 'ematinad@uoc.edu', '1234'),
(3, 'Prueba', 'Prueba', 'Prueba', 'Fa mandra', '08000', 'Barcelona', 'España', 'j@g.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_zona`
--

CREATE TABLE `transfer_zona` (
  `id_zona` int NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_zona`
--

INSERT INTO `transfer_zona` (`id_zona`, `descripcion`) VALUES
(2, 'Europa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tranfer_hotel`
--
ALTER TABLE `tranfer_hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `FK_HOTEL_ZONA` (`id_zona`);

--
-- Indices de la tabla `transfer_admin`
--
ALTER TABLE `transfer_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `transfer_precios`
--
ALTER TABLE `transfer_precios`
  ADD PRIMARY KEY (`id_precios`),
  ADD KEY `FK_PRECIOS_HOTEL` (`id_hotel`),
  ADD KEY `FK_PRECIOS_VEHICULO` (`id_vehiculo`);

--
-- Indices de la tabla `transfer_reservas`
--
ALTER TABLE `transfer_reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `FK_RESERVAS_DESTINO` (`id_destino`),
  ADD KEY `FK_RESERVAS_HOTEL` (`id_hotel`),
  ADD KEY `FK_RESERVAS_TIPO` (`id_tipo_reserva`),
  ADD KEY `FK_RESERVAS_VEHICULO` (`id_vehiculo`);

--
-- Indices de la tabla `transfer_tipo_reserva`
--
ALTER TABLE `transfer_tipo_reserva`
  ADD PRIMARY KEY (`id_tipo_reserva`);

--
-- Indices de la tabla `transfer_vehiculo`
--
ALTER TABLE `transfer_vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- Indices de la tabla `transfer_viajeros`
--
ALTER TABLE `transfer_viajeros`
  ADD PRIMARY KEY (`id_viajero`);

--
-- Indices de la tabla `transfer_zona`
--
ALTER TABLE `transfer_zona`
  ADD PRIMARY KEY (`id_zona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tranfer_hotel`
--
ALTER TABLE `tranfer_hotel`
  MODIFY `id_hotel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `transfer_admin`
--
ALTER TABLE `transfer_admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `transfer_precios`
--
ALTER TABLE `transfer_precios`
  MODIFY `id_precios` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `transfer_reservas`
--
ALTER TABLE `transfer_reservas`
  MODIFY `id_reserva` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transfer_tipo_reserva`
--
ALTER TABLE `transfer_tipo_reserva`
  MODIFY `id_tipo_reserva` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transfer_vehiculo`
--
ALTER TABLE `transfer_vehiculo`
  MODIFY `id_vehiculo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `transfer_viajeros`
--
ALTER TABLE `transfer_viajeros`
  MODIFY `id_viajero` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transfer_zona`
--
ALTER TABLE `transfer_zona`
  MODIFY `id_zona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tranfer_hotel`
--
ALTER TABLE `tranfer_hotel`
  ADD CONSTRAINT `FK_HOTEL_ZONA` FOREIGN KEY (`id_zona`) REFERENCES `transfer_zona` (`id_zona`);

--
-- Filtros para la tabla `transfer_precios`
--
ALTER TABLE `transfer_precios`
  ADD CONSTRAINT `FK_PRECIOS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `tranfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_PRECIOS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`);

--
-- Filtros para la tabla `transfer_reservas`
--
ALTER TABLE `transfer_reservas`
  ADD CONSTRAINT `FK_RESERVAS_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `tranfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_RESERVAS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `tranfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_RESERVAS_TIPO` FOREIGN KEY (`id_tipo_reserva`) REFERENCES `transfer_tipo_reserva` (`id_tipo_reserva`),
  ADD CONSTRAINT `FK_RESERVAS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
