-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 10. Okt 2016 um 10:43
-- Server Version: 5.5.35
-- PHP-Version: 5.5.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `loremipsum-pizza`
--

--
-- Daten für Tabelle `tbl_benutzer`
--

INSERT INTO `tbl_benutzer` (`ID`, `benutzername`, `hash`) VALUES
(1, 'testuser', '8093ea3ad9f16b1b1f064464dd4caf19');

--
-- Daten für Tabelle `tbl_kategorie`
--

INSERT INTO `tbl_kategorie` (`ID`, `bezeichnung`, `beschreibung`, `aktiv_flag`, `reihenfolge`) VALUES
(1, 'Pizza', 'Unsere feinen Pizzen werden mit liebe Zubereitet und im Feuer des ewigen Verdammnis ausgebacken.', 1, NULL),
(2, 'Getränke', 'Wir bringen Ihnen gekühlte Getränke und auf Anfrage auch Becher.', 1, NULL),
(3, 'Salate', 'Unsere hausgemachten Salate werden Ihnen schmecken!', 1, NULL);

--
-- Daten für Tabelle `tbl_produkte`
--

INSERT INTO `tbl_produkte` (`ID`, `bezeichnung`, `beschreibung`, `groesse`, `preis`, `aktiv_flag`, `fk_kategorie`, `aktions_flag`, `aktions_preis`) VALUES
(1, 'Margherita', 'Tomate, Mozzarella, Oregano', 'Ø 30cm', 20, 1, 1, 0, 0),
(2, 'Prosciutto', 'Tomate, Mozzarella, Vorderschinken, Oregano', 'Ø 30cm', 22, 1, 1, 0, 0),
(3, 'Coca Cola', NULL, '0.5 L', 4, 1, 2, 0, 0),
(4, 'Coca Cola', NULL, '1.0 L', 7, 1, 2, 0, 0),
(7, 'Caprese Salat', 'Feiner Salat bestehend aus Tomaten und Mozarella', '200 g', 7.5, 1, 3, 0, 7),
(8, 'Gemischter Salat', 'verschiedene Salate mit verschiedenen Saucen', '200 g', 10.5, 1, 3, 1, 9),
(13, 'Diavolo', 'Tomaten, Mozarella, Scharfe Salami', 'Ø 30cm', 22, 1, 1, 0, 21),
(16, 'Quattro Stagioni', 'Tomaten, Mozarella, Vorderschinken, Artischocken', 'Ø 30cm', 22, 1, 1, 0, 21),
(18, 'Prosciutto Funghi', 'Tomaten, Mozarella, Vorderschinken, Champignos, Oregano', 'Ø 30cm', 22, 1, 1, 0, 21),
(19, 'Blattsalat', 'Ein feiner Blattsalat', '200 g', 7, 1, 3, 0, 6),
(20, 'Chef', 'Pizza nach Tageslaune des Chefkochs', 'Ø 30cm', 22, 1, 1, 0, 20),
(21, 'Eistee Peach', 'Lipton Eistee', '0.5 L', 4, 1, 2, 1, 3),
(22, 'Eistee Lemon', 'Lipton Eistee', '0.5 L', 4, 1, 2, 0, 3),
(23, 'Eistee Lemon', 'Lipton Eistee', '1 L', 7, 1, 2, 0, 6),
(24, 'Eistee Peach', 'Lipton Eistee', '1 L', 7, 1, 2, 1, 6),
(25, 'Wasser', 'Evian', '1 L', 5, 1, 2, 0, 4),
(26, 'Turbinenbräu Sprint', 'Zürcher Bier aus tiefstem Altstetten', '0.33 L', 6, 1, 2, 0, 5),
(27, 'Turbinenbräu Orion', 'Zürcher IPA aus tiefstem Altstetten', '0.33 L', 6, 1, 2, 0, 5),
(28, 'Heineken', 'Heineken Bier', '0.5 L', 8, 1, 2, 0, 7);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
