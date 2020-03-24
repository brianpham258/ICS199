-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ICS199Group06_dev
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ICS199Group06_dev
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ICS199Group06_dev` DEFAULT CHARACTER SET utf8 ;
USE `ICS199Group06_dev` ;

-- -----------------------------------------------------
-- Table `ICS199Group06_dev`.`CUSTOMER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group06_dev`.`CUSTOMER` ;

CREATE TABLE IF NOT EXISTS `ICS199Group06_dev`.`CUSTOMER` (
  `cust_id` INT NOT NULL AUTO_INCREMENT,
  `user_authority` VARCHAR(45) NOT NULL DEFAULT '03',
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `address` VARCHAR(100) NULL,
  `phone` VARCHAR(11) NULL,
  PRIMARY KEY (`cust_id`),
  INDEX `customer_pk` (`cust_id` ASC) VISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group06_dev`.`RESTAURANT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group06_dev`.`RESTAURANT` ;

CREATE TABLE IF NOT EXISTS `ICS199Group06_dev`.`RESTAURANT` (
  `rest_id` INT NOT NULL AUTO_INCREMENT,
  `rest_category` VARCHAR(45) NOT NULL,
  `rest_name` VARCHAR(45) NULL,
  `rest_add` VARCHAR(100) NULL,
  `rest_desc` VARCHAR(1000) NULL,
  `rest_phone` VARCHAR(11) NULL,
  `rest_pic_file` VARCHAR(45) NULL,
  PRIMARY KEY (`rest_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group06_dev`.`ORDERINFO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group06_dev`.`ORDERINFO` ;

CREATE TABLE IF NOT EXISTS `ICS199Group06_dev`.`ORDERINFO` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `order_status` VARCHAR(45) NULL,
  `payment_date` DATE NULL,
  `cust_id` INT NOT NULL,
  `rest_id` INT NOT NULL,
  PRIMARY KEY (`order_id`),
  INDEX `orderinfo_cust_id_fk` (`cust_id` ASC) VISIBLE,
  INDEX `orderinfo_rest_id_fk` (`rest_id` ASC) VISIBLE,
  CONSTRAINT `cust_id`
    FOREIGN KEY (`cust_id`)
    REFERENCES `ICS199Group06_dev`.`CUSTOMER` (`cust_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `rest_id`
    FOREIGN KEY (`rest_id`)
    REFERENCES `ICS199Group06_dev`.`RESTAURANT` (`rest_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group06_dev`.`PRODUCT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group06_dev`.`PRODUCT` ;

CREATE TABLE IF NOT EXISTS `ICS199Group06_dev`.`PRODUCT` (
  `product_id` INT NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(45) NOT NULL,
  `product_price` VARCHAR(45) NOT NULL,
  `product_category` VARCHAR(45) NOT NULL,
  `product_pic_path` VARCHAR(45) NULL,
  `rest_id` INT NOT NULL,
  PRIMARY KEY (`product_id`),
  INDEX `product_rest_id_fk` (`rest_id` ASC) INVISIBLE,
  CONSTRAINT `REST_ID_FK`
    FOREIGN KEY (`rest_id`)
    REFERENCES `ICS199Group06_dev`.`RESTAURANT` (`rest_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group06_dev`.`SOLD_PRODUCT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group06_dev`.`SOLD_PRODUCT` ;

CREATE TABLE IF NOT EXISTS `ICS199Group06_dev`.`SOLD_PRODUCT` (
  `product_id` INT NOT NULL,
  `order_id` INT NOT NULL,
  `quantity` VARCHAR(45) NULL,
  `review` VARCHAR(45) NULL,
  `rate_point` INT NULL,
  INDEX `sold_product_order_id_fk` (`order_id` ASC) VISIBLE,
  INDEX `sold_product_order_product_id_fk` (`product_id` ASC) VISIBLE,
  INDEX `sold_product_pk` (`order_id` ASC, `product_id` ASC) VISIBLE,
  PRIMARY KEY (`product_id`, `order_id`),
  CONSTRAINT `order_id`
    FOREIGN KEY (`order_id`)
    REFERENCES `ICS199Group06_dev`.`ORDERINFO` (`order_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `product_id`
    FOREIGN KEY (`product_id`)
    REFERENCES `ICS199Group06_dev`.`PRODUCT` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group06_dev`.`CODE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group06_dev`.`CODE` ;

CREATE TABLE IF NOT EXISTS `ICS199Group06_dev`.`CODE` (
  `tablename` VARCHAR(45) NOT NULL,
  `colname` VARCHAR(45) NOT NULL,
  `code_value` VARCHAR(45) NOT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`tablename`, `colname`, `code_value`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
