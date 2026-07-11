<?php
// includes/functions.php
require_once __DIR__ . '/../config/database.php';

// Función existente para obtener toda la información
function obtenerInformacion() {
    $conn = getConnection();
    $usuario_id = $_SESSION['usuario_id'];
    
    $sql = "SELECT * FROM informacion WHERE usuario_id = ? ORDER BY fecha_creacion DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
    
    $stmt->close();
    $conn->close();
    
    return $datos;
}

// NUEVA FUNCIÓN: Buscar información
function buscarInformacion($termino) {
    $conn = getConnection();
    $usuario_id = $_SESSION['usuario_id'];
    
    // Buscar en todos los campos relevantes
    $sql = "SELECT * FROM informacion 
            WHERE usuario_id = ? 
            AND (titulo LIKE ? 
            OR descripcion LIKE ? 
            OR categoria LIKE ? 
            OR url LIKE ?)
            ORDER BY fecha_creacion DESC";
    
    $termino_busqueda = "%" . $termino . "%";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $usuario_id, $termino_busqueda, $termino_busqueda, $termino_busqueda, $termino_busqueda);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
    
    $stmt->close();
    $conn->close();
    
    return $datos;
}

// El resto de funciones permanecen igual...
function crearInformacion($titulo, $url, $descripcion, $categoria) {
    $conn = getConnection();
    $usuario_id = $_SESSION['usuario_id'];
    
    $sql = "INSERT INTO informacion (titulo, url, descripcion, categoria, usuario_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $titulo, $url, $descripcion, $categoria, $usuario_id);
    
    $resultado = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $resultado;
}

function actualizarInformacion($id, $titulo, $url, $descripcion, $categoria) {
    $conn = getConnection();
    $usuario_id = $_SESSION['usuario_id'];
    
    $sql = "UPDATE informacion SET titulo=?, url=?, descripcion=?, categoria=? WHERE id=? AND usuario_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $titulo, $url, $descripcion, $categoria, $id, $usuario_id);
    
    $resultado = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $resultado;
}

function eliminarInformacion($id) {
    $conn = getConnection();
    $usuario_id = $_SESSION['usuario_id'];
    
    $sql = "DELETE FROM informacion WHERE id=? AND usuario_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $usuario_id);
    
    $resultado = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $resultado;
}

function obtenerInformacionPorId($id) {
    $conn = getConnection();
    $usuario_id = $_SESSION['usuario_id'];
    
    $sql = "SELECT * FROM informacion WHERE id=? AND usuario_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $dato = $result->fetch_assoc();
    
    $stmt->close();
    $conn->close();
    
    return $dato;
}
?>