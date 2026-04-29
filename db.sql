CREATE DATABASE IF NOT EXISTS roquebet;
USE roquebet;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    saldo DECIMAL(10,2) DEFAULT 0.00,
    bono_bienvenida TINYINT DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de apuestas
CREATE TABLE IF NOT EXISTS bets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    equipo_seleccionado ENUM('LOCAL', 'VISITANTE', 'EMPATE') NOT NULL,
    resultado ENUM('LOCAL', 'VISITANTE', 'EMPATE') NOT NULL,
    ganancia DECIMAL(10,2) NOT NULL,
    fecha_apuesta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insertar usuario de prueba
INSERT INTO users (nombre, email, password, saldo, bono_bienvenida) 
VALUES ('Usuario Test', 'test@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 100.00, 0);
-- Contraseña: password