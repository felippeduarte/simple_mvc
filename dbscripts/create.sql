SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `test02` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `test02` ;

-- -----------------------------------------------------
-- Table `test02`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test02`.`estado` (
  `id` INT NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `sigla` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `test02`.`cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test02`.`cidade` (
  `id` INT NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `estado_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cidade_estado1_idx` (`estado_id` ASC),
  CONSTRAINT `fk_cidade_estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `test02`.`estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `test02`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test02`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `dataNascimento` DATE NOT NULL,
  `cidade_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
  INDEX `fk_cliente_cidade_idx` (`cidade_id` ASC),
  CONSTRAINT `fk_cliente_cidade`
    FOREIGN KEY (`cidade_id`)
    REFERENCES `test02`.`cidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `test02`.`contrato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test02`.`contrato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(255) NOT NULL,
  `valor` DECIMAL(15,2) NOT NULL,
  `dataCadastro` DATE NOT NULL,
  `cliente_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_contrato_cliente1_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_contrato_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `test02`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
