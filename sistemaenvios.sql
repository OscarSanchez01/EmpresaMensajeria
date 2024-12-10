-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2024 a las 02:11:29
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
-- Base de datos: `sistemaenvios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas_reparto`
--

CREATE TABLE `empresas_reparto` (
  `id_empresa` int(11) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas_reparto`
--

INSERT INTO `empresas_reparto` (`id_empresa`, `nombre_empresa`, `telefono`, `contacto`) VALUES
(1, 'FastTrack Logistics', '1234567890', 'John Doe'),
(2, 'Express Couriers', '2345678901', 'Jane Smith'),
(3, 'Global Shippers', '3456789012', 'Michael Johnson'),
(4, 'Urban Delivery Co.', '4567890123', 'Laura Wilson'),
(5, 'Rural Connect', '5678901234', 'Chris Martin'),
(6, 'EcoGreen Express', '6789012345', 'Sophia Brown'),
(7, 'Speedy Solutions', '7890123456', 'James Anderson'),
(8, 'NextDay Transport', '8901234567', 'Emily Davis'),
(9, 'Secure Parcel', '9012345678', 'David Garcia'),
(10, 'AirWave Couriers', '0123456789', 'Emma Rodriguez'),
(11, 'Maritime Movers', '0987654321', 'Olivia Martinez'),
(12, 'LocalLink Delivery', '8765432109', 'Noah Hernandez'),
(13, 'Priority Transport', '7654321098', 'Ava Clark'),
(14, 'GlobalReach Express', '6543210987', 'Liam Lewis'),
(15, 'CityWide Couriers', '5432109876', 'Mia Walker'),
(16, 'QuickShip Logistics', '4321098765', 'Ethan Young'),
(17, 'Rapid Dispatch', '3210987654', 'Isabella Hall'),
(18, 'Overland Freight', '2109876543', 'Mason Allen'),
(19, 'Swift Parcel', '1098765432', 'Lucas Scott'),
(20, 'Trusty Transport', '1987654321', 'Amelia Green'),
(21, 'Courier Central', '2876543210', 'Elijah Adams'),
(22, 'National Carriers', '3765432109', 'Harper Hill'),
(23, 'Reliable Express', '4654321098', 'Logan Baker'),
(24, 'Efficient Logistics', '5543210987', 'Charlotte Mitchell'),
(25, 'OnDemand Delivery', '6432109876', 'Oliver Perez'),
(26, 'ParcelConnect', '7321098765', 'Zoe Carter'),
(27, 'CrossCountry Movers', '8210987654', 'Henry Phillips'),
(28, 'AllDay Shipping', '9109876543', 'Benjamin Turner'),
(29, 'Regional Dispatch', '0098765432', 'Ella Parker'),
(30, 'Worldwide Express', '0198765432', 'Alexander Ramirez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `cod_seguimiento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `estado_envio` varchar(50) NOT NULL,
  `fecha_envio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`cod_seguimiento`, `id_usuario`, `id_empresa`, `estado_envio`, `fecha_envio`) VALUES
(1, 1, 1, 'En tránsito', '2024-12-01'),
(2, 2, 2, 'Pendiente', '2024-12-02'),
(3, 3, 3, 'Entregado', '2024-11-30'),
(4, 4, 4, 'En tránsito', '2024-12-03'),
(5, 5, 5, 'Entregado', '2024-11-29'),
(6, 6, 6, 'Pendiente', '2024-12-01'),
(7, 7, 7, 'En espera', '2024-12-02'),
(8, 8, 8, 'Entregado', '2024-11-28'),
(9, 9, 9, 'En tránsito', '2024-12-03'),
(10, 10, 10, 'Pendiente', '2024-12-01'),
(11, 11, 11, 'Entregado', '2024-11-30'),
(12, 12, 12, 'En tránsito', '2024-12-02'),
(13, 13, 13, 'Pendiente', '2024-12-01'),
(14, 14, 14, 'En espera', '2024-12-03'),
(15, 15, 15, 'Entregado', '2024-11-27'),
(16, 16, 16, 'En tránsito', '2024-12-01'),
(17, 17, 17, 'Pendiente', '2024-12-02'),
(18, 18, 18, 'Entregado', '2024-11-29'),
(19, 19, 19, 'En espera', '2024-12-03'),
(20, 20, 20, 'Pendiente', '2024-12-02'),
(21, 21, 21, 'Entregado', '2024-11-30'),
(22, 22, 22, 'En tránsito', '2024-12-01'),
(23, 23, 23, 'Pendiente', '2024-12-02'),
(24, 24, 24, 'En espera', '2024-12-03'),
(25, 25, 25, 'Entregado', '2024-11-28'),
(26, 26, 26, 'En tránsito', '2024-12-02'),
(27, 27, 27, 'Pendiente', '2024-12-01'),
(28, 28, 28, 'Entregado', '2024-11-30'),
(29, 29, 29, 'En tránsito', '2024-12-03'),
(30, 30, 30, 'En espera', '2024-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `id_paquete` int(11) NOT NULL,
  `cod_seguimiento` int(11) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `dimensiones` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id_paquete`, `cod_seguimiento`, `peso`, `dimensiones`, `descripcion`) VALUES
