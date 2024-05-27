-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2024 a las 18:57:10
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
  `telefono` varchar(9) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `comentarios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `email`, `telefono`, `direccion`, `comentarios`) VALUES
(1, 'Antonio', 'López Ramírez', 'anlora@mail.com', '666111333', 'Calle larga, 123', 'Es una prueba 1'),
(2, 'Ángel', 'Jiménez', 'fuljim@mail.es', '656011111', 'Calle Méndez Núñez, 55 B', 'Pedir DNI'),
(4, 'Fernando', 'Borrego Manzano', 'anmaboma@gmail.com', '666878787', 'Plaza Nueva, 43', 'Direccion'),
(5, 'Manuel', 'Gutiérrez Carmona', 'magucar@gmail.es', '666444333', 'Calle Mesones', 'creado desde clientes directamente'),
(7, 'Dionisio', 'Fernández Marrón', 'diosferma@mail.es', '600123987', 'Calle de la Cruz, 44 Mairena del Aljarafe - Sevilla', 'prueba de secciones en funcionamiento'),
(10, 'Eduardo', 'Calatrava Hernández', 'educaher@mail.es', '603669874', 'Plaza de Zarzuela, 2 - Córdoba', 'Pedir documentación obras.');

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
(1, '2024-04-21', '2024-06-24', 0.00, 0.00, 2.00, 'Trabajos de soldadura', 2, 1),
(2, '2024-05-01', '2024-06-10', 0.00, 0.00, 0.00, 'Trabajos de fontanería', 3, 1),
(3, '2024-05-22', '0000-00-00', 8.00, 0.00, 0.00, 'Trabajos mantenimiento', 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parteshoras`
--

CREATE TABLE `parteshoras` (
  `idParteHora` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horasNormales` decimal(5,2) DEFAULT NULL,
  `horasExtras` decimal(5,2) DEFAULT NULL,
  `idParte` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parteshoras`
--

INSERT INTO `parteshoras` (`idParteHora`, `fecha`, `horasNormales`, `horasExtras`, `idParte`, `idUsuario`) VALUES
(1, '2024-05-13', 8.00, 0.00, 1, 2),
(2, '2024-05-14', 8.00, 1.00, 1, 2),
(4, '2024-05-22', 8.00, 1.00, 2, 5),
(5, '2024-06-03', 8.00, 0.00, 3, 3),
(6, '2024-05-22', 8.00, 0.00, 3, 3);

--
-- Disparadores `parteshoras`
--
DELIMITER $$
CREATE TRIGGER `calcularHorasTotales` AFTER INSERT ON `parteshoras` FOR EACH ROW BEGIN
    DECLARE totalHorasNormales DECIMAL(5,2);
    DECLARE totalHorasExtras DECIMAL(5,2);
    DECLARE totalHoras DECIMAL(5,2);

    -- Obtener las horas normales y extras totales del parte
    SELECT SUM(horasNormales), SUM(horasExtras)
    INTO totalHorasNormales, totalHorasExtras
    FROM partesHoras
    WHERE idParte = NEW.idParte;

    -- Calcular las horas totales
    SET totalHoras = totalHorasNormales + totalHorasExtras;

    -- Actualizar el parte con las horas totales calculadas
UPDATE partes
SET totalHorasNormales = totalHorasNormales, totalHorasExtras = totalHorasExtras
WHERE idParte = NEW.idParte;

END
$$
DELIMITER ;

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
(1, 'Casa Pepe Palanca', 'calle Alfareros de Sevilla', '2024-04-14', '2025-02-03', 1),
(2, 'Piscina municipal Antequera', 'calle albaricoque', '2024-05-27', '2024-08-31', 4),
(3, 'Restauración Hotel Princesa', 'calle Madrid, 3', '2024-06-14', '2025-07-31', 7);

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
(2, 'pepevema', '0ef3ed934c6b80c9e3eb60fe541026868115e949e985b09a2b5c40260336c0a5', 'Pepe', 'Vega Marín', 'Calle Alcantarilla, 10241002 Sevilla', '654123987', 'pepevema@gmail.com', 2),
(3, 'manupegil', '65557960a2c2e25eed9b0c4f1f39508d2a1c2eca4c410712eb25e06e835e6cd4', 'Manuel', 'Pérez Gil', 'Calle Avendaño, 49\r\n04271 Lubrín\r\nAlmería', '766452718', 'mapegil@gmail.com', 2),
(5, 'robertogama', 'b54851328167dff4c4f4cfc7e59ae4f16afbb4dab2b287873905faa9a0984d20', 'Roberto', 'García Márquez', 'Torres Altas, 99 - 41010 SEVILLA', '666012965', 'rogama@mail.com', 2);

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
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `partes`
--
ALTER TABLE `partes`
  MODIFY `idParte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `parteshoras`
--
ALTER TABLE `parteshoras`
  MODIFY `idParteHora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `idProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
