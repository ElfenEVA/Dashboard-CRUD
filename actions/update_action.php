<?php
// actions/update_action.php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

verificarSesion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $url = $_POST['url'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    
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