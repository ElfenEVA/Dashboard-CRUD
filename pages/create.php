<?php
// pages/create.php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h2>Agregar una nueva pagina</h2>
            <a href="../index.php" class="btn btn-secreate">← Volver al listado</a>
        </div>
             <div class="dark-mode-toggle-auth">
        <button id="darkModeToggleAuth" class="btn-dark-mode-auth" title="Cambiar modo oscuro">
            🌙 Modo oscuro
        </button>
    </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <section class="form-section">
            <form action="../actions/create_action.php" method="POST" id="createForm">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required placeholder="Ingresa el título">
                </div>
                
                <div class="form-group">
                    <label for="url">URL:</label>
                    <input type="url" id="url" name="url" required placeholder="https://ejemplo.com">
                </div>
                
                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <input type="text" id="categoria" name="categoria" required placeholder="Ingresa la categoría">
                </div>
                
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="5" placeholder="Ingresa una descripción detallada..."></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar Registro</button>
                    <a href="../index.php" class="btn btn-secreate">Cancelar</a>
                </div>
            </form>
        </section>
    </div>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/darkmode.js"></script>
<script>
translate.language.setLocal('chinese_simplified'); //设置本地语种（当前网页的语种）。如果不设置，默认自动识别当前网页显示文字的语种。 可填写如 'english'、'chinese_simplified' 等
translate.service.use('client.edge'); //设置机器翻译服务通道，相关说明参考 http://translate.zvo.cn/545867.html
translate.listener.start(); //开启页面元素动态监控，js改变的内容也会被翻译，参考文档： http://translate.zvo.cn/4067.html
translate.execute();//完成翻译初始化，进行翻译
</script>
</body>
</html>