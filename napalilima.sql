-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Pátek 31. srpna 2012, 21:37
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

--
-- Vypisuji data pro tabulku `staznosti`
--

