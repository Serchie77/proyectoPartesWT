-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2024 a las 20:03:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `partes2024`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `comentarios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `email`, `telefono`, `direccion`, `comentarios`) VALUES
(1, 'Antonio', 'López Ramírez', 'anlora@mail.com', '666111333', 'Calle larga, 123', 'Es una prueba 1'),
(2, 'Fulanito', 'Jiménez', 'fuljim@mail.es', '656011111', 'Calle Méndez Núñez, 55 B', 'Pedir DNI'),
(4, 'Antonio Manuel', 'Borrego Manzano', 'anmaboma@gmail.com', '666878787', 'Plaza Nueva, 43', 'Direccion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes`
--

CREATE TABLE `partes` (
  `idParte` int(11) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `totalHorasNormales` decimal(5,2) DEFAULT NULL,
  `totalHorasExtras` decimal(5,2) DEFAULT NULL,
  `horasViaje` decimal(5,2) DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idProyecto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partes`
--

INSERT INTO `partes` (`idParte`, `fechaInicio`, `fechaFin`, `totalHorasNormales`, `totalHorasExtras`, `horasViaje`, `comentarios`, `idUsuario`, `idProyecto`) VALUES
(1, '2024-04-21', NULL, NULL, NULL, 2.00, 'Realizar trabajos varios', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parteshoras`
--

CREATE TABLE `parteshoras` (
  `idParteHora` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horasNormales` decimal(5,2) DEFAULT NULL,
  `horasExtras` decimal(5,2) DEFAULT NULL,
  `idParte` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parteshoras`
--

INSERT INTO `parteshoras` (`idParteHora`, `fecha`, `horasNormales`, `horasExtras`, `idParte`, `idUsuario`) VALUES
(1, '2024-05-13', 8.00, 0.00, 1, 2),
(2, '2024-05-14', 8.00, 1.00, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `idProyecto` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`idProyecto`, `nombre`, `lugar`, `fechaInicio`, `fechaFin`, `idCliente`) VALUES
(1, 'casa Pepe', 'calle Alfareros de Sevilla', '2024-04-14', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(2) NOT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `rol`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `idRol` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `password`, `nombre`, `apellidos`, `direccion`, `telefono`, `email`, `idRol`) VALUES
(1, 'sergioadmin', 'cc4f3abf9b752533dcecd12049e71fdfc5f54c8c8d5cada48a70d120095c9c77', 'Sergio', 'Martínez Rodríguez', 'Calle 19 - 41620 Sevilla', '600123456', 'sergio@gmail.com', 1),
(2, 'pepevema', '0ef3ed934c6b80c9e3eb60fe541026868115e949e985b09a2b5c40260336c0a5', 'Pepito', 'Vega Marín', 'Calle Alcantarilla, 102\r\n41002 Sevilla', '654123987', 'pepevema@gmail.com', 2),
(3, 'manupegil', '65557960a2c2e25eed9b0c4f1f39508d2a1c2eca4c410712eb25e06e835e6cd4', 'Manuel', 'Pérez Gil', 'Calle Avendaño, 49\r\n04271 Lubrín\r\nAlmería', '766452718', 'mapegil@gmail.com', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `partes`
--
ALTER TABLE `partes`
  ADD PRIMARY KEY (`idParte`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProyecto` (`idProyecto`);

--
-- Indices de la tabla `parteshoras`
--
ALTER TABLE `parteshoras`
  ADD PRIMARY KEY (`idParteHora`),
  ADD KEY `idParte` (`idParte`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`idProyecto`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `partes`
--
ALTER TABLE `partes`
  MODIFY `idParte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `parteshoras`
--
ALTER TABLE `parteshoras`
  MODIFY `idParteHora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `idProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partes`
--
ALTER TABLE `partes`
  ADD CONSTRAINT `partes_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `partes_ibfk_3` FOREIGN KEY (`idProyecto`) REFERENCES `proyectos` (`idProyecto`);

--
-- Filtros para la tabla `parteshoras`
--
ALTER TABLE `parteshoras`
  ADD CONSTRAINT `parteshoras_ibfk_1` FOREIGN KEY (`idParte`) REFERENCES `partes` (`idParte`),
  ADD CONSTRAINT `parteshoras_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
