<?php
// actions/register_action.php
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que los campos existan
    if (!isset($_POST['correo']) || !isset($_POST['usuario']) || !isset($_POST['contrasena'])) {
        header('Location: ../pages/register.php?error=Por favor complete todos los campos');
        exit();
    }
    
    $correo = trim($_POST['correo']);
    $usuario = trim($_POST['usuario']);
    $contrasena = md5(trim($_POST['contrasena']));
    
    // Validar que no estén vacíos
    if (empty($correo) || empty($usuario) || empty($_POST['contrasena'])) {
        header('Location: ../pages/register.php?error=Todos los campos son obligatorios');
        exit();
    }
    
    // Validar formato de email
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../pages/register.php?error=Correo electrónico inválido');
        exit();
    }
    
    $conn = getConnection();
    
    // Verificar si el usuario o correo ya existen
    $sql = "SELECT id FROM usuarios WHERE usuario = ? OR correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $stmt->close();
        $conn->close();
        header('Location: ../pages/register.php?error=El usuario o correo ya está registrado');
        exit();
    }
    
    // Insertar nuevo usuario
    $sql = "INSERT INTO usuarios (correo, usuario, contrasena) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $correo, $usuario, $contrasena);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header('Location: ../pages/login.php?success=Registro exitoso, ahora inicia sesión');
        exit();
    } else {
        $stmt->close();
        $conn->close();
        header('Location: ../pages/register.php?error=Error al registrar usuario');
        exit();
    }
} else {
    header('Location: ../pages/register.php');
    exit();
}
?>