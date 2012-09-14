-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Pátek 14. září 2012, 14:55
-- Verze MySQL: 5.1.53
-- Verze PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `napalilima`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_staznosti` int(11) NOT NULL,
  `comment` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `comments`
--

INSERT INTO `comments` (`id`, `id_staznosti`, `comment`) VALUES
(1, 17, 'komentar'),
(2, 18, 'komentar');

-- --------------------------------------------------------

--
-- Struktura tabulky `staznosti`
--

CREATE TABLE IF NOT EXISTS `staznosti` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nick` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `staznost_kedy` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `staznost_na` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `staznost` varchar(1024) COLLATE utf8_czech_ci NOT NULL,
  `datum_staznost` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(15) COLLATE utf8_czech_ci NOT NULL,
  `browser` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=19 ;

--
-- Vypisuji data pro tabulku `staznosti`
--

INSERT INTO `staznosti` (`id`, `nick`, `email`, `staznost_kedy`, `staznost_na`, `staznost`, `datum_staznost`, `ip`, `browser`) VALUES
(17, 'sdasd', 'asdasd', 'asdasd', 'sdad', 'asdasd', '2012-09-14 15:41:09', '127.0.0.1', 'browser'),
(3, 'sadasd', 'sdasd', 'sdasda', 'dasdasdas', 'sdasdas', '2012-09-01 11:14:31', '127.0.0.1', 'browser'),
(4, 'asdas', 'dasda', 'dasdas', 'asdasdad', 'asdasdas', '2012-09-01 11:14:36', '127.0.0.1', 'browser'),
(5, 'asdas', 'dasda', 'dasdas', 'asdasdad', 'asdasdas', '2012-09-01 11:14:44', '127.0.0.1', 'browser'),
(6, 'asdas', 'dasda', 'dasdas', 'asdasdad', 'asdasdas', '2012-09-01 11:22:09', '127.0.0.1', 'browser'),
(7, 'asdas', 'dasda', 'dasdas', 'asdasdad', 'asdasdas', '2012-09-01 11:22:50', '127.0.0.1', 'browser'),
(8, 'asdas', 'dasda', 'dasdas', 'asdasdad', 'asdasdas', '2012-09-01 11:25:58', '127.0.0.1', 'browser'),
(9, 'asdas', 'dasda', 'dasdas', 'asdasdad', 'asdasdas', '2012-09-01 11:28:11', '127.0.0.1', 'browser'),
(10, 'asdas', 'dasda', 'dasdas', 'asdasdad', 'asdasdas', '2012-09-01 11:28:33', '127.0.0.1', 'browser'),
(11, 'asdas', 'dasda', 'dasdas', 'asdasdad', 'asdasdas', '2012-09-01 11:38:04', '127.0.0.1', 'browser'),
(12, 'asdasd', 'dasd', 'dasdsa', 'asda', 'adas', '2012-09-01 12:44:19', '127.0.0.1', 'browser'),
(13, 'sadasd', 'asda', 'asdasd', 'andy', 'neviem', '2012-09-01 12:46:22', '127.0.0.1', 'browser'),
(14, 'sdfsdfs', 'sdfsdfsdf', 'fsdf', 'sdfs', 'sdfsdf', '2012-09-01 12:47:29', '127.0.0.1', 'browser'),
(15, 'dfsdfs', 'sfsdfs', 'sdfsdf', 'dfsdf', 'fsdfsd', '2012-09-01 12:47:46', '127.0.0.1', 'browser'),
(16, 'andy', 'lolofon', 'andy', 'andy', 'staznost', '2012-09-01 16:34:33', '127.0.0.1', 'browser'),
(18, 'sdf', 'sdfsd', 'sdfsd', 'fsdfsdf', 'dfsd', '2012-09-14 15:54:21', '127.0.0.1', 'browser');
