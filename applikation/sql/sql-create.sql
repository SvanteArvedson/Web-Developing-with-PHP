SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `quizapp` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `quizapp` ;

-- -----------------------------------------------------
-- Table `quizapp`.`course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `quizapp`.`course` ;

CREATE TABLE IF NOT EXISTS `quizapp`.`course` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `description` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name` (`name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `quizapp`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `quizapp`.`user` ;

CREATE TABLE IF NOT EXISTS `quizapp`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `password` VARCHAR(256) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `salt` VARCHAR(9) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `privileges` ENUM('Admin','Teacher','Student') CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT 'Student',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username` (`username` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `quizapp`.`courseparticipation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `quizapp`.`courseparticipation` ;

CREATE TABLE IF NOT EXISTS `quizapp`.`courseparticipation` (
  `course` INT(11) NOT NULL,
  `user` INT(11) NOT NULL,
  PRIMARY KEY (`course`, `user`),
  INDEX `user_idx` (`user` ASC),
  CONSTRAINT `course`
    FOREIGN KEY (`course`)
    REFERENCES `quizapp`.`course` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `participant`
    FOREIGN KEY (`user`)
    REFERENCES `quizapp`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
