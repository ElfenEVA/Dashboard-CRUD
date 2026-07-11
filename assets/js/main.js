// Funcionalidad para editar registros
function editarRegistro(id) {
    // Obtener datos del registro mediante AJAX
    fetch(`actions/get_data.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_titulo').value = data.titulo;
                document.getElementById('edit_url').value = data.url;
                document.getElementById('edit_descripcion').value = data.descripcion;
                document.getElementById('edit_categoria').value = data.categoria;
                
                document.getElementById('editModal').style.display = 'block';
            } else {
                alert('Error al cargar los datos');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar los datos');
        });
}

// Cerrar modal
document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('editModal').style.display = 'none';
});

// Cerrar modal al hacer clic fuera
window.addEventListener('click', function(event) {
    const modal = document.getElementById('editModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});

// Auto-ocultar alertas después de 5 segundos
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(function() {
            alert.style.display = 'none';
        }, 500);
    });
}, 5000);

// Validación de formularios
document.addEventListener('DOMContentLoaded', function() {
    // Validar que los campos no estén vacíos en el formulario de creación
    const createForm = document.getElementById('createForm');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            const titulo = document.getElementById('titulo').value.trim();
            const url = document.getElementById('url').value.trim();
            const categoria = document.getElementById('categoria').value.trim();
            
            if (!titulo || !url || !categoria) {
                e.preventDefault();
                alert('Por favor completa todos los campos obligatorios');
            }
        });
    }
    
    // Validar que los campos no estén vacíos en el formulario de edición
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            const titulo = document.getElementById('edit_titulo').value.trim();
            const url = document.getElementById('edit_url').value.trim();
            const categoria = document.getElementById('edit_categoria').value.trim();
            
            if (!titulo || !url || !categoria) {
                e.preventDefault();
                alert('Por favor completa todos los campos obligatorios');
            }
        });
    }
});
// assets/js/main.js - Agregar función para cerrar modal
function cerrarModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Función para editar registros
function editarRegistro(id) {
    fetch(`actions/get_data.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_titulo').value = data.titulo;
                document.getElementById('edit_url').value = data.url;
                document.getElementById('edit_descripcion').value = data.descripcion;
                document.getElementById('edit_categoria').value = data.categoria;
                
                document.getElementById('editModal').style.display = 'block';
            } else {
                alert('Error al cargar los datos');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar los datos');
        });
}

// Cerrar modal con el botón X
document.querySelector('.close')?.addEventListener('click', function() {
    document.getElementById('editModal').style.display = 'none';
});

// Cerrar modal al hacer clic fuera
window.addEventListener('click', function(event) {
    const modal = document.getElementById('editModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});

// Auto-ocultar alertas después de 5 segundos
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(function() {
            alert.style.display = 'none';
        }, 500);
    });
}, 5000);