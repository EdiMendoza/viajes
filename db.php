<?php
// Datos de conexión a MySQL
$servername = "localhost";
$username = "root";  // Cambia por tu usuario de MySQL
$password = "";      // Cambia por tu contraseña de MySQL

// Crear conexión
$conn = new mysqli($servername, $username, $password);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Crear la base de datos
$sql = "CREATE DATABASE IF NOT EXISTS sitio_viajes";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada exitosamente.<br>";
} else {
    echo "Error al crear la base de datos: " . $conn->error . "<br>";
}

// Seleccionar la base de datos
$conn->select_db("sitio_viajes");

// Crear tabla 'usuarios'
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'user') NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'usuarios' creada exitosamente.<br>";
} else {
    echo "Error al crear la tabla 'usuarios': " . $conn->error . "<br>";
}

// Crear tabla 'vuelos'
$sql = "CREATE TABLE IF NOT EXISTS vuelos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ciudad_origen VARCHAR(50) NOT NULL,
    ciudad_destino VARCHAR(50) NOT NULL,
    hora_salida TIME NOT NULL,
    hora_llegada TIME NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'vuelos' creada exitosamente.<br>";
} else {
    echo "Error al crear la tabla 'vuelos': " . $conn->error . "<br>";
}

// Crear tabla 'reservas'
$sql = "CREATE TABLE IF NOT EXISTS reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_vuelo INT NOT NULL,
    fecha_reserva DATE NOT NULL,
    estado ENUM('reservado', 'cancelado') NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_vuelo) REFERENCES vuelos(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'reservas' creada exitosamente.<br>";
} else {
    echo "Error al crear la tabla 'reservas': " . $conn->error . "<br>";
}

// Cerrar la conexión
$conn->close();
?>
