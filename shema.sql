CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  
  USE taskforce;

  CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title CHAR (128)
  );
  
    CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_date DATETIME,
    name_user CHAR (128),
    email CHAR (128),
    adress CHAR (128),
    birthday_date CHAR (128),  
    contact_details TEXT,
    category_id CHAR (64),
    `password` CHAR (64),
    phone CHAR (64),
    skype CHAR (64),
    another_messenger CHAR (128), 
    photos_works CHAR (128),    
    avatar CHAR (128),
    number_work_performed INT,
    number_failed_jobs INT
  );
  
     CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    reviewer_id INT,
    assessment INT,
    review_text TEXT
  );

  CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    taskstart DATETIME,
    name_task CHAR (128),
    category_id INT,
    description TEXT,
    location CHAR (128),
    budget INT,
    taskover DATETIME,
    file CHAR (128),
    author_id INT,
    executor_id INT
  );
  