-- MySQL Script generated by MySQL Workbench
-- jeu. 27 févr. 2020 10:52:14 CET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema billet_alaska
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `billet_alaska` ;

-- -----------------------------------------------------
-- Schema billet_alaska
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `billet_alaska` ;
USE `billet_alaska` ;

-- -----------------------------------------------------
-- Table `billet_alaska`.`role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `billet_alaska`.`role` ;

CREATE TABLE IF NOT EXISTS `billet_alaska`.`role` (
  `id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `billet_alaska`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `billet_alaska`.`user` ;

CREATE TABLE IF NOT EXISTS `billet_alaska`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` INT UNSIGNED NOT NULL,
  `login` VARCHAR(60) NOT NULL,
  `passwd` VARCHAR(255) NOT NULL,
  `display_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`, `role_id`),
  INDEX `fk_user_role1_idx` (`role_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_role1`
    FOREIGN KEY (`role_id`)
    REFERENCES `billet_alaska`.`role` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `billet_alaska`.`chapter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `billet_alaska`.`chapter` ;

CREATE TABLE IF NOT EXISTS `billet_alaska`.`chapter` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `chapter_title` VARCHAR(100) NOT NULL,
  `chapter_order` VARCHAR(45) NULL,
  `chapter_content` LONGTEXT NOT NULL,
  `chapter_date` DATETIME NOT NULL DEFAULT NOW(),
  `chapter_modified` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_chapter_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_chapter_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `billet_alaska`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `billet_alaska`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `billet_alaska`.`comment` ;

CREATE TABLE IF NOT EXISTS `billet_alaska`.`comment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `chapter_id` INT UNSIGNED NOT NULL,
  `comment_author` VARCHAR(255) NOT NULL,
  `comment_content` TEXT NOT NULL,
  `comment_date` DATETIME NOT NULL DEFAULT NOW(),
  `reported` TINYINT NOT NULL,
  `comment_parent` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`, `user_id`, `chapter_id`),
  INDEX `fk_comment_user_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_comment_chapter1_idx` (`chapter_id` ASC) VISIBLE,
  CONSTRAINT `fk_comment_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `billet_alaska`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_comment_chapter1`
    FOREIGN KEY (`chapter_id`)
    REFERENCES `billet_alaska`.`chapter` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
