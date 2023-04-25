Create Database TrainerShift;


CREATE TABLE IF NOT EXISTS TrainerShift (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Trainer VARCHAR(255) NOT NULL,
    Tijd TIMESTAMP NOT NULL
);