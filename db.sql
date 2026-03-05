CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    course VARCHAR(100) NOT NULL,
    is_pwd TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE queues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    queue_number VARCHAR(20) NOT NULL,
    status ENUM('waiting','processing','done') DEFAULT 'waiting',
    stage ENUM('evaluation','payment','registrar','other') DEFAULT 'evaluation',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    role ENUM('evaluator','cashier','registrar','admin') DEFAULT 'evaluator'
);
INSERT INTO staff (username, password, role)
VALUES ('admin', 'admin123', 'admin');
