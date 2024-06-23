
function mostrarCampos() {
    var select = document.getElementById("promotion");
    var fields = document.getElementById("editFields");
    var selectedOption = select.options[select.selectedIndex];
    
    document.getElementById("nombre").value = selectedOption.getAttribute("data-nombre");
    document.getElementById("valor_promocion").value = selectedOption.getAttribute("data-valor_promocion");
    document.getElementById("Cant_promo").value = selectedOption.getAttribute("data-Cant_promo");
    
    fields.style.display = "block";
}
/* mostar acciones */
function editPromotionForm() {
    document.getElementById('editPromotionForm').style.display = 'block';
    document.getElementById('addProductForm').style.display = 'none';
    document.getElementById('deleteProductForm').style.display = 'none';
    document.getElementById('editProductForm').style.display = 'none';
    document.getElementById('addKilosForm').style.display = 'none';
    document.getElementById('sendKilosForm').style.display = 'none';
    document.getElementById('addPromotionForm').style.display = 'none';
    document.getElementById('deletePromotionForm').style.display = 'none';
}
function showAddProductForm() {
    document.getElementById('addProductForm').style.display = 'block';
    document.getElementById('deleteProductForm').style.display = 'none';
    document.getElementById('editProductForm').style.display = 'none';
    document.getElementById('addKilosForm').style.display = 'none';
    document.getElementById('sendKilosForm').style.display = 'none';
    document.getElementById('addPromotionForm').style.display = 'none';
    document.getElementById('deletePromotionForm').style.display = 'none';
    document.getElementById('editPromotionForm').style.display = 'none';
}

function showDeleteProductForm() {
    document.getElementById('deleteProductForm').style.display = 'block';
    document.getElementById('addProductForm').style.display = 'none';
    document.getElementById('editProductForm').style.display = 'none';
    document.getElementById('addKilosForm').style.display = 'none';
    document.getElementById('sendKilosForm').style.display = 'none';
    document.getElementById('addPromotionForm').style.display = 'none';
    document.getElementById('deletePromotionForm').style.display = 'none';
    document.getElementById('editPromotionForm').style.display = 'none';
}

function showEditProductForm() {
    document.getElementById('editProductForm').style.display = 'block';
    document.getElementById('addProductForm').style.display = 'none';
    document.getElementById('deleteProductForm').style.display = 'none';
    document.getElementById('addKilosForm').style.display = 'none';
    document.getElementById('sendKilosForm').style.display = 'none';
    document.getElementById('addPromotionForm').style.display = 'none';
    document.getElementById('deletePromotionForm').style.display = 'none';
    document.getElementById('editPromotionForm').style.display = 'none';
}
function showAddKilosForm() {
    document.getElementById('addKilosForm').style.display = 'block';
    document.getElementById('editProductForm').style.display = 'none';
    document.getElementById('addProductForm').style.display = 'none';
    document.getElementById('deleteProductForm').style.display = 'none';
    document.getElementById('sendKilosForm').style.display = 'none';
    document.getElementById('addPromotionForm').style.display = 'none';
    document.getElementById('deletePromotionForm').style.display = 'none';
    document.getElementById('editPromotionForm').style.display = 'none';
}
function AddPromo(){
    document.getElementById('addPromotionForm').style.display = 'block';
    document.getElementById('addKilosForm').style.display = 'none';
    document.getElementById('editProductForm').style.display = 'none';
    document.getElementById('addProductForm').style.display = 'none';
    document.getElementById('deleteProductForm').style.display = 'none';
    document.getElementById('sendKilosForm').style.display = 'none';
    document.getElementById('deletePromotionForm').style.display = 'none';
    document.getElementById('editPromotionForm').style.display = 'none';


}
function showSendKilosForm() {
    document.getElementById('sendKilosForm').style.display = 'block';
    document.getElementById('editProductForm').style.display = 'none';
    document.getElementById('addProductForm').style.display = 'none';
    document.getElementById('deleteProductForm').style.display = 'none';
    document.getElementById('addKilosForm').style.display = 'none';
    document.getElementById('addPromotionForm').style.display = 'none';
    document.getElementById('deletePromotionForm').style.display = 'none';
    document.getElementById('editPromotionForm').style.display = 'none';
    
}
function deletePromotionForm() {
    document.getElementById('deletePromotionForm').style.display = 'block';
    document.getElementById('sendKilosForm').style.display = 'none';
    document.getElementById('editProductForm').style.display = 'none';
    document.getElementById('addProductForm').style.display = 'none';
    document.getElementById('deleteProductForm').style.display = 'none';
    document.getElementById('addKilosForm').style.display = 'none';
    document.getElementById('addPromotionForm').style.display = 'none';
    document.getElementById('editPromotionForm').style.display = 'none';
    
}

