-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-11-2016 a las 16:16:21
-- Versión del servidor: 5.6.34
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `edicione_APPOjo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Operator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `text` text NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `title`, `content`, `text`, `type`, `image`, `description`) VALUES
(4, 'Login', '																																																																																																                                                                                                                                                                                                [{"name":"email","value":true},{"name":"Google","value":true,"appid":"dfdf","secret":"fdfdf"},{"name":"Facebook","value":true,"appid":"","secret":""},{"name":"twitter","value":false,"appid":"","secret":""},{"name":"instagram","value":true,"appid":"","secret":""}]                                                                                                                                                                																																																																																', '[{"name":"email","value":true},{"name":"Google","value":false,"appid":"","secret":""},{"name":"Facebook","value":false,"appid":"","secret":""},{"name":"twitter","value":false,"appid":"","secret":""},{"name":"instagram","value":false,"appid":"","secret":""}]', '2', '', '0'),
(5, 'Blogs', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                want Blog1222ttgsd                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', '[{"name":"cms","value":true},{"name":"wordpress","value":false,"appid":""},{"name":"tumblr","value":false,"appid":""}]', '1', '', '0'),
(6, 'Gallery', '																																								Gallery Content                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                																																', 'true', '3', '', '0'),
(7, 'Videos', '																									want Video Gallery                                                                                                                                                                                                																				', 'true', '3', '', '0'),
(8, 'Events', '										Event content  for evtn                                                                                                                                                                                                                                                                                           								', 'true', '3', '', '0'),
(11, 'Contact Us', 'Avenida 1 N° 5-55 Barrio Lleras Cúcuta', '595 0707', 'info@poderpaz.org', '', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d505629.78307586216!2d-72.75740116083952!3d8.077735676053113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e6658610c94c5b1%3A0x391041bbc8afbc3a!2sC%C3%BAcuta%2C+Norte+de+Santander!5e0!3m2!1ses-419!2sco!4v1478291998828" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'),
(12, 'Social Feeds', '0', '[{"name":"facebookappid","value":"https://www.facebook.com/PoderPaz-Corporaci%C3%B3n-Poder-Democracia-y-Paz-1046104455428172"},{"name":"twitterappid","value":"https://twitter.com/PODERPAZ_COL"},{"name":"instagramappid","value":"https://www.instagram.com/corpoderpazcomunicaciones"},{"name":"googleplusappid","value":"https://plus.google.com/"},{"name":"youtubeappid","value":"https://www.youtube.com/channel/UCt_J1uuqTo9_P6_KjjCK4HA"},{"name":"tumblrappid","value":"http://poderpaz.org"}]', '0', '', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linktype`
--

CREATE TABLE IF NOT EXISTS `linktype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `order` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `linktype`
--

INSERT INTO `linktype` (`id`, `name`, `status`, `order`, `link`) VALUES
(1, 'Inicio', '1', '', 'home'),
(2, 'Pagina', '1', '', 'article'),
(3, 'Evento', '1', '', 'eventdetail'),
(4, 'Lista de Eventos', '1', '', 'events'),
(5, 'Lista de Geleria de Imagenes', '1', '', 'photogallerycategory'),
(6, 'Galeria de Imagenes', '1', '', 'photogallery'),
(7, 'Lista de Galeria de Videos', '1', '', 'videogallerycategory'),
(8, 'Geleria de Videos', '1', '', 'videogallery'),
(9, 'Lista de Blogs', '1', '', 'blogs'),
(10, 'Blog', '1', '', 'blogdetail'),
(11, 'Redes Sociales', '1', '', 'social'),
(12, 'Contactanos', '1', '', 'contact'),
(13, 'Notificaciones', '1', '', 'notification'),
(14, 'Configuracion', '1', '', 'setting'),
(15, 'Perfil', '1', '', 'profile'),
(17, 'Link Externo', '0', '', ''),
(18, 'Ninguno', '0', '', ''),
(19, 'Municipios', '1', '19', 'municipios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `linktype` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Usuarios', '', '', 'site/viewusers', 1, 0, 1, 1, ''),
(2, 'Paginas', '', '', 'site/viewarticles', 1, 0, 1, 7, ''),
(3, 'Navegacion', '', '', 'site/viewfrontmenu', 1, 0, 1, 6, ''),
(4, 'Tablero', '', '', 'site/index', 1, 0, 1, 0, ''),
(5, 'Galeria de Imagenes', '', '', 'site/viewgallery', 1, 0, 1, 8, ''),
(6, 'Configuracion', '', '', 'site/viewconfig', 1, 0, 1, 12, ''),
(7, 'Galeria de Videos', '', '', 'site/viewvideogallery', 1, 0, 1, 9, ''),
(9, 'Eventos', '', '', 'site/viewevents', 1, 0, 1, 10, ''),
(12, 'Consultas', '', '', 'site/viewenquiry', 1, 0, 1, 11, ''),
(13, 'Notificaciones', '', '', 'site/viewnotification', 1, 0, 1, 4, ''),
(15, 'Blog', '', '', 'site/viewblog', 1, 0, 1, 5, ''),
(18, 'Slider', '', '', 'site/viewslider', 1, 0, 1, 3, ''),
(19, 'Inicio', '', '', 'site/home?id=1', 1, 0, 1, 2, ''),
(20, 'Buscar', 'Buscar Municipios', 'buscar', 'site/viewmunicipios', 1, 0, 1, 13, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(4, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificationtoken`
--

