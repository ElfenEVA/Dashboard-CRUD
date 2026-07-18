<?php
// includes/functions.php
require_once __DIR__ . '/../config/database.php';

// OBTENER TODOS LOS REGISTROS (sin filtrar por usuario)
function obtenerInformacion() {
    $conn = getConnection();
    
    // Eliminar el filtro WHERE usuario_id = ?
    $sql = "SELECT * FROM informacion ORDER BY fecha_creacion DESC";
    $stmt = $conn->prepare($sql);
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

// BUSCAR REGISTROS (sin filtrar por usuario)
function buscarInformacion($termino) {
    $conn = getConnection();
    
    // Eliminar el filtro WHERE usuario_id = ?
    $sql = "SELECT * FROM informacion 
            WHERE titulo LIKE ? 
            OR descripcion LIKE ? 
            OR categoria LIKE ? 
            OR url LIKE ?
            ORDER BY fecha_creacion DESC";
    
    $termino_busqueda = "%" . $termino . "%";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $termino_busqueda, $termino_busqueda, $termino_busqueda, $termino_busqueda);
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

// CREAR REGISTRO (sin asociar a usuario)
function crearInformacion($titulo, $url, $descripcion, $categoria) {
    $conn = getConnection();
    
    // Eliminar el campo usuario_id de la inserción
    $sql = "INSERT INTO informacion (titulo, url, descripcion, categoria) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $titulo, $url, $descripcion, $categoria);
    
    $resultado = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $resultado;
}

// ACTUALIZAR REGISTRO (sin verificar usuario_id)
function actualizarInformacion($id, $titulo, $url, $descripcion, $categoria) {
    $conn = getConnection();
    
    // Eliminar la condición AND usuario_id = ?
    $sql = "UPDATE informacion SET titulo=?, url=?, descripcion=?, categoria=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $titulo, $url, $descripcion, $categoria, $id);
    
    $resultado = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $resultado;
}

// ELIMINAR REGISTRO (sin verificar usuario_id)
function eliminarInformacion($id) {
    $conn = getConnection();
    
    // Eliminar la condición AND usuario_id = ?
    $sql = "DELETE FROM informacion WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    $resultado = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $resultado;
}

// OBTENER REGISTRO POR ID (sin verificar usuario_id)
function obtenerInformacionPorId($id) {
    $conn = getConnection();
    
    // Eliminar la condición AND usuario_id = ?
    $sql = "SELECT * FROM informacion WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $dato = $result->fetch_assoc();
    
    $stmt->close();
    $conn->close();
    
    return $dato;
}
?>