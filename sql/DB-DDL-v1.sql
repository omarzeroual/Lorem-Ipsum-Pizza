-- MySQL Workbench Forward Engineering

-- DB-Modell für die Modulprüfung M133
-- Loremipsum-pizza

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- Datenbank "loremipsum-pizza" verwenden
USE `loremipsum-pizza` ;



-- Tabelle für admin-Login


CREATE TABLE `loremipsum-pizza`.`tbl_benutzer` (
  `ID` INT NOT NULL,
  `benutzername` VARCHAR(45) NULL,
  `hash` VARCHAR(128) NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB DEFAULT CHARSET=utf8;

-- -Tabelle mit Produkte-Kategorien


CREATE TABLE `loremipsum-pizza`.`tbl_kategorie` (
  `ID` INT NOT NULL,
  `bezeichnung` VARCHAR(45) NULL,
  `beschreibung` VARCHAR(256) NULL,
  `aktiv_flag` TINYINT(1) NULL,
  `reihenfolge` INT(11) NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `PK_UNIQUE` (`ID` ASC))
ENGINE = InnoDB DEFAULT CHARSET=utf8;

-- Tabelle mit Kontaktinformationen der
-- Bestellungen

CREATE TABLE `loremipsum-pizza`.`tbl_kontaktinformationen` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `vorname` VARCHAR(64) NULL,
  `nachname` VARCHAR(64) NULL,
  `email` VARCHAR(64) NULL,
  `telefonnummer` VARCHAR(45) NULL,
  `lieferadresse` VARCHAR(128) NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC))
ENGINE = InnoDB DEFAULT CHARSET=utf8;

-- Tabelle mit den einzelnen Produkten
-- (Speisekarte)

CREATE TABLE `loremipsum-pizza`.`tbl_produkte` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `bezeichnung` VARCHAR(64) NULL,
  `beschreibung` VARCHAR(128) NULL,
  `groesse` VARCHAR(45) NULL,
  `preis` DOUBLE NULL,
  `aktiv_flag` TINYINT(1) NULL,
  `fk_kategorie` INT NULL,
  `aktions_flag` TINYINT(1) NULL,
  `aktions_preis` DOUBLE NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `PK_UNIQUE` (`ID` ASC),
  INDEX `fk_tbl_speisekarte_tbl_kategorie_idx` (`fk_kategorie` ASC),
  CONSTRAINT `fk_tbl_speisekarte_tbl_kategorie`
    FOREIGN KEY (`fk_kategorie`)
    REFERENCES `loremipsum-pizza`.`tbl_kategorie` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=utf8;;

-- Zwischentabelle zum erfassen der 
-- Produkte innerhalb einer Bestellung

CREATE TABLE `loremipsum-pizza`.`tbl_bestellung_produkt` (
  `fk_bestellung` INT NOT NULL,
  `fk_produkt` INT NOT NULL,
  `menge` INT NOT NULL,
  PRIMARY KEY (`fk_bestellung`, `fk_produkt`, `menge`),
  UNIQUE INDEX `fk_bestellung_UNIQUE` (`fk_bestellung` ASC),
  UNIQUE INDEX `fk_produkt_UNIQUE` (`fk_produkt` ASC),
  UNIQUE INDEX `menge_UNIQUE` (`menge` ASC),
  CONSTRAINT `fk_tbl_bestellung_produkt_tbl_bestellung1`
    FOREIGN KEY (`fk_bestellung`)
    REFERENCES `loremipsum-pizza`.`tbl_kontaktinformationen` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_bestellung_produkt_tbl_speisekarte1`
    FOREIGN KEY (`fk_produkt`)
    REFERENCES `loremipsum-pizza`.`tbl_produkte` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=utf8;





SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
