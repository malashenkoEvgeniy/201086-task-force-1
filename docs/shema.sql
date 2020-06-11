CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

  USE taskforce;

  CREATE TABLE categories (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(128) NOT NULL,
    `title_en` VARCHAR(128) NOT NULL
  );

  CREATE TABLE proposal (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `comment` VARCHAR(128) NOT NULL,
    `task_id` INT NOT NULL,
    `budget` INT NULL,
    `user_id` INT NOT NULL
  );


  CREATE TABLE users (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `creation_time` DATETIME DEFAULT NOW() NOT NULL,
  `name` VARCHAR(128) NOT NULL,
  `email` VARCHAR(128) NOT NULL,
  `location_id` INT NULL,
  `birthday` DATETIME NULL,
  `info` TEXT NULL,
  `password` VARCHAR(128) NOT NULL,
  `phone` VARCHAR(128) NULL,
  `skype` VARCHAR(128) NULL,
  `another_messenger` VARCHAR(128) NULL,
  `avatar`  VARCHAR(128) NULL,
  `task_name` VARCHAR(128) NULL,
  `show_contacts_for_customer`  TINYINT NOT NULL DEFAULT 0,
  `hide_profile`  TINYINT NOT NULL DEFAULT 0,
  `last_visit_time` TIMESTAMP NOT NULL,
  `rating` FLOAT NULL ,
  `count_orders` INT NULL ,
  `popularity` INT NULL,
  `now_free` TINYINT  NULL DEFAULT 0,
  `has_reviews` TINYINT NOT NULL DEFAULT 0,
  );

   CREATE TABLE favorites (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `favorites_id` INT NOT NULL
  );

  CREATE TABLE users_categories (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `category_id` INT NOT NULL
  );

  CREATE TABLE email_settings (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `proposal` TINYINT NOT NULL,
  `chat_message` TINYINT NOT NULL,
  `refuse` TINYINT NOT NULL,
  `start_task` TINYINT NOT NULL,
  `completion_task` TINYINT NOT NULL
  );

  CREATE TABLE reviews (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `creation_time` DATETIME DEFAULT NOW() NOT NULL,
    `executor_id` INT NULL,
    `customer_id` INT NULL,
    `assessment` INT NULL,
    `task_id` INT NULL,
    `comment` TEXT NULL
  );

  CREATE TABLE tasks (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `creation_time` DATETIME DEFAULT NOW() NOT NULL,
    `name` VARCHAR(128) NOT NULL,
    `category_id` INT NOT NULL,
    `description` TEXT NULL,
    `location_id` INT NULL,
    `budget` INT NULL,
    `deadline` DATETIME NOT NULL,
    `customer_id` INT NOT NULL,
    `executor_id` INT NULL,
    `status` INT NULL
  );

  CREATE TABLE chat_messages (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `task_id` INT NOT NULL,
    `writer_id` INT NOT NULL,
    `comment` TEXT NOT NULL,
    `creation_time` DATETIME DEFAULT NOW() NOT NULL,
    `viewed` TINYINT NOT NULL
  );

  CREATE TABLE locations (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `city` VARCHAR(128) NOT NULL,
    `lat` VARCHAR(128) NOT NULL,
    `long` VARCHAR(128) NOT NULL
  );

  CREATE TABLE file (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `path` VARCHAR(128) NOT NULL,
    `user_id` INT NOT NULL,
    `task_id` INT NULL
  );

