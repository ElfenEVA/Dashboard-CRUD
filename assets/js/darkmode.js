// assets/js/darkmode.js - Versión final

document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = document.getElementById('darkModeIcon');
    const darkModeText = document.getElementById('darkModeText');
    
    if (!darkModeToggle) return;

    const savedMode = localStorage.getItem('darkMode') || 'disabled';
    const savedTheme = localStorage.getItem('selectedTheme') || 'default';
    
    if (savedMode === 'enabled') {
        document.body.classList.add('dark-mode');
        if (savedTheme !== 'default') {
            document.body.classList.add(`theme-${savedTheme}`);
        }
        if (darkModeIcon) darkModeIcon.textContent = '☀️';
        if (darkModeText) darkModeText.textContent = 'Desactivar tema';
    }

    darkModeToggle.addEventListener('click', function() {
        const isDark = document.body.classList.toggle('dark-mode');
        
        if (isDark) {
            localStorage.setItem('darkMode', 'enabled');
            if (darkModeIcon) darkModeIcon.textContent = '☀️';
            if (darkModeText) darkModeText.textContent = 'Desactivar tema';
            
            const savedTheme = localStorage.getItem('selectedTheme') || 'default';
            if (savedTheme !== 'default') {
                document.body.classList.add(`theme-${savedTheme}`);
            }
        } else {
            localStorage.setItem('darkMode', 'disabled');
            if (darkModeIcon) darkModeIcon.textContent = '🌙';
            if (darkModeText) darkModeText.textContent = 'Activar tema';
            
            const savedTheme = localStorage.getItem('selectedTheme') || 'default';
            if (savedTheme !== 'default') {
                document.body.classList.remove(`theme-${savedTheme}`);
            }
        }
    });
});