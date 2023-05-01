 
 
 
//SCRIPT FOR CREATING TABLES

CREATE TABLE `dms_db`.`tbl_users` (`id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `firstname` VARCHAR(100) NOT NULL ,
 `middlename` VARCHAR(100) NOT NULL , `lastname` VARCHAR(100) NOT NULL 
 , `password` VARCHAR(100) NOT NULL , `role` VARCHAR(100) NOT NULL , `status` VARCHAR(100) NOT NULL , 
  `archive` VARCHAR(100) NOT NULL , `date_created` DATETIME on update CURRENT_TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  PRIMARY KEY (`id`)) ENGINE = InnoDB; 

  
  
   //-------------------------------------------------/// 
  CREATE TABLE `dms_db`.`tbl_folders` (`id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , 
  `foldername` VARCHAR(100) NOT NULL , `parent_id` INT NOT NULL , 
  `public_to` INT NOT NULL , `date_created` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  `is_public` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
   
   
   
   
   
   ///----------------------------------------//// 
 CREATE TABLE `dms_db`.`tbl_files` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL ,  
 `description` VARCHAR(255) NOT NULL , `user_id` INT NOT NULL ,  
 `folder_id` INT NOT NULL , `file_type` VARCHAR NOT NULL , `file_path` INT NOT NULL ,  
 `is_public` TINYINT(1) NOT NULL , `public_to` INT NOT NULL , 
  `date_updated` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
   `filesize` VARCHAR NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
 
 
    
   ///----------------------------------------//// 
 CREATE TABLE `dms_db`.`tbl_role` (`id` INT NOT NULL AUTO_INCREMENT , 
`role` VARCHAR(100) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,  
PRIMARY KEY (`id`)) ENGINE = InnoDB; 

