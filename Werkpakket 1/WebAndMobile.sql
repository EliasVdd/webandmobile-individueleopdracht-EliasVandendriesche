-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 20 sep 2018 om 08:11
-- Serverversie: 5.7.23-0ubuntu0.16.04.1
-- PHP-versie: 7.2.9-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebAndMobile`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Messages`
--

CREATE TABLE `Messages` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Messages`
--

INSERT INTO `Messages` (`id`, `content`, `category`, `upvotes`, `downvotes`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit.', 'Hardware', 2, 4),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit.', 'Angular', 5, 1),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit.', 'Angular', 10, 0),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit.', 'React', 2, 5),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit.', 'Hardware', 3, 0),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit.', 'React', 0, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Messages`
--
ALTER TABLE `Messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
