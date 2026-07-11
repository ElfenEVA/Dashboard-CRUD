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
    <div class="auth-container">
        <div class="auth-box">
                 <div class="dark-mode-toggle-auth">
        <button id="darkModeToggleAuth" class="btn-dark-mode-auth" title="Cambiar modo oscuro">
            🌙 Modo oscuro
        </button>
    </div>
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
                <a href="login.php">volver</a>
            </p>
        </div>
    </div>
    <script src="../assets/js/darkmode.js"></script>
    <script>
translate.language.setLocal('chinese_simplified'); //设置本地语种（当前网页的语种）。如果不设置，默认自动识别当前网页显示文字的语种。 可填写如 'english'、'chinese_simplified' 等
translate.service.use('client.edge'); //设置机器翻译服务通道，相关说明参考 http://translate.zvo.cn/545867.html
translate.listener.start(); //开启页面元素动态监控，js改变的内容也会被翻译，参考文档： http://translate.zvo.cn/4067.html
translate.execute();//完成翻译初始化，进行翻译
</script>
</body>
</html>