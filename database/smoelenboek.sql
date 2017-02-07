/*-------- Database: Smoelenboek --------*/

CREATE DATABASE IF NOT EXISTS `smoelenboek`
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;
    SET default_storage_engine=InnoDB;

/*-------- Using Database Smoelenboek --------*/
USE `smoelenboek`;



/*-------- Table: Personen --------*/
CREATE TABLE IF NOT EXISTS `personen` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `vnaam` VARCHAR(30) NOT NULL,
    `tv` VARCHAR(30) DEFAULT NULL,
    `anaam` VARCHAR(30) NOT NULL,
    `gebrnaam` VARCHAR(30) NOT NULL,
    `ww` VARCHAR(30) NOT NULL,
    `email` VARCHAR(30) NOT NULL,
    `telnummer` VARCHAR(15) NOT NULL,
    `foto` VARCHAR(255) NOT NULL DEFAULT 'default.jpg',
    `opmerkingen` TEXT DEFAULT NULL,
    `adres` VARCHAR(30) DEFAULT NULL,
    `plaats` VARCHAR(30) DEFAULT NULL,
    `klas_id`  INT(11) DEFAULT NULL,
    `recht` ENUM('leerling', 'docent', 'directeur') NOT NULL DEFAULT 'leerling',
    CONSTRAINT `personen_id_pk` PRIMARY KEY (`id`),
    CONSTRAINT `personen_gebrnaam_uk` UNIQUE(`gebrnaam`)
) ENGINE=InnoDB;

/*-------- Table: Klassen --------*/
CREATE TABLE IF NOT EXISTS `klassen` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `naam` VARCHAR(30) NOT NULL UNIQUE,
    `mentor_id` INT(11) UNIQUE,
    CONSTRAINT `klassen_id_pk` PRIMARY KEY (`id`),
    CONSTRAINT `klassen_naam_uk` UNIQUE (`naam`),
    CONSTRAINT `klassen_mentor_id_uk` UNIQUE (`mentor_id`)
) ENGINE=InnoDB;


/*-------- Alter table for relationships --------*/

/*--------Alter personen.klas_id --------*/
ALTER TABLE `personen`
    ADD CONSTRAINT  `personen_klassen_id_fk`
        FOREIGN KEY (`klas_id`)
        REFERENCES `klassen` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*--------Alter klassen.mentor_id --------*/
ALTER TABLE `klassen`
    ADD CONSTRAINT `klassen_mentor_id_fk`
        FOREIGN KEY (`mentor_id`)
        REFERENCES `personen`(`id`) ON DELETE SET NULL ON UPDATE SET NULL;