CREATE TABLE IF NOT EXISTS `notificationtoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `alt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `slider`
--

INSERT INTO `slider` (`id`, `image`, `order`, `status`, `alt`) VALUES
(1, 'lupa.jpg', 1, 1, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Enable'),
(2, 'Disable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Text'),
(2, 'File');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `socialid` varchar(255) NOT NULL,
  `logintype` varchar(255) NOT NULL,
  `json` text NOT NULL,
  `dob` date DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `google` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `instagram` int(11) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `eventnotification` varchar(50) NOT NULL,
  `photonotification` varchar(50) NOT NULL,
  `videonotification` varchar(50) NOT NULL,
  `blognotification` varchar(50) NOT NULL,
  `coverimage` varchar(255) NOT NULL,
  `forgotpassword` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact`, `eventnotification`, `photonotification`, `videonotification`, `blognotification`, `coverimage`, `forgotpassword`) VALUES
(1, 'Admin', '0192023a7bbd73250516f069df18b500', 'admin@admin.com', 1, '2015-10-02 06:05:05', 1, '', '', '', '', '', NULL, NULL, 'Sion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '9896251463', 'false', 'true', 'false', 'true', '', ''),
(2, 'Jorge Botello', 'aca81a817965c29d211ceec7c9934754', 'jbotelloangarita@hotmail.com', 3, '2016-11-03 22:14:58', NULL, NULL, '', '', 'Email', '', '1992-11-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 'false', 'false', 'false', 'false', '', ''),
(3, 'Syrus', 'b1892776ecb63cde4994bbe054644407', 'syruspacheco@gmail.com', 3, '2016-11-03 22:35:00', NULL, NULL, '', '', 'Email', '', '1993-02-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 'false', 'false', 'false', 'false', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_articles`
--

CREATE TABLE IF NOT EXISTS `webapp_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `json` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `webapp_articles`
--

INSERT INTO `webapp_articles` (`id`, `status`, `title`, `json`, `content`, `timestamp`, `image`) VALUES
(1, 1, 'Home', '0', '<p style="text-align: justify;">Ojo Ciudadano es una aplicacion de la corporacion poder paz encargada de realizar denuncias ciudadanas .&nbsp;</p>\n<p style="text-align: justify;">La denuncia, como dato que informa respecto de la presunta comisi&oacute;n de un hecho delictivo, tiene como esencial efecto, el de movilizar al &oacute;rgano competente para que inicie las investigaciones preliminares para constatar, en primer lugar, la realizaci&oacute;n de un hecho il&iacute;cito, y en segundo lugar, su presunto autor. En muchos pa&iacute;ses el &oacute;rgano competente para conocer en primer lugar la comisi&oacute;n de un fen&oacute;meno antijur&iacute;dico lo constituye la polic&iacute;a. Sin embargo, cuando se trata de denuncias de oficio, le corresponde al representante del Ministerio P&uacute;blico, en su calidad de defensor de la sociedad, asumir la responsabilidad de la investigaci&oacute;n de los hechos que son materia de una denuncia. En Espa&ntilde;a le corresponde al Ministerio Fiscal, aunque tambi&eacute;n las denuncias pueden interponerse ante un &Oacute;rgano Jurisdiccional.</p>', '2016-11-05 14:45:40', ''),
(2, 1, 'Quiénes Somos', '0', '<p>La Corporaci&oacute;n Construyendo Poder, Democracia y Paz PODERPAZ es un ONG que promueve la participaci&oacute;n pol&iacute;tica de todos los sectores sociales y populares del Departamento Norte de Santander. Tiene como objetivo desarrollar procesos educativos alrededor de la participaci&oacute;n y veedur&iacute;a ciudadana, adem&aacute;s la Corporaci&oacute;n PODERPAZ apoya, impulsa y promueve los procesos organizativos del Departamento, desarrollando talleres con el enfoque en educaci&oacute;n popular y con jornadas de asesor&iacute;a jur&iacute;dica.</p>', '2015-10-09 22:17:20', 'Quienes_Somos.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_blog`
--

CREATE TABLE IF NOT EXISTS `webapp_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `json` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `webapp_blog`
--

INSERT INTO `webapp_blog` (`id`, `title`, `json`, `content`, `timestamp`, `image`) VALUES
(1, 'Lorem Ipsum is simply dummy text', '0', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2015-10-09 22:12:36', 'cover4.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_blogimages`
--

CREATE TABLE IF NOT EXISTS `webapp_blogimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_blogvideo`
--

CREATE TABLE IF NOT EXISTS `webapp_blogvideo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `video` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_enquiry`
--

CREATE TABLE IF NOT EXISTS `webapp_enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_eventimages`
--

CREATE TABLE IF NOT EXISTS `webapp_eventimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_events`
--

CREATE TABLE IF NOT EXISTS `webapp_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `starttime` time NOT NULL,
  `venue` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `webapp_events`
--

INSERT INTO `webapp_events` (`id`, `status`, `title`, `timestamp`, `content`, `image`, `startdate`, `starttime`, `venue`) VALUES
(1, 1, 'Demo Event', '2015-10-09 22:26:12', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'cover8.jpg', '2015-10-22', '00:00:01', 'Colombia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_eventvideo`
--

CREATE TABLE IF NOT EXISTS `webapp_eventvideo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` int(11) NOT NULL,
  `videogallery` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_frontmenu`
--

CREATE TABLE IF NOT EXISTS `webapp_frontmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `json` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `linktype` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `event` varchar(255) NOT NULL,
  `blog` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `article` varchar(255) NOT NULL,
  `gallery` varchar(255) NOT NULL,
  `typeid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `webapp_frontmenu`
--

INSERT INTO `webapp_frontmenu` (`id`, `order`, `parent`, `status`, `name`, `json`, `image`, `linktype`, `icon`, `event`, `blog`, `video`, `article`, `gallery`, `typeid`) VALUES
(1, 1, 0, 1, 'Inicio', '0', 'cover6.jpg', '1', 'ln-home3', '', '', '1', '', '', '0'),
(2, 2, 0, 2, 'Notificacion', '0', '', '13', 'ln-bell', '', '', '1', '', '', '0'),
(3, 3, 0, 1, 'Tu Municipio', '0', '', '19', 'ln-book-closed', '', '', '1', '', '', '0'),
(4, 4, 0, 1, 'Quiénes Somos', '0', '', '2', 'ln-teacup', '', '', '1', '2', '', '0'),
(5, 0, 0, 2, 'Galeria Imagen', '0', '', '5', 'ln-file-image', '', '', '1', '', '', '0'),
(6, 2, 0, 1, 'Videos', '0', '', '7', 'ln-film-play', '', '', '1', '', '', '0'),
(7, 0, 0, 2, 'Evento', '0', '', '4', 'ln-calendar3', '', '', '1', '', '', '0'),
(8, 7, 0, 1, 'Siguenos', '0', '', '11', 'ln-share3', '', '', '1', '', '', '0'),
(9, 8, 0, 1, 'Mi Perfil', '0', '', '15', 'ln-profile', '', '', '1', '', '', '0'),
(10, 0, 0, 2, 'Configuracion', '0', '', '14', 'ln-gear2', '', '', '1', '', '', '0'),
(11, 6, 0, 1, 'Contáctenos', '0', '', '12', 'ln-phone2', '', '', '1', '', '', '0'),
(12, 5, 0, 1, 'Denuncias', '0', '', '12', 'ln-aim', '', '', '1', '', '', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_gallery`
--

CREATE TABLE IF NOT EXISTS `webapp_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `json` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `webapp_gallery`
--

INSERT INTO `webapp_gallery` (`id`, `order`, `status`, `name`, `json`, `timestamp`, `image`) VALUES
(1, 0, 1, 'Demo', '0', '2015-10-09 22:20:10', 'cover6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_galleryimage`
--

CREATE TABLE IF NOT EXISTS `webapp_galleryimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `webapp_galleryimage`
--

INSERT INTO `webapp_galleryimage` (`id`, `gallery`, `order`, `status`, `image`, `alt`) VALUES
(1, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(2, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(3, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(4, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(5, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(6, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(7, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(8, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(9, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(10, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(11, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(12, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(13, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(14, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(15, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(16, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(17, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(18, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(19, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(20, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(21, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(22, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(23, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(24, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(25, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(26, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(27, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(28, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(29, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(30, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(31, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(32, 1, 1, 1, 'cover7.jpg', 'Demo image'),
(33, 1, 1, 1, 'cover7.jpg', 'Demo image');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_municipios`
--

CREATE TABLE IF NOT EXISTS `webapp_municipios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `webapp_municipios`
--

INSERT INTO `webapp_municipios` (`id`, `name`, `blog_id`, `isactive`) VALUES
(1, 'Cúcuta', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_notification`
--

CREATE TABLE IF NOT EXISTS `webapp_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `linktype` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `gallery` varchar(255) NOT NULL,
  `blog` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `webapp_notification`
--

INSERT INTO `webapp_notification` (`id`, `event`, `article`, `status`, `image`, `timestamp`, `content`, `link`, `linktype`, `video`, `gallery`, `blog`) VALUES
(1, 0, 0, 1, 'cover3.jpg', '2015-10-09 22:12:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '', '1', '', '', ''),
(2, 0, 0, 1, '', '2015-10-09 22:39:14', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s.', 'codecanyon.net/', '17', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_notificationuser`
--

CREATE TABLE IF NOT EXISTS `webapp_notificationuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `timestamp_receive` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_videogallery`
--

CREATE TABLE IF NOT EXISTS `webapp_videogallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `json` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `subtitle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `webapp_videogallery`
--

INSERT INTO `webapp_videogallery` (`id`, `order`, `status`, `name`, `json`, `timestamp`, `subtitle`) VALUES
(1, 1, 1, 'Video 1', '0', '2015-10-09 22:21:02', 'Video 1'),
(2, 2, 1, 'Video 2', '0', '2016-11-05 14:29:24', 'Video 2'),
(3, 3, 1, 'Video 3', '0', '2016-11-05 14:30:24', 'Video 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webapp_videogalleryvideo`
--

CREATE TABLE IF NOT EXISTS `webapp_videogalleryvideo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `videogallery` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `alt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `webapp_videogalleryvideo`
--

INSERT INTO `webapp_videogalleryvideo` (`id`, `order`, `status`, `videogallery`, `url`, `alt`) VALUES
(5, 1, 1, 1, 'KuPgpRwmY4M', 'Video1'),
(6, 1, 1, 2, 'hq52uQ58ZPM', 'Video 2'),
(7, 1, 1, 3, 'v_BeUehTdxg', 'Video 3');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `webapp_municipios`
--
ALTER TABLE `webapp_municipios`
  ADD CONSTRAINT `webapp_municipios_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `webapp_blog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
