# php_test
Realizar CRUD em PHP consumindo webservice para consulta de CEP
### SQL COMMANDS
CREATE SCHEMA `php_test` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE `php_test`.`clients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `gender` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`id`));
  
  CREATE TABLE `php_test`.`address` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `zip_code` VARCHAR(8) NULL,
  `street` VARCHAR(128) NULL,
  `number` VARCHAR(8) NULL,
  `neighborhood` VARCHAR(128) NULL,
  `add_address_details` VARCHAR(128) NULL,
  `state` VARCHAR(128) NULL,
  `city` VARCHAR(128) NULL,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`id`));
  
  ALTER TABLE `php_test`.`address` 
ADD INDEX `fk_address_1_idx` (`client_id` ASC) VISIBLE;
;
ALTER TABLE `php_test`.`address` 
ADD CONSTRAINT `fk_address_1`
  FOREIGN KEY (`client_id`)
  REFERENCES `php_test`.`clients` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `php_test`.`clients` 
ADD COLUMN `birth_date` DATE NULL AFTER `gender`;
