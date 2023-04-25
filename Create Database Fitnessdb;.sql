Create Database Fitnessdb;


CREATE TABLE IF NOT EXISTS Gebruikers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    usertype VARCHAR(255) NOT NULL,
    start_datum DATETIME NOT NULL DEFAULT NOW(),
    due_date DATE
);