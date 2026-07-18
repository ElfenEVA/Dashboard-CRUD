<?php
// actions/update_action.php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

verificarSesion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $titulo = trim($_POST['titulo']);
    $url = trim($_POST['url']);
    $descripcion = trim($_POST['descripcion']);
    $categoria = trim($_POST['categoria']);
    
    if (actualizarInformacion($id, $titulo, $url, $descripcion, $categoria)) {
        header('Location: ../index.php?success=Registro actualizado correctamente');
    } else {
        header('Location: ../index.php?error=Error al actualizar el registro');
    }
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>