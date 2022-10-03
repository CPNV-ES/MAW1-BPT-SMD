-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema looper
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `looper` ;

-- -----------------------------------------------------
-- Schema looper
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `looper` DEFAULT CHARACTER SET utf8 ;
USE `looper` ;

-- -----------------------------------------------------
-- Table `looper`.`exercises`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `looper`.`exercises` ;

CREATE TABLE IF NOT EXISTS `looper`.`exercises` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `looper`.`fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `looper`.`fields` ;

CREATE TABLE IF NOT EXISTS `looper`.`fields` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `value_kind` VARCHAR(45) NOT NULL,
  `exercises_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_fields_exercises_idx` (`exercises_id` ASC) VISIBLE,
  CONSTRAINT `fk_fields_exercises`
    FOREIGN KEY (`exercises_id`)
    REFERENCES `looper`.`exercises` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