// Función para agregar kilos
function addKilos() {
    var productName = document.getElementById('productNameKilos').value;
    var kilos = document.getElementById('kilos').value;

    // Implementa la lógica para agregar los kilos al producto especificado
    console.log('Agregando ', kilos, 'kilos de ', productName);
    location.reload();
}
/* funciones probedores */
function agregarProvedor() {
    document.getElementById('agregarProvedores2').style.display = 'block';
    document.getElementById('agregarProducto').style.display = 'none';
    document.getElementById('Rentabilidad').style.display = 'none';
    document.getElementById('eliminarRentabilidad').style.display = 'none';
}
function agregarProducto() {
    document.getElementById('agregarProducto').style.display = 'block';
    document.getElementById('agregarProvedores2').style.display = 'none';
    document.getElementById('Rentabilidad').style.display = 'none';
    document.getElementById('eliminarRentabilidad').style.display = 'none';
}
function Rentabilidad() {
    document.getElementById('Rentabilidad').style.display = 'block';
    document.getElementById('agregarProducto').style.display = 'none';
    document.getElementById('agregarProvedores2').style.display = 'none';
    document.getElementById('eliminarRentabilidad').style.display = 'none';

}
function eliminarRentabilidad() {
    document.getElementById('eliminarRentabilidad').style.display = 'block';
    document.getElementById('Rentabilidad').style.display = 'none';
    document.getElementById('agregarProducto').style.display = 'none';
    document.getElementById('agregarProvedores2').style.display = 'none';
}
/* bodega */
function Pollo() {
    document.getElementById('Pollo').style.display = 'block';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Promociones').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Cerdo() {
    document.getElementById('Cerdo').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Promociones').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Vacuno() {
    document.getElementById('Vacuno').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Promociones').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Pavo() {
    document.getElementById('Pavo').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Promociones').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Embutidos() {
    document.getElementById('Embutidos').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Promociones').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Congelados() {
    document.getElementById('Congelados').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Promociones').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Promociones() {
    document.getElementById('Promociones').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Abarrotes() {
    document.getElementById('Abarrotes').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Promociones').style.display = 'none';
}

/* local 1 */
function Pollo1() {
    document.getElementById('Pollo1').style.display = 'block';
    document.getElementById('Cerdo1').style.display = 'none';
    document.getElementById('Vacuno1').style.display = 'none';
    document.getElementById('Embutidos1').style.display = 'none';
    document.getElementById('Congelados1').style.display = 'none';
    document.getElementById('Pavo1').style.display = 'none';
    document.getElementById('Promociones1').style.display = 'none';
    document.getElementById('Abarrotes1').style.display = 'none';
}
function Cerdo1() {
    document.getElementById('Cerdo1').style.display = 'block';
    document.getElementById('Pollo1').style.display = 'none';
    document.getElementById('Vacuno1').style.display = 'none';
    document.getElementById('Embutidos1').style.display = 'none';
    document.getElementById('Congelados1').style.display = 'none';
    document.getElementById('Pavo1').style.display = 'none';
    document.getElementById('Promociones1').style.display = 'none';
    document.getElementById('Abarrotes1').style.display = 'none';
}
function Vacuno1() {
    document.getElementById('Vacuno1').style.display = 'block';
    document.getElementById('Pollo1').style.display = 'none';
    document.getElementById('Cerdo1').style.display = 'none';
    document.getElementById('Embutidos1').style.display = 'none';
    document.getElementById('Congelados1').style.display = 'none';
    document.getElementById('Pavo1').style.display = 'none';
    document.getElementById('Promociones1').style.display = 'none';
    document.getElementById('Abarrotes1').style.display = 'none';
}
function Pavo1() {
    document.getElementById('Pavo1').style.display = 'block';
    document.getElementById('Pollo1').style.display = 'none';
    document.getElementById('Cerdo1').style.display = 'none';
    document.getElementById('Vacuno1').style.display = 'none';
    document.getElementById('Embutidos1').style.display = 'none';
    document.getElementById('Congelados1').style.display = 'none';
    document.getElementById('Promociones1').style.display = 'none';
    document.getElementById('Abarrotes1').style.display = 'none';
}
function Embutidos1() {
    document.getElementById('Embutidos1').style.display = 'block';
    document.getElementById('Pollo1').style.display = 'none';
    document.getElementById('Cerdo1').style.display = 'none';
    document.getElementById('Vacuno1').style.display = 'none';
    document.getElementById('Pavo1').style.display = 'none';
    document.getElementById('Congelados1').style.display = 'none';
    document.getElementById('Promociones1').style.display = 'none';
    document.getElementById('Abarrotes1').style.display = 'none';
}
function Congelados1() {
    document.getElementById('Congelados1').style.display = 'block';
    document.getElementById('Pollo1').style.display = 'none';
    document.getElementById('Cerdo1').style.display = 'none';
    document.getElementById('Vacuno1').style.display = 'none';
    document.getElementById('Pavo1').style.display = 'none';
    document.getElementById('Embutidos1').style.display = 'none';
    document.getElementById('Promociones1').style.display = 'none';
    document.getElementById('Abarrotes1').style.display = 'none';
}
function Promociones1() {
    document.getElementById('Promociones1').style.display = 'block';
    document.getElementById('Pollo1').style.display = 'none';
    document.getElementById('Cerdo1').style.display = 'none';
    document.getElementById('Vacuno1').style.display = 'none';
    document.getElementById('Pavo1').style.display = 'none';
    document.getElementById('Congelados1').style.display = 'none';
    document.getElementById('Embutidos1').style.display = 'none';
    document.getElementById('Abarrotes1').style.display = 'none';
}
function Abarrotes1() {
    document.getElementById('Abarrotes1').style.display = 'block';
    document.getElementById('Pollo1').style.display = 'none';
    document.getElementById('Cerdo1').style.display = 'none';
    document.getElementById('Vacuno1').style.display = 'none';
    document.getElementById('Pavo1').style.display = 'none';
    document.getElementById('Congelados1').style.display = 'none';
    document.getElementById('Embutidos1').style.display = 'none';
    document.getElementById('Promociones1').style.display = 'none';
}
/* local 2 */
function Pollo2() {
    document.getElementById('Pollo2').style.display = 'block';
    document.getElementById('Cerdo2').style.display = 'none';
    document.getElementById('Vacuno2').style.display = 'none';
    document.getElementById('Embutidos2').style.display = 'none';
    document.getElementById('Congelados2').style.display = 'none';
    document.getElementById('Pavo2').style.display = 'none';
    document.getElementById('Promociones2').style.display = 'none';
    document.getElementById('Abarrotes2').style.display = 'none';
}
function Cerdo2() {
    document.getElementById('Cerdo2').style.display = 'block';
    document.getElementById('Pollo2').style.display = 'none';
    document.getElementById('Vacuno2').style.display = 'none';
    document.getElementById('Embutidos2').style.display = 'none';
    document.getElementById('Congelados2').style.display = 'none';
    document.getElementById('Pavo2').style.display = 'none';
    document.getElementById('Promociones2').style.display = 'none';
    document.getElementById('Abarrotes2').style.display = 'none';
}
function Vacuno2() {
    document.getElementById('Vacuno2').style.display = 'block';
    document.getElementById('Pollo2').style.display = 'none';
    document.getElementById('Cerdo2').style.display = 'none';
    document.getElementById('Embutidos2').style.display = 'none';
    document.getElementById('Congelados2').style.display = 'none';
    document.getElementById('Pavo2').style.display = 'none';
    document.getElementById('Promociones2').style.display = 'none';
    document.getElementById('Abarrotes2').style.display = 'none';
}
function Pavo2() {
    document.getElementById('Pavo2').style.display = 'block';
    document.getElementById('Pollo2').style.display = 'none';
    document.getElementById('Cerdo2').style.display = 'none';
    document.getElementById('Vacuno2').style.display = 'none';
    document.getElementById('Embutidos2').style.display = 'none';
    document.getElementById('Congelados2').style.display = 'none';
    document.getElementById('Promociones2').style.display = 'none';
    document.getElementById('Abarrotes2').style.display = 'none';
}
function Embutidos2() {
    document.getElementById('Embutidos2').style.display = 'block';
    document.getElementById('Pollo2').style.display = 'none';
    document.getElementById('Cerdo2').style.display = 'none';
    document.getElementById('Vacuno2').style.display = 'none';
    document.getElementById('Pavo2').style.display = 'none';
    document.getElementById('Congelados2').style.display = 'none';
    document.getElementById('Promociones2').style.display = 'none';
    document.getElementById('Abarrotes2').style.display = 'none';
}
function Congelados2() {
    document.getElementById('Congelados2').style.display = 'block';
    document.getElementById('Pollo2').style.display = 'none';
    document.getElementById('Cerdo2').style.display = 'none';
    document.getElementById('Vacuno2').style.display = 'none';
    document.getElementById('Pavo2').style.display = 'none';
    document.getElementById('Embutidos2').style.display = 'none';
    document.getElementById('Promociones2').style.display = 'none';
    document.getElementById('Abarrotes2').style.display = 'none';
}
function Promociones2() {
    document.getElementById('Promociones2').style.display = 'block';
    document.getElementById('Pollo2').style.display = 'none';
    document.getElementById('Cerdo2').style.display = 'none';
    document.getElementById('Vacuno2').style.display = 'none';
    document.getElementById('Pavo2').style.display = 'none';
    document.getElementById('Congelados2').style.display = 'none';
    document.getElementById('Embutidos2').style.display = 'none';
    document.getElementById('Abarrotes2').style.display = 'none';
}
function Abarrotes2() {
    document.getElementById('Abarrotes2').style.display = 'block';
    document.getElementById('Pollo2').style.display = 'none';
    document.getElementById('Cerdo2').style.display = 'none';
    document.getElementById('Vacuno2').style.display = 'none';
    document.getElementById('Pavo2').style.display = 'none';
    document.getElementById('Congelados2').style.display = 'none';
    document.getElementById('Embutidos2').style.display = 'none';
    document.getElementById('Promociones2').style.display = 'none';
}
/*  */ 
document.addEventListener("DOMContentLoaded", function() {
    // Obtener el select y los divs
    const select = document.getElementById("select_e_a");
    const agregarDiv = document.getElementById("agregar");
    const eliminarDiv = document.getElementById("eliminar");
    const editarDiv = document.getElementById("editar");

    // Agregar evento change al select
    select.addEventListener("change", function() {
        // Ocultar todos los divs
        agregarDiv.style.display = "none";
        eliminarDiv.style.display = "none";
        editarDiv.style.display = "none";

        // Obtener el valor seleccionado
        const seleccionado = select.value;

        // Mostrar el div correspondiente al valor seleccionado
        if (seleccionado === "agregar") {
            agregarDiv.style.display = "block";
        } else if (seleccionado === "eliminar") {
            eliminarDiv.style.display = "block";
        } else if (seleccionado === "editar") {
            editarDiv.style.display = "block";
        }
    });
});
function reloadPage(){
    location.reload(); // Recargar la página
}
function volver(){
    location.href = "Administrador.php";
}
// Función para mostrar el formulario de enviar kilos
/* slide */
function toggleSidebar() {
    var sidebar = document.getElementById('slidebar');
    var toggleBtn = document.getElementById('toggle-sidebar-btn');

    if (sidebar) {
        sidebar.classList.toggle('hidden');

        // Cambiar el texto del botón según el estado de la barra lateral
        if (sidebar.classList.contains('hidden')) {
            toggleBtn.textContent = 'Mostrar Barra Lateral';
        } else {
            toggleBtn.textContent = 'Ocultar Barra Lateral';
        }
    } else {
        console.error("El elemento 'sidebar' no se encontró en el DOM.");
    }
}

document.addEventListener("DOMContentLoaded", function() {
    // Tu código JavaScript aquí
    // Aquí puedes colocar otros eventos o inicializaciones si es necesario
});


// Variable global para almacenar el estado actual de la slide
let currentSlide = 'ventas'; // Establece la slide por defecto al cargar la página

// Función para mostrar una slide específica
/* -------------------- */
