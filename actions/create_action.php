<?php
// actions/create_action.php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

verificarSesion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = trim($_POST['titulo']);
    $url = trim($_POST['url']);
    $descripcion = trim($_POST['descripcion']);
    $categoria = trim($_POST['categoria']);
    
    if (empty($titulo) || empty($url) || empty($categoria)) {
        header('Location: ../pages/create.php?error=Todos los campos son obligatorios');
        exit();
    }
    
    // Ya no se pasa el usuario_id
    if (crearInformacion($titulo, $url, $descripcion, $categoria)) {
        header('Location: ../index.php?success=Registro creado correctamente');
    } else {
        header('Location: ../pages/create.php?error=Error al crear el registro');
    }
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>