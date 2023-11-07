-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2023 a las 05:11:30
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contabilidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `DETALLE` varchar(50) NOT NULL,
  `RAZON` varchar(100) NOT NULL,
  `CODIGO` int(11) NOT NULL,
  `TOTAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`DETALLE`, `RAZON`, `CODIGO`, `TOTAL`) VALUES
('Capital contable', 'Patrimonio', 31, 18),
('Efectivo y equivalente', 'Activo', 1101, 200),
('cuentas y Documentos por cobrar', 'Activo', 1102, 3),
('inventarios', 'Activo', 1104, 18),
('propiedad planta y equipo', 'Activo', 1201, 0),
('cuentas y Documentos por Pagar', 'Pasivo', 2101, 205),
('acreedores varios', 'Pasivo', 2104, 17),
('gastos de administracion', 'Gasto', 4201, 0),
('gastos Financieros', 'Gasto', 4455, 0),
('ventas', 'Ingreso', 5101, 73),
('prestamos', 'Activo', 11222, 0),
('comisiones y vacaciones', 'Gasto', 420103, 4),
('gastos Operativos', 'Gasto', 420105, 29);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`CODIGO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
