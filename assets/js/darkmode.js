// assets/js/darkmode.js - Modo oscuro completo

document.addEventListener('DOMContentLoaded', function() {
    // Verificar si hay preferencia guardada
    const darkMode = localStorage.getItem('darkMode');
    
    // Aplicar modo oscuro si está activado
    if (darkMode === 'enabled') {
        document.body.classList.add('dark-mode');
        actualizarIcono('🌙', '☀️');
    }

    // Botón en el header (index.php)
    const toggleBtn = document.getElementById('darkModeToggle');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            toggleDarkMode();
        });
    }

    // Botón en auth (login/register)
    const toggleAuthBtn = document.getElementById('darkModeToggleAuth');
    if (toggleAuthBtn) {
        toggleAuthBtn.addEventListener('click', function() {
            toggleDarkMode();
        });
    }

    // Función para alternar modo oscuro
    function toggleDarkMode() {
        const isDark = document.body.classList.toggle('dark-mode');
        
        if (isDark) {
            localStorage.setItem('darkMode', 'enabled');
            actualizarIcono('🌙', '☀️');
        } else {
            localStorage.setItem('darkMode', 'disabled');
            actualizarIcono('☀️', '🌙');
        }
        
        // Disparar evento para otros componentes
        document.dispatchEvent(new CustomEvent('darkModeChanged', {
            detail: { isDark: isDark }
        }));
    }

    // Función para actualizar los iconos de los botones
    function actualizarIcono(iconoOscuro, iconoClaro) {
        const isDark = document.body.classList.contains('dark-mode');
        const btns = document.querySelectorAll('#darkModeToggle, #darkModeToggleAuth');
        
        btns.forEach(btn => {
            if (btn) {
                if (isDark) {
                    btn.textContent = iconoClaro;
                } else {
                    btn.textContent = iconoOscuro;
                }
            }
        });
    }

    // Función para actualizar el texto del botón en auth
    function actualizarTextoAuth() {
        const authBtn = document.getElementById('darkModeToggleAuth');
        if (authBtn) {
            const isDark = document.body.classList.contains('dark-mode');
            authBtn.textContent = isDark ? '☀️ Modo claro' : '🌙 Modo oscuro';
        }
    }

    // Escuchar cambios en el modo oscuro
    document.addEventListener('darkModeChanged', function(e) {
        actualizarTextoAuth();
    });

    // Inicializar texto en auth
    actualizarTextoAuth();

    // Detectar preferencia del sistema (opcional)
    if (!localStorage.getItem('darkMode')) {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (prefersDark) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('darkMode', 'enabled');
            actualizarIcono('🌙', '☀️');
            actualizarTextoAuth();
        }
    }
});

// Función global para cambiar modo (útil para otros scripts)
function toggleDarkModeGlobal() {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
}