(1, 1, 2.50, '30x20x10', 'Electrónica: laptop'),
(2, 2, 1.00, '15x10x5', 'Documentos legales'),
(3, 3, 10.00, '50x40x30', 'Ropa: abrigos'),
(4, 4, 7.50, '40x30x20', 'Electrodomésticos: cafetera'),
(5, 5, 12.30, '60x50x40', 'Muebles: silla de oficina'),
(6, 6, 0.80, '20x15x10', 'Libros: novela y manual'),
(7, 7, 3.00, '25x20x15', 'Accesorios deportivos: raquetas'),
(8, 8, 5.20, '35x25x20', 'Juguetes: set de construcción'),
(9, 9, 6.70, '45x35x25', 'Equipos electrónicos: altavoces'),
(10, 10, 8.90, '55x45x35', 'Decoración: lámpara de mesa'),
(11, 11, 1.50, '20x15x10', 'Cosméticos y cuidado personal'),
(12, 12, 4.40, '30x25x15', 'Herramientas: taladro'),
(13, 13, 9.00, '60x40x40', 'Electrónica: monitor'),
(14, 14, 2.30, '25x15x10', 'Ropa: camisetas y jeans'),
(15, 15, 3.50, '30x20x15', 'Libros de texto'),
(16, 16, 5.50, '40x30x20', 'Electrodomésticos: tostadora'),
(17, 17, 7.00, '50x40x30', 'Juguetes: rompecabezas'),
(18, 18, 11.80, '70x50x40', 'Equipos electrónicos: impresora'),
(19, 19, 2.70, '30x20x10', 'Accesorios de moda'),
(20, 20, 6.00, '45x35x25', 'Ropa: vestidos y abrigos'),
(21, 21, 4.30, '35x25x20', 'Decoración de hogar: cuadros'),
(22, 22, 5.80, '40x30x20', 'Juguetes: vehículos a control remoto'),
(23, 23, 1.20, '15x10x5', 'Electrónica: audífonos'),
(24, 24, 7.50, '50x40x30', 'Electrodomésticos: plancha'),
(25, 25, 9.30, '60x50x40', 'Muebles: mesa pequeña'),
(26, 26, 3.00, '25x20x15', 'Accesorios deportivos: balón de fútbol'),
(27, 27, 8.00, '55x45x35', 'Decoración: macetas de cerámica'),
(28, 28, 6.20, '45x35x25', 'Herramientas: set de destornilladores'),
(29, 29, 2.00, '20x15x10', 'Electrónica: cargador portátil'),
(30, 30, 4.50, '30x25x15', 'Juguetes: figuras coleccionables');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','user') NOT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`, `rol`, `mail`, `direccion`) VALUES
(1, 'admin', '1234', 'admin', NULL, NULL),
(2, 'user', '1234', 'user', NULL, NULL),
(3, 'Oscar', '1234', '', 'sannananana@gmail.com', 'calle granvia'),
(4, 'jdoe', 'password123', 'user', 'jdoe@example.com', '123 Elm St'),
(5, 'asmith', 'securepass', 'user', 'asmith@example.com', '456 Oak Ave'),
(6, 'mjones', 'mypassword', 'user', 'mjones@example.com', '789 Pine Rd'),
(7, 'kharris', 'pass789', 'user', 'kharris@example.com', '234 Cedar Blvd'),
(8, 'lwilson', 'letmein', 'user', 'lwilson@example.com', '567 Spruce Dr'),
(9, 'jbrown', 'mypassword1', 'user', 'jbrown@example.com', '890 Birch Ln'),
(10, 'dsmith', 'abc123', 'user', 'dsmith@example.com', '111 Maple St'),
(11, 'eclark', 'secureme', 'user', 'eclark@example.com', '222 Willow Way'),
(12, 'hgreen', 'greenpass', 'user', 'hgreen@example.com', '333 Ash Rd'),
(13, 'jwhite', 'myp@ssw0rd', 'user', 'jwhite@example.com', '444 Poplar Ave'),
(14, 'pmiller', 'password456', 'user', 'pmiller@example.com', '555 Beech Ct'),
(15, 'rnash', 'secure123', 'user', 'rnash@example.com', '666 Cherry Pl'),
(16, 'tlopez', 'hello123', 'user', 'tlopez@example.com', '777 Pine View'),
(17, 'xgarcia', 'mypass123', 'user', 'xgarcia@example.com', '888 Redwood Blvd'),
(18, 'lmartinez', 'admin456', 'user', 'lmartinez@example.com', '999 Elm Grove'),
(19, 'bwatson', 'welcome1', 'user', 'bwatson@example.com', '123 Palm Rd'),
(20, 'cstewart', 'qwerty12', 'user', 'cstewart@example.com', '456 Maple Ave'),
(21, 'fcooper', 'secure22', 'user', 'fcooper@example.com', '789 Cypress St'),
(22, 'mmurray', 'mypass44', 'user', 'mmurray@example.com', '101 Maple Blvd'),
(23, 'oparker', 'password55', 'user', 'oparker@example.com', '202 Walnut Dr'),
(24, 'qgray', 'safe1234', 'user', 'qgray@example.com', '303 Cedar Grove'),
(25, 'erobinson', '123qwert', 'user', 'erobinson@example.com', '404 Willow Blvd'),
(26, 'vjackson', 'admin789', 'user', 'vjackson@example.com', '505 Spruce Dr'),
(27, 'ytaylor', 'mypa$$', 'user', 'ytaylor@example.com', '606 Beech Way'),
(28, 'ufisher', 'letmein33', 'user', 'ufisher@example.com', '707 Redwood Grove'),
(29, 'wrobinson', 'password88', 'user', 'wrobinson@example.com', '808 Pine Grove'),
(30, 'final_user', 'finalpass', 'user', 'final@example.com', '30th Address St');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresas_reparto`
--
ALTER TABLE `empresas_reparto`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`cod_seguimiento`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `cod_seguimiento` (`cod_seguimiento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas_reparto`
--
ALTER TABLE `empresas_reparto`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `cod_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `envios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `envios_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `empresas_reparto` (`id_empresa`);

--
-- Filtros para la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD CONSTRAINT `paquetes_ibfk_1` FOREIGN KEY (`cod_seguimiento`) REFERENCES `envios` (`cod_seguimiento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
