/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP DATABASE IF EXISTS `looper`;
CREATE DATABASE IF NOT EXISTS `looper` /*!40100 DEFAULT CHARACTER SET utf8mb3 */;
USE `looper`;

CREATE TABLE IF NOT EXISTS `exercises` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(45) NOT NULL,
    `state` varchar(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `title_UNIQUE` (`title`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE IF NOT EXISTS `fields` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `label` varchar(45) NOT NULL,
    `value_kind` varchar(45) NOT NULL,
    `exercises_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `label` (`label`,`exercises_id`) USING BTREE,
    KEY `fk_fields_exercises_idx` (`exercises_id`),
    CONSTRAINT `fk_fields_exercises` FOREIGN KEY (`exercises_id`) REFERENCES `exercises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE IF NOT EXISTS `fields_has_fulfillments` (
    `fields_id` int(11) NOT NULL,
    `fulfillments_id` int(11) NOT NULL,
    `value` varchar(255) DEFAULT NULL,
    UNIQUE KEY `fields_id` (`fields_id`,`fulfillments_id`),
    KEY `fk_fields` (`fields_id`) USING BTREE,
    KEY `fk_fulfillments` (`fulfillments_id`),
    CONSTRAINT `fk_fields` FOREIGN KEY (`fields_id`) REFERENCES `fields` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_fulfillments` FOREIGN KEY (`fulfillments_id`) REFERENCES `fulfillments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE IF NOT EXISTS `fulfillments` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `exercises_id` int(11) NOT NULL,
    `date` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_fulfillments_exercises` (`exercises_id`),
    CONSTRAINT `fk_fulfillments_exercises` FOREIGN KEY (`exercises_id`) REFERENCES `exercises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
