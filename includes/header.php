<!-- includes/header.php -->
<header>
    <div class="header-left">
        <a href="index.php" class="logo">
            <img src="assets/img/logo.png" alt="TuxLink" class="logo-img">
            <div class="logo-text">
                <h1>TuxLink</h1>
                <span><?php echo $page_title ?? 'Gestión de Información'; ?></span>
            </div>
        </a>
    </div>
    <div class="user-info">
        <!-- Selector de idioma -->
        <div id="translateContainer" class="language-selector"></div>

        <!-- Selector de temas -->
        <div class="theme-selector-wrapper">
            <button id="themeToggle" class="btn-theme-toggle" title="Cambiar tema">Tema</button>
            <div id="themeDropdown" class="theme-dropdown" style="display: none;">
                <div class="theme-option" data-theme="default" title="Oscuro por defecto">
                    <span class="theme-color-preview preview-default"></span>
                    <span class="theme-name">Azul</span>
                    <span class="theme-check"></span>
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

       <button id="darkModeToggle" class="btn-dark-mode-text">
    <span class="text" id="darkModeText">Activar tema</span>
</button>

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <span><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
            <a href="actions/logout_action.php" class="btn btn-danger">Cerrar Sesión</a>
        <?php endif; ?>
    </div>
</header>