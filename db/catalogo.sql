-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2024 at 06:25 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catalogo`
--
CREATE DATABASE IF NOT EXISTS `catalogo`;
USE `catalogo`;

-- --------------------------------------------------------

--
-- Table structure for table `t_clientes`
--

CREATE TABLE `t_clientes` (
  `cliente_id` int NOT NULL,
  `cliente_nombre` varchar(200) NOT NULL,
  `cliente_apellidos` varchar(200) NOT NULL,
  `cliente_telefono` varchar(100) NOT NULL,
  `cliente_direccion` text NOT NULL,
  `cliente_email` varchar(200) NOT NULL,
  `cliente_pass` text NOT NULL
) ENGINE=InnoDB;

--
-- Dumping data for table `t_clientes`
--

INSERT INTO `t_clientes` (`cliente_id`, `cliente_nombre`, `cliente_apellidos`, `cliente_telefono`, `cliente_direccion`, `cliente_email`, `cliente_pass`) VALUES
(1, 'Misael', 'Juarez Aguilar', '5591055427', 'Av de la cruz', 'misael2745@gmail.com', '$2y$10$I4JyKKMlqRbobGNd09WhpeICYKE35.OM2LtAbaGJHz4SLWZhMgwnm');

-- --------------------------------------------------------

--
-- Table structure for table `t_pedidos`
--

CREATE TABLE `t_pedidos` (
  `pedido_id` int NOT NULL,
  `pedido_cantidad` int NOT NULL,
  `id_cliente` int NOT NULL,
  `id_producto` int NOT NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `t_productos`
--

CREATE TABLE `t_productos` (
  `producto_id` int NOT NULL,
  `producto_url` text NOT NULL,
  `producto_nombre` varchar(200) NOT NULL,
  `producto_precio` float NOT NULL,
  `producto_categoria` varchar(200) NOT NULL
) ENGINE=InnoDB;

--
-- Dumping data for table `t_productos`
--

INSERT INTO `t_productos` (`producto_id`, `producto_url`, `producto_nombre`, `producto_precio`, `producto_categoria`) VALUES
(1, 'https://azaphran.com/cdn/shop/products/crema-antiedad-rosa-mosqueta_400x.png?v=1478318456', 'Crema antiedad', 400, 'manos'),
(3, 'https://azaphran.com/cdn/shop/products/Polvo-m-1_400x.png?v=1542677633', 'Polvo Matificante', 200, 'rostro'),
(4, 'https://azaphran.com/cdn/shop/products/shampoo-purificantecopia_400x.jpg?v=1628283341', 'Shampoo Citricos', 189, 'cabello'),
(5, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcTOFxwAdky8ymMuOmWUis5UGWnx693jXjSE1Cr3FoGa2NZrscRy9rrA2zpAfvjIOgkSZDsSvggoYzDXDXf2T4qBdF24wDRHoVYlDsyWa6mBX7hRBR2vMMS7pptIhU88QBAR8OMj7OGlAQ&usqp=CAc', 'Crema Facial', 70, 'rostro'),
(6, 'https://m.media-amazon.com/images/I/61hmirNEiWL._AC_SX679_.jpg', 'eGo Gel Black', 66, 'cabello'),
(7, 'https://m.media-amazon.com/images/I/71bFicpmR6L._AC_SX679_.jpg', 'Jabón Dove en Barra', 60, 'rostro'),
(8, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcQPu5gb_7FzxuVaVut5ycNRQGbRarcxwfIBKmWBRRxudSHdAbPlePAkSy510Aed08Cf00GMUPIsuCFRjXTXt061emma8CbWGbqbMpxQbrbE_6qCnqcBvRwhFIeBAE17Lr_5BxUxIHVwgw&usqp=CAc', 'Vaseline', 50, 'pies'),
(9, 'https://m.media-amazon.com/images/I/619VrmgXYEL._AC_SX679_.jpg', 'Desodorante para pies Rexona', 64, 'pies'),
(10, 'https://m.media-amazon.com/images/I/61AfFs+fbTL._AC_SX679_.jpg', 'NaturalDry Desodorante para PIES', 130, 'pies'),
(11, 'https://m.media-amazon.com/images/I/51-eOXst+iL._AC_SY300_SX300_.jpg', 'CeraVe Crema Hidratante Diaria', 247, 'manos'),
(12, 'https://m.media-amazon.com/images/I/71M7+85ZzGL._AC_SX679_.jpg', 'Eucerin Advanced Repair', 412, 'manos'),
(13, 'https://m.media-amazon.com/images/I/61Rm1r3brFL._AC_SX522_.jpg', 'KÉRASTASE Masque Thérapiste ', 1214, 'cabello'),
(14, 'https://m.media-amazon.com/images/I/51R-VS4++KL._AC_SX522_.jpg', 'Hair Mask Karseell Collagen 16.9 OZ 500ml', 500, 'rostro'),
(15, 'https://m.media-amazon.com/images/I/518xB98WgjL._AC_SX679_.jpg', 'Pantene Tratamiento Capilar Pro-V', 56, 'cabello');

-- --------------------------------------------------------

--
-- Table structure for table `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `usuario_id` int NOT NULL,
  `usuario_nombre` varchar(200) NOT NULL,
  `usuauri_apellidos` varchar(200) NOT NULL,
  `usuario_usuario` varchar(200) NOT NULL,
  `usuario_pass` text NOT NULL
) ENGINE=InnoDB;

--
-- Dumping data for table `t_usuarios`
--

INSERT INTO `t_usuarios` (`usuario_id`, `usuario_nombre`, `usuauri_apellidos`, `usuario_usuario`, `usuario_pass`) VALUES
(1, 'karla', 'Guzman Gomez', 'elisa', '$2y$10$uXCllsOyP//PnT6TsQ2jr.hmvhO8k5cd2X0AovrE/yo6f6uo.ttfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_clientes`
--
ALTER TABLE `t_clientes`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indexes for table `t_pedidos`
--
ALTER TABLE `t_pedidos`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `t_productos`
--
ALTER TABLE `t_productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indexes for table `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_clientes`
--
ALTER TABLE `t_clientes`
  MODIFY `cliente_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_pedidos`
--
ALTER TABLE `t_pedidos`
  MODIFY `pedido_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_productos`
--
ALTER TABLE `t_productos`
  MODIFY `producto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_pedidos`
--
ALTER TABLE `t_pedidos`
  ADD CONSTRAINT `t_pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `t_clientes` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `t_productos` (`producto_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
