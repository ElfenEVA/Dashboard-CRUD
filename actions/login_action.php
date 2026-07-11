<?php
// actions/login_action.php
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que los campos existan
    if (!isset($_POST['usuario']) || !isset($_POST['contrasena'])) {
        header('Location: ../pages/login.php?error=Por favor complete todos los campos');
        exit();
    }
    
    $usuario = trim($_POST['usuario']);
    $contrasena = md5(trim($_POST['contrasena']));
    
    // Validar que no estén vacíos
    if (empty($usuario) || empty($_POST['contrasena'])) {
        header('Location: ../pages/login.php?error=Usuario y contraseña son obligatorios');
        exit();
    }
    
    $conn = getConnection();
    
    // Verificar que la conexión sea exitosa
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    // Consulta para verificar el usuario
    $sql = "SELECT id, usuario FROM usuarios WHERE usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['usuario'] = $row['usuario'];
        $stmt->close();
        $conn->close();
        header('Location: ../index.php');
        exit();
    } else {
        $stmt->close();
        $conn->close();
        header('Location: ../pages/login.php?error=Usuario o contraseña incorrectos');
        exit();
    }
} else {
    header('Location: ../pages/login.php');
    exit();
}
?>