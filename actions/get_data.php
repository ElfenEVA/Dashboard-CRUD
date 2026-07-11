<?php
// actions/get_data.php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

verificarSesion();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $dato = obtenerInformacionPorId($id);
    
    if ($dato) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'id' => $dato['id'],
            'titulo' => $dato['titulo'],
            'url' => $dato['url'],
            'descripcion' => $dato['descripcion'],
            'categoria' => $dato['categoria']
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false]);
}
?>