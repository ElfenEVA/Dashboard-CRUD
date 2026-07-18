// assets/js/themes.js - Versión corregida

document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');
    const themeDropdown = document.getElementById('themeDropdown');
    const themeOptions = document.querySelectorAll('.theme-option');
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = document.getElementById('darkModeIcon');
    const darkModeText = document.getElementById('darkModeText');

    if (!themeToggle || !themeDropdown) {
        console.warn('Elementos de temas no encontrados');
        return;
    }

    // Cargar tema guardado
    const savedTheme = localStorage.getItem('selectedTheme') || 'default';
    const savedMode = localStorage.getItem('darkMode') || 'disabled';

    // Aplicar tema guardado
    if (savedMode === 'enabled') {
        document.body.classList.add('dark-mode');
        if (savedTheme !== 'default') {
            document.body.classList.add(`theme-${savedTheme}`);
        }
    }

    // Marcar tema activo
    themeOptions.forEach(option => {
        const theme = option.dataset.theme;
        if (theme === savedTheme) {
            option.classList.add('active');
        }
    });

    // Toggle del dropdown
    themeToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = themeDropdown.style.display === 'block';
        themeDropdown.style.display = isOpen ? 'none' : 'block';
    });

    // Cerrar dropdown al hacer clic fuera
    document.addEventListener('click', function(e) {
        const wrapper = document.querySelector('.theme-selector-wrapper');
        if (wrapper && !wrapper.contains(e.target)) {
            themeDropdown.style.display = 'none';
        }
    });

    // Seleccionar tema
    themeOptions.forEach(option => {
        option.addEventListener('click', function() {
            const theme = this.dataset.theme;
            
            // Remover tema anterior
            const previousTheme = localStorage.getItem('selectedTheme') || 'default';
            if (previousTheme !== 'default') {
                document.body.classList.remove(`theme-${previousTheme}`);
            }
            
            // Aplicar nuevo tema
            if (theme !== 'default') {
                document.body.classList.add(`theme-${theme}`);
            }
            
            // Guardar tema
            localStorage.setItem('selectedTheme', theme);
            
            // Asegurar que el modo oscuro esté activado
            localStorage.setItem('darkMode', 'enabled');
            document.body.classList.add('dark-mode');
            
            // Actualizar botón de modo oscuro (Opción 2)
            if (darkModeToggle) {
                darkModeToggle.classList.add('active');
            }
            if (darkModeIcon) {
                darkModeIcon.textContent = '☀️';
            }
            if (darkModeText) {
                darkModeText.textContent = 'Desactivar tema';
            }
            
            // Actualizar opciones activas
            themeOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            
            // Cerrar dropdown
            themeDropdown.style.display = 'none';
            console.log('Tema aplicado:', theme);
        });
    });
});