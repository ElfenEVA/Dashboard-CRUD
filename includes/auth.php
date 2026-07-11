<?php
// includes/auth.php
// Usar __DIR__ para rutas absolutas
require_once __DIR__ . '/../config/database.php';

function verificarSesion() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: pages/login.php');
        exit();
    }
}

function estaLogueado() {
    return isset($_SESSION['usuario_id']);
}

function obtenerUsuarioActual() {
    if (estaLogueado()) {
        return [
            'id' => $_SESSION['usuario_id'],
            'usuario' => $_SESSION['usuario']
        ];
    }
    return null;
}
?>