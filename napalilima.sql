-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Neděle 23. září 2012, 20:27
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
-- Struktura tabulky `claims`
--

CREATE TABLE IF NOT EXISTS `claims` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_u` int(5) NOT NULL,
  `claim_date` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `claim_at` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `claim` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `claims`
--

INSERT INTO `claims` (`id`, `id_u`, `claim_date`, `claim_at`, `claim`) VALUES
(1, 0, '21.09.2012', 'asdasdasdas', 'sdasdasdasdas');

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_u` int(5) NOT NULL,
  `id_s` int(5) NOT NULL,
  `comment` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

--
-- Vypisuji data pro tabulku `comments`
--


-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pass` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `nick` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `date` varchar(12) COLLATE utf8_czech_ci NOT NULL,
  `ip` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `pass`, `nick`, `email`, `date`, `ip`) VALUES
(1, 'asdasd', 'asdas', 'asdasddasd', '23.09.2012', '127.0.0.1'),
(2, 'gfhfhfg', 'ghghfgh', 'hgfghfghfg', '23.09.2012', '127.0.0.1'),
(3, 'andy', 'andy', 'a.majik7@gmail.com', '23.09.2012', '127.0.0.1');
