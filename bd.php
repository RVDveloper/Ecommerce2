<?php
$host = "localhost"; // Servidor (en XAMPP suele ser localhost)
$usuario = "root"; // Usuario de MySQL
$password = ""; // Contraseña (vacía por defecto en XAMPP)
$bd = "nectar"; // Nombre de la base de datos

// Conectar al servidor MySQL
$conn = new mysqli($host, $usuario, $password);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Crear la base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS $bd";
if ($conn->query($sql) === TRUE) {
    echo "✅ Base de datos asegurada<br>";
} else {
    die("❌ Error al crear la base de datos: " . $conn->error);
}

// Seleccionar la base de datos
$conn->select_db($bd);

// Crear la tabla `users` si no existe
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "✅ Tabla 'users' asegurada.<br>";
} else {
    die("❌ Error al crear la tabla 'users': " . $conn->error);
}

// Crear la tabla `productos` si no existe
$sql = "CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255),
    stock INT DEFAULT 0,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "✅ Tabla 'productos' asegurada.<br>";
} else {
    die("❌ Error al crear la tabla 'productos': " . $conn->error);
}

// Crear la tabla `pagos` si no existe
$sql = "CREATE TABLE IF NOT EXISTS pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_id VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status VARCHAR(50) NOT NULL,
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "✅ Tabla 'pagos' asegurada.<br>";
} else {
    die("❌ Error al crear la tabla 'pagos': " . $conn->error);
}

echo "✅ Conexión y estructura de la base de datos aseguradas.";

$conn->close();
?>