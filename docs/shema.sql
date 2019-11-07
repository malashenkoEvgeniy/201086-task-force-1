CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  
  USE taskforce;

  CREATE TABLE categories (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(128) NOT NULL
  );
  
    CREATE TABLE users (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `creation_time` DATETIME DEFAULT NOW() NOT NULL,
    `name_user` VARCHAR(128) NOT NULL,
    `email` VARCHAR(128) NOT NULL,
    `location` VARCHAR(128) NULL,
    `birthday` DATETIME NOT NULL,  
    `contact_details` TEXT NULL,
    `category_id` INT NULL,
    `password` VARCHAR(128) NOT NULL,
    `phone` VARCHAR(128) NULL NULL,
    `skype` VARCHAR(128) NULL NULL,
    `another_messenger` VARCHAR(128) , 
    `photos_works` VARCHAR(128),    
    `avatar`  VARCHAR(128),
    `task_id` INT NULL NULL,
    `status_task` VARCHAR(128)  
  );
  
  CREATE TABLE reviews (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NULL,
    `reviewer_id` INT NULL,
    `assessment` INT NULL,
    `task_id` INT NULL,
    `review_text` TEXT NULL
  );

  CREATE TABLE task (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `creation_time` DATETIME DEFAULT NOW() NOT NULL,
    `name_task` VARCHAR(128) NOT NULL,
    `category_id` INT NOT NULL,
    `description` TEXT NULL,
    `location` INT NULL,
    `budget` INT NOT NULL,
    `deadline` DATETIME NOT NULL,
    `file`  VARCHAR(128) NULL,
    `author_id` INT NOT NULL,
    `executor_id` INT NULL,
    correspondence_id INT NULL
  );
  
  CREATE TABLE correspondence (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `task_id` INT NOT NULL,
    `writer_id` INT NOT NULL,
    `text` TEXT NOT NULL,
    `message_time` DATETIME NOT NULL
  );
  
    CREATE TABLE cities (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `city` VARCHAR(128) NOT NULL
  );