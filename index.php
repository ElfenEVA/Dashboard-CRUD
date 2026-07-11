<?php
// index.php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

verificarSesion();

// Verificar si hay búsqueda
$termino_busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

if (!empty($termino_busqueda)) {
    $informacion = buscarInformacion($termino_busqueda);
} else {
    $informacion = obtenerInformacion();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD TuxLink</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
    <div class="header-left">
        <a href="index.php" class="logo">
            <!-- Logo con imagen -->
            <img src="assets/img/logo.png" alt="TuxLink Logo" class="logo-img">
            <div class="logo-text">
                <h1>TuxLink</h1>
                <span>Gestión de Información</span>
            </div>
        </a>
    </div>
    <div class="user-info">
         <button id="darkModeToggle" class="btn-dark-mode" title="Cambiar modo oscuro">
          modo oscuro
        </button>
        <span><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
        <a href="actions/logout_action.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</header>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        
        <!-- BARRA DE ACCIONES: Botón Agregar a la izquierda, Búsqueda a la derecha -->
        <div class="actions-bar">
            <!-- Lado izquierdo: Botón Agregar -->
            <div class="actions-left">
                <a href="pages/create.php" class="btn btn-success btn-add">
                    <span class="btn-icon"></span> Agregar
                </a>
            </div>
            
            <!-- Lado derecho: Búsqueda -->
            <div class="search-wrapper">
                <form action="index.php" method="GET" class="search-form" autocomplete="off">
                    <div class="search-input-wrapper">
                        <input type="text" 
                               name="buscar" 
                               id="searchInput"
                               placeholder="Busca por título, descripción, categoría o URL..." 
                               value="<?php echo htmlspecialchars($termino_busqueda); ?>"
                               class="search-input">
                        <button type="submit" class="btn btn-primary btn-search">Buscar</button>
                        <?php if (!empty($termino_busqueda)): ?>
                            <a href="index.php" class="btn btn-secondary btn-clear">Limpiar busqueda</a>
                        <?php endif; ?>
                    </div>
                </form>
                
                <!-- Contenedor de sugerencias -->
                <div id="suggestionsContainer" class="suggestions-container" style="display: none;">
                    <div id="suggestionsList"></div>
                </div>
            </div>
        </div>
        
        <?php if (!empty($termino_busqueda)): ?>
            <div class="search-results-info">
                <p>Resultados econtrados: <strong>"<?php echo htmlspecialchars($termino_busqueda); ?>"</strong> 
                (<?php echo count($informacion); ?> )</p>
            </div>
        <?php endif; ?>
        
        <!-- Tabla de registros -->
        <section class="table-section">
            <div class="table-header">
                <h2>Lista de Registros</h2>
                <span class="record-count">Total: <?php echo count($informacion); ?> registros</span>
            </div>
            
            <div class="table-container">
                <?php if (count($informacion) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>URL</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($informacion as $item): ?>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo htmlspecialchars($item['titulo']); ?></td>
                            <td><a href="<?php echo htmlspecialchars($item['url']); ?>" target="_blank">Ver</a></td>
                            <td><?php echo htmlspecialchars(substr($item['descripcion'], 0, 50)) . '...'; ?></td>
                            <td><?php echo htmlspecialchars($item['categoria']); ?></td>
                            <!-- index.php - Botones con imágenes -->
                            <!-- index.php - Botones con imágenes -->
<td class="actions">
    <button onclick="editarRegistro(<?php echo $item['id']; ?>)" 
            class="btn-image" 
            title="Editar">
        <img src="assets/img/edit.png" alt="Editar" class="action-icon">
    </button>
    <a href="actions/delete_action.php?id=<?php echo $item['id']; ?>" 
       class="btn-image" 
       onclick="return confirm('¿Estás seguro de eliminar este registro?')"
       title="Eliminar">
        <img src="assets/img/delete.png" alt="Eliminar" class="action-icon">
    </a>
</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <?php if (!empty($termino_busqueda)): ?>
                        <div class="empty-state">
                            <span class="empty-icon"></span>
                            <p>No se encontraron resultados para <strong>"<?php echo htmlspecialchars($termino_busqueda); ?>"</strong></p>
                            <a href="index.php" class="btn btn-secondary">Ver todos los registros</a>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <span class="empty-icon"></span>
                            <p>No hay registros disponibles</p>
                            <a href="pages/create.php" class="btn btn-success">Agregar tu primer registro</a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </section>
        
        <!-- Modal para editar -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Editar</h2>
                <form action="actions/update_action.php" method="POST" id="editForm">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_titulo">Título:</label>
                        <input type="text" id="edit_titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_url">URL:</label>
                        <input type="url" id="edit_url" name="url" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_descripcion">Descripción:</label>
                        <textarea id="edit_descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_categoria">Categoría:</label>
                        <input type="text" id="edit_categoria" name="categoria" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="assets/js/main.js"></script>
    <script src="assets/js/search.js"></script>
    <script src="assets/js/darkmode.js"></script>
    <script src="https://cdn.staticfile.net/translate.js/3.18.66/translate.js"></script>
<script>
translate.language.setLocal('chinese_simplified'); //设置本地语种（当前网页的语种）。如果不设置，默认自动识别当前网页显示文字的语种。 可填写如 'english'、'chinese_simplified' 等
translate.service.use('client.edge'); //设置机器翻译服务通道，相关说明参考 http://translate.zvo.cn/545867.html
translate.listener.start(); //开启页面元素动态监控，js改变的内容也会被翻译，参考文档： http://translate.zvo.cn/4067.html
translate.execute();//完成翻译初始化，进行翻译
</script>
</body>
</html>