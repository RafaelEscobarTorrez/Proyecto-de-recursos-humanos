-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3305
-- Tiempo de generación: 05-05-2025 a las 02:04:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_recursos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id` int(11) NOT NULL,
  `nombre_ingrediente` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `unidad` varchar(20) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `nombre_ingrediente`, `tipo`, `unidad`, `precio_unitario`) VALUES
(1, 'Malta Pilsen', 'Malta', 'kg', 12.50),
(2, 'Lúpulo Saaz', 'Lúpulo', 'gramos', 0.60),
(3, 'Levadura Lager', 'Levadura', 'unidad', 28.00),
(4, 'Malta de Trigo', 'Malta', 'kg', 14.00),
(5, 'Lúpulo Perle', 'Lúpulo', 'gramos', 0.75),
(6, 'Enzima para Cerveza de Trigo', 'Aditivo', 'litro', 35.00),
(7, 'Malta Caramelo', 'Malta', 'kg', 15.80),
(8, 'Lúpulo Hallertau Tradition', 'Lúpulo', 'gramos', 0.90),
(9, 'Extracto de Malta', 'Malta', 'kg', 32.00),
(10, 'Jarabe de Maíz', 'Adjunto', 'kg', 8.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes_receta`
--

CREATE TABLE `ingredientes_receta` (
  `id` int(11) NOT NULL,
  `receta_id` int(11) DEFAULT NULL,
  `ingrediente_id` int(11) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingredientes_receta`
--

INSERT INTO `ingredientes_receta` (`id`, `receta_id`, `ingrediente_id`, `cantidad`) VALUES
(1, 1, 1, 5.50),
(2, 1, 2, 25.00),
(3, 1, 3, 1.00),
(4, 1, 10, 0.50),
(5, 2, 1, 6.00),
(6, 2, 5, 30.00),
(7, 2, 3, 1.20),
(8, 3, 4, 4.00),
(9, 3, 1, 2.00),
(10, 3, 5, 15.00),
(11, 3, 6, 0.10),
(12, 3, 7, 0.30),
(13, 4, 9, 7.00),
(14, 4, 8, 20.00),
(15, 4, 3, 1.10),
(16, 5, 9, 8.00),
(17, 5, 7, 0.50),
(18, 5, 6, 0.05);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id` int(11) NOT NULL,
  `receta_id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `litros_producidos` decimal(10,2) DEFAULT NULL,
  `costo_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id`, `receta_id`, `fecha_inicio`, `fecha_fin`, `litros_producidos`, `costo_total`) VALUES
(1, 1, '2025-05-01', '2025-05-05', 1500.00, 125.50),
(2, 1, '2025-05-05', '2025-05-10', 1800.00, 160.75),
(3, 1, '2025-05-10', '2025-05-12', 950.00, 85.20),
(4, 1, '2025-05-15', '2025-05-20', 2100.00, 195.00),
(5, 1, '2025-05-20', '2025-05-23', 1200.00, 110.30),
(10, 2, '2025-05-16', '2025-05-30', 200.00, 1048.80),
(11, 5, '2011-01-15', '2011-01-22', 25.00, 221.38),
(12, 1, '1974-03-15', '1974-03-29', 78.00, 452.40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id` int(11) NOT NULL,
  `nombre_receta` varchar(100) DEFAULT NULL,
  `estilo` varchar(50) DEFAULT NULL,
  `litros_base` decimal(10,2) DEFAULT NULL,
  `tiempo_fermentacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id`, `nombre_receta`, `estilo`, `litros_base`, `tiempo_fermentacion`) VALUES
(1, 'Clásica', 'Lager', 20.00, 14),
(2, 'Pilsener', 'Pilsner', 25.00, 14),
(3, 'Trigo', 'Weizenbier', 18.50, 7),
(4, 'Ducal Premium Lager', 'Lager', 22.00, 14),
(5, 'Maltina', 'Sin Alcohol', 30.00, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_insumos`
--

CREATE TABLE `stock_insumos` (
  `id` int(11) NOT NULL,
  `ingrediente_id` int(11) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock_insumos`
--

INSERT INTO `stock_insumos` (`id`, `ingrediente_id`, `cantidad`, `fecha_ingreso`) VALUES
(1, 1, 50.00, '2025-05-01'),
(2, 2, 200.00, '2025-05-02'),
(3, 3, 5.00, '2025-05-01'),
(4, 4, 40.00, '2025-05-03'),
(5, 5, 180.00, '2025-05-01'),
(6, 6, 10.00, '2025-05-02'),
(7, 7, 30.00, '2025-05-01'),
(8, 8, 120.00, '2025-05-03'),
(9, 9, 25.00, '2025-05-02'),
(10, 10, 70.00, '2025-05-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `lote_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `cantidad_litros` decimal(10,2) DEFAULT NULL,
  `precio_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingredientes_receta`
--
ALTER TABLE `ingredientes_receta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receta_id` (`receta_id`),
  ADD KEY `ingrediente_id` (`ingrediente_id`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receta_id` (`receta_id`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock_insumos`
--
ALTER TABLE `stock_insumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingrediente_id` (`ingrediente_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lote_id` (`lote_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ingredientes_receta`
--
ALTER TABLE `ingredientes_receta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `stock_insumos`
--
ALTER TABLE `stock_insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingredientes_receta`
--
ALTER TABLE `ingredientes_receta`
  ADD CONSTRAINT `ingredientes_receta_ibfk_1` FOREIGN KEY (`receta_id`) REFERENCES `recetas` (`id`),
  ADD CONSTRAINT `ingredientes_receta_ibfk_2` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`id`);

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`receta_id`) REFERENCES `recetas` (`id`);

--
-- Filtros para la tabla `stock_insumos`
--
ALTER TABLE `stock_insumos`
  ADD CONSTRAINT `stock_insumos_ibfk_1` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
