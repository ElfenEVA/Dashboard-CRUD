<?php
// actions/delete_action.php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

verificarSesion();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if (eliminarInformacion($id)) {
        header('Location: ../index.php?success=Registro eliminado correctamente');
    } else {
        header('Location: ../index.php?error=Error al eliminar el registro');
    }
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>