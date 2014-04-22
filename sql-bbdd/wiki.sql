-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2014 a las 03:04:43
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `wiki`
--
CREATE DATABASE IF NOT EXISTS `wiki` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wiki`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(1, 'CSS3'),
(2, 'HTML'),
(3, 'Frontend'),
(4, 'Backend'),
(5, 'PHP'),
(6, 'jQuery');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(30) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `perfil`) VALUES
(1, 'usuario'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `termino`
--

CREATE TABLE IF NOT EXISTS `termino` (
  `id_termino` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `cuerpo` text NOT NULL,
  `actualizacion` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_termino`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `termino`
--

INSERT INTO `termino` (`id_termino`, `titulo`, `cuerpo`, `actualizacion`, `id_categoria`) VALUES
(1, 'Patatas Fritas', 'Las patatas son unas plantas con tubérculos. Tempora quos consequuntur vero sint ut tempore dolores quia laboriosam maxime quibusdam esse doloremque temporibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora quos consequuntur vero sint ut tempore dolores quia laboriosam maxime quibusdam esse doloremque temporibus nobis doloribus voluptatibus ab ea illo itaque.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit nobis doloribus voluptatibus ab ea illo itaque.', 1397920035, 1),
(2, 'Dinamarca', 'No existe otro país que empiece por "Di" que no sea Dinamarca. A doloremque temporibus nobis doloribus voluptatibus ab ea illo itaque. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora quos consequuntur vero sint ut tempore dolores quia laboriosam maxime quibusdam esse. Tempora quos consequuntur vero sint ut tempore dolores quia laboriosam maxime quibusdam esse doloremque temporibus nobis doloribus. \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora quos consequuntur vero sint ut tempore dolores quia laboriosam maxime quibusdam esse doloremque temporibus nobis doloribus voluptatibus ab ea illo itaque. voluptatibus ab ea illo itaque.', 1397918431, 3),
(3, 'Teco Recoleto', 'Recoleto leto leto ecoleto leto. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora quos consequuntur vero sint ut tempore dolores quia laboriosam maxime quibusdam esse doloremque temporibus nobis doloribus voluptatibus ab ea illo itaque.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit.\r\n\r\nTempora quos consequuntur vero sint ut tempore dolores quia laboriosam maxime quibusdam esse doloremque temporibus nobis doloribus voluptatibus ab ea illo itaque.\r\n\r\nRatatapatan', 1397918645, 4),
(4, 'Maragato', 'Ostruspitas Maragato quos consequuntur vero sint ut tempore dolores quia laboriosam maxime quibusdam esse. Lorem ipsum.\r\n\r\nDolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora.\r\n\r\nA doloremque temporibus nobis doloribus voluptatibus ab ea illo itaque. Tempora quos consequuntur vero sint ut tempore dolores quia.\r\n\r\nAgil laboriosam maxime quibusdam esse doloremque temporibus nobis doloribus. \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora quos consequuntur vero sint ut tempore dolores quia laboriosam maxime quibusdam esse doloremque temporibus nobis doloribus voluptatibus ab ea illo itaque. voluptatibus ab ea illo itaque.', 0, 1),
(5, 'Resaca', 'Es el mar cuando te lleva padentro.', 1397920808, 2),
(6, 'Vampiro', 'Es quien te chupa la sangre.', 1397920926, 1),
(7, 'La frasca que te pare', 'public function crearTermino($data){\r\n        if(!isset($data["cuerpo"]) || !isset($data["titulo"]) || $data["cuerpo"]=="" || $data["titulo"]==""){\r\n            $_SESSION["feedback_negative"][] = "No tengo todos los datos a actualizar";\r\n            return false;\r\n        }\r\n        $data["titulo"] = strip_tags($data["titulo"]);\r\n        $data["cuerpo"] = strip_tags($data["cuerpo"]);\r\n        \r\n        $sql = "INSERT INTO termino (titulo, cuerpo, actualizacion) VALUES (:titulo, :cuerpo, :time)";\r\n        $query = $this->db->prepare($sql);\r\n        $query->bindValue(":time", time(), PDO::PARAM_INT);\r\n        $query->bindValue(":cuerpo", $data["cuerpo"], PDO::PARAM_STR);\r\n        $query->bindValue(":titulo", $data["titulo"], PDO::PARAM_STR);\r\n        $query->execute();\r\n        ', 1397932155, 5),
(8, 'cimborrio', 'que te la tu te a ti te da no lo que se te co sat lot a do. que te la tu te a ti te da no lo que se te co sat lot a do. que te la tu te a ti te da no lo que se te co sat lot a do. que te la tu te a\r\n\r\nTi te da no lo que se te co sat lot a do. que te la tu te a ti te da no lo que se te co sat lot a do. ', 1397921072, 3),
(9, 'Uno que mola', 'Dddsa sd sdf dsgf sdgdgv 1', 1397932809, 4),
(10, 'Seguro que me molas', 'Que me mola cantidad', 1397932780, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `marcador` bigint(20) NOT NULL,
  `token_recordarme` varchar(250) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `login`, `pass`, `nombre`, `id_perfil`, `marcador`, `token_recordarme`) VALUES
(1, 'miguel@desarrolloweb.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Miguel A Alvarez', 1, 216781394851371, 'c4be99126436fa4661ce8130b124d115f1ce659b161099976b1dd9c8d6b1a805'),
(2, 'sara@desarrolloweb.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Sara Alvarez', 1, 379901394849217, ''),
(3, 'yo@yo.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'dfddf', 2, 0, ''),
(4, 'tu@tu.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Juan Perogil', 1, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
