SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `quizapp` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `quizapp` ;

-- -----------------------------------------------------
-- Table `quizapp`.`answer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizapp`.`answer` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `quizapp`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizapp`.`course` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `description` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name` (`name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `quizapp`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizapp`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `password` VARCHAR(256) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `salt` VARCHAR(9) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `privileges` ENUM('Admin','Teacher','Student') CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT 'Student',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username` (`username` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `quizapp`.`courseparticipation`
-- -----------------------------------------------------
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


-- -----------------------------------------------------
-- Table `quizapp`.`question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizapp`.`question` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `answer` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `correctanswer`
    FOREIGN KEY (`answer`)
    REFERENCES `quizapp`.`answer` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `quizapp`.`incorrectanswer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizapp`.`incorrectanswer` (
  `question` INT(11) NOT NULL,
  `answer` INT(11) NOT NULL,
  PRIMARY KEY (`question`, `answer`),
  INDEX `answer_idx` (`answer` ASC),
  CONSTRAINT `answer`
    FOREIGN KEY (`answer`)
    REFERENCES `quizapp`.`answer` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `question`
    FOREIGN KEY (`question`)
    REFERENCES `quizapp`.`question` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `quizapp`.`quiz`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizapp`.`quiz` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `course` INT(11) NOT NULL,
  `quizname` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `course_idx` (`course` ASC),
  CONSTRAINT `owner`
    FOREIGN KEY (`course`)
    REFERENCES `quizapp`.`course` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `quizapp`.`quizquestion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizapp`.`quizquestion` (
  `quiz` INT(11) NOT NULL,
  `question` INT(11) NOT NULL,
  PRIMARY KEY (`quiz`, `question`),
  INDEX `childquestion_idx` (`question` ASC),
  CONSTRAINT `childquestion`
    FOREIGN KEY (`question`)
    REFERENCES `quizapp`.`question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `parentquiz`
    FOREIGN KEY (`quiz`)
    REFERENCES `quizapp`.`quiz` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `quizapp`.`quizresult`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizapp`.`quizresult` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `quiz` INT(11) NOT NULL,
  `user` INT(11) NOT NULL,
  `score` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `maxscore` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `resultowner_idx` (`user` ASC),
  INDEX `onquiz_idx` (`quiz` ASC),
  CONSTRAINT `onquiz`
    FOREIGN KEY (`quiz`)
    REFERENCES `quizapp`.`quiz` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `resultowner`
    FOREIGN KEY (`user`)
    REFERENCES `quizapp`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
