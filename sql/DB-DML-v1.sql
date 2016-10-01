-- DB-Daten für die Modulprüfung M133
-- Loremipsum-pizza


USE `loremipsum-pizza` ;

--
-- Daten für Tabelle `tbl_benutzer`
--

INSERT INTO `tbl_benutzer` (`ID`, `benutzername`, `hash`) VALUES
(1, 'testuser', '8093ea3ad9f16b1b1f064464dd4caf19');

--
-- Daten für Tabelle `tbl_kategorie`
--

INSERT INTO `tbl_kategorie` (`ID`, `bezeichnung`, `beschreibung`, `aktiv_flag`) VALUES
(1, 'Pizza', 'Unsere feinen Pizzen werden mit liebe Zubereitet und im Feuer des ewigen Verdammnis ausgebacken.', 1),
(2, 'Getränke', 'Wir bringen Ihnen gekühlte Getränke und auf Anfrage auch Becher.', 1);

--
-- Daten für Tabelle `tbl_produkte`
--

INSERT INTO `tbl_produkte` (`ID`, `bezeichnung`, `beschreibung`, `groesse`, `preis`, `aktiv_flag`, `fk_kategorie`, `aktions_flag`, `aktions_preis`) VALUES
(1, 'Margherita', 'Tomate, Mozzarella, Oregano', 'Ø 30cm', 20, 1, 1, 0, 0),
(2, 'Prosciutto', 'Tomate, Mozzarella, Vorderschinken, Oregano', 'Ø 30cm', 22, 1, 1, 0, 0),
(3, 'Coca Cola', NULL, '0.5 L', 4, 1, 2, 0, 0),
(4, 'Coca Cola', NULL, '1.0 L', 7, 1, 2, 0, 0);