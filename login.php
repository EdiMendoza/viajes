<?php
session_start();
include 'conexion.php';

$data = json_decode(file_get_contents("php://input"));
$correo = $data->email;
$password = $data->password;

$query = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :correo");
$query->execute(['correo' => $correo]);
$usuario = $query->fetch();

if ($usuario && password_verify($password, $usuario['password'])) {
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['rol'] = $usuario['rol'];
    echo json_encode(["success" => true, "rol" => $usuario['rol']]);
} else {
    echo json_encode(["success" => false]);
}
?>
