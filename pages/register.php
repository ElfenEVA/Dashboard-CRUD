<?php
// pages/register.php
require_once __DIR__ . '/../includes/auth.php';

// Si ya está logueado, redirigir al dashboard
if (estaLogueado()) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- HEADER CON BOTONES CENTRADOS -->
    <header class="header-login">
        <div class="header-center">
            <!-- Logo -->
            <a href="../index.php" class="logo">
                <img src="../assets/img/logo.png" alt="TuxLink" class="logo-img">
                <div class="logo-text">
                    <h1>TuxLink</h1>
                    <span>Registro de Usuario</span>
                </div>
            </a>

            <!-- Botones centrados -->
            <div class="header-actions">
                <!-- Selector de idioma -->
                <div id="translateContainer" class="language-selector"></div>

                <!-- Selector de temas -->
                <div class="theme-selector-wrapper">
                    <button id="themeToggle" class="btn-theme-toggle" title="Cambiar tema">
                        <span class="theme-indicator" id="themeIndicator"></span>
                        <span class="theme-icon">Tema</span>
                    </button>
                    <div id="themeDropdown" class="theme-dropdown" style="display: none;">
                        <div class="theme-option" data-theme="default" title="Oscuro por defecto">
                            <span class="theme-color-preview preview-default"></span>
                            <span class="theme-name">Azul</span>
                            <span class="theme-check">✓</span>
                        </div>
                        <div class="theme-option" data-theme="dark-green" title="Verde">
                            <span class="theme-color-preview preview-green"></span>
                            <span class="theme-name">Verde</span>
                            <span class="theme-check"></span>
                        </div>
                        <div class="theme-option" data-theme="dark-purple" title="Morado">
                            <span class="theme-color-preview preview-purple"></span>
                            <span class="theme-name">Morado</span>
                            <span class="theme-check"></span>
                        </div>
                        <div class="theme-option" data-theme="dark-orange" title="Naranja">
                            <span class="theme-color-preview preview-orange"></span>
                            <span class="theme-name">Naranja</span>
                            <span class="theme-check"></span>
                        </div>
                        <div class="theme-option" data-theme="dark-red" title="Rojo">
                            <span class="theme-color-preview preview-red"></span>
                            <span class="theme-name">Rojo</span>
                            <span class="theme-check"></span>
                        </div>
                        <div class="theme-option" data-theme="dark-soft" title="Azul Claro">
                            <span class="theme-color-preview preview-soft"></span>
                            <span class="theme-name">Azul Claro</span>
                            <span class="theme-check"></span>
                        </div>
                        <div class="theme-option" data-theme="dark-yellow" title="Amarillo">
                            <span class="theme-color-preview preview-yellow"></span>
                            <span class="theme-name">Amarillo</span>
                            <span class="theme-check"></span>
                        </div>
                    </div>
                </div>

                <!-- Botón modo oscuro -->
                <button id="darkModeToggle" class="btn-dark-mode-text">
                    <span class="text" id="darkModeText">Activar tema</span>
                </button>
            </div>
        </div>
    </header>

    <!-- FORMULARIO DE REGISTRO -->
    <div class="auth-container">
        <div class="auth-box">
            <h2>Registro de Usuario</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>
            
            <form action="../actions/register_action.php" method="POST">
                <div class="form-group">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
            <p class="auth-link">
                ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
            </p>
        </div>
    </div>

    <!-- SCRIPTS -->
     <script src="../assets/js/main.js"></script>
    <script src="../assets/js/darkmode.js"></script>
    <script src="../assets/js/themes.js"></script>
    <script src="https://cdn.staticfile.net/translate.js/3.15.6/translate.min.js"></script>
    <script>
translate.language.setLocal('chinese_simplified'); //设置本地语种（当前网页的语种）。如果不设置，默认自动识别当前网页显示文字的语种。 可填写如 'english'、'chinese_simplified' 等
translate.service.use('client.edge'); //设置机器翻译服务通道，相关说明参考 http://translate.zvo.cn/545867.html
translate.listener.start(); //开启页面元素动态监控，js改变的内容也会被翻译，参考文档： http://translate.zvo.cn/4067.html
translate.execute();//完成翻译初始化，进行翻译
</script>
</body>
</html>