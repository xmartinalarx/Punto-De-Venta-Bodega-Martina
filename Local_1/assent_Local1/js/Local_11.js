let inventario = {};
let promotionsData;
let promocionesAplicadas = [];

function aplicarPromociones() {
  if (!promotionsData) {
    console.error('Error: No se han cargado los datos de las promociones.');
    return;
  }

  if (!inventario) {
    console.error('Error: No se han cargado los datos del inventario.');
    return;
  }

  promocionesAplicadas = [];

  for (const productoNombre in inventario) {
    const producto = inventario[productoNombre];
    let mejorPromocion = null;
    let maxDescuento = 0;
    let maxCantidadPromocion = 0;
    let aplicables = 0;

    promotionsData.promociones.forEach(promocion => {

      if (promocion.producto_aplica === productoNombre && inventario[productoNombre].promo === true) {
        let cantidadLlevada = producto.cantidadKilos / producto.precio;
        let vecesAplicable = Math.floor(cantidadLlevada / promocion.Cant_promo);
        let descuentoTotal = promocion.valor_promocion * vecesAplicable;

        // Verificar si esta promoción tiene un descuento mayor y la cantidad llevada es mayor
        if (descuentoTotal > maxDescuento && promocion.Cant_promo * vecesAplicable > maxCantidadPromocion) {
          mejorPromocion = promocion;
          maxDescuento = descuentoTotal;
          maxCantidadPromocion = promocion.Cant_promo * vecesAplicable;
          aplicables = vecesAplicable;
        }
      }
    });

    if (mejorPromocion) {
      let nuevoPrecio = mejorPromocion.valor_promocion;
      let totalKilosAplicados = mejorPromocion.Cant_promo * aplicables;
      let cantidadLlevada = nuevoPrecio;

      producto.precio = nuevoPrecio;
      producto.cantidadKilos = cantidadLlevada * aplicables;
      promocionesAplicadas.push({
        promocion: mejorPromocion.nombre,
        producto: productoNombre,
        vecesAplicables: aplicables
      });
      inventario[productoNombre].promo = false;
    }

  }

  const descuentosDiv = document.querySelector(".Descuentos");
  mostrarPromociones(descuentosDiv);
  updateTotal2();
}


// Función para actualizar una promoción
function actualizarPromocion(productoNombre) {
  promocionesAplicadas = promocionesAplicadas.filter(promocion => promocion.producto !== productoNombre);

  promotionsData.promociones.forEach(promocion => {
    if (promocion.producto_aplica === productoNombre && promocion.promo === false) {
      const producto = inventario[promocion.producto_aplica];
      const cantidadLlevada = producto.cantidadKilos / producto.precio;
      if (cantidadLlevada >= promocion.Cant_promo && promocion.producto_aplica === productoNombre) {
        let vecesAplicable = Math.floor(cantidadLlevada / promocion.Cant_promo);
        console.log(vecesAplicable);
        promocionesAplicadas.push({
          promocion: promocion.nombre,
          producto: promocion.producto_aplica,
          vecesAplicables: vecesAplicable
        });
      }
    }
  });

  const descuentosDiv = document.querySelector(".Descuentos");
  mostrarPromociones(descuentosDiv);
}

// Función para mostrar las promociones en el div de descuentos
function mostrarPromociones(descuentosDiv) {
  promocionesAplicadas.forEach(promocion => {
    const descuentoElementos = document.createElement("div");
    descuentoElementos.textContent = `${promocion.promocion}, LLeva: ${promocion.vecesAplicables}`;
    descuentosDiv.appendChild(descuentoElementos);
  });
}

// Realizar una solicitud AJAX para obtener las promociones del servidor
const xhr = new XMLHttpRequest();
xhr.open('GET', '\\Bodega\\Local_1\\obtener_promociones.php', true);

xhr.onload = function () {
    if (xhr.status === 200) {
        // Parsea los datos JSON recibidos y asigna a promotionsData
        promotionsData = JSON.parse(xhr.responseText);
        
        // Ahora puedes trabajar con las promociones en JavaScript
        
        applyDiscountsBtn.addEventListener("click", () => {
            aplicarPromociones();
        });
    } else {
        console.error('Error al obtener las promociones. Código de estado:', xhr.status);
    }
};

xhr.send(); // Envía la solicitud AJAX

const applyDiscountsBtn = document.querySelector("#apply-discounts-btn");

// Asigna un evento de clic al botón de aplicar descuentos
applyDiscountsBtn.addEventListener("click", () => {
    // Llama a la función aplicarPromociones sin necesidad de pasar promotionsData como parámetro
    aplicarPromociones();
});
function agregarProductoAlCarritoYInventario(nombre, precio, cantidadKilos, unidad) {
  // Agregar el producto al carrito (código existente)
  inventario[nombre] = {
    nombre,
    precio,
    cantidadKilos,
    unidad,
    promo: true
  };

  // Actualizar la interfaz y otros cálculos (código existente)
  // ...
}

// OPEN & CLOSE CART
const cartIcon = document.querySelector("#cart-icon");
const cart = document.querySelector(".cart");

cartIcon.addEventListener("click", () => {
  cart.classList.add("active");
});



// Start when the document is ready
if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", start);
} else {
  start();
}

// =============== START ====================
function start() {
  addEvents();
}

// ============= UPDATE & RERENDER ===========

function update() {
  addEvents();
  updateTotal();
  updateTotal2()
}

// =============== ADD EVENTS ===============
// Asigna la función handle_buyOrder() a los botones de compra una vez al inicio
function addEvents() {
  // Eliminar eventos anteriores para evitar la asignación múltiple de eventos
  let cartRemove_btns = document.querySelectorAll(".cart-remove");
  cartRemove_btns.forEach((btn) => {
    btn.removeEventListener("click", handle_removeCartItem);
    btn.addEventListener("click", handle_removeCartItem);
  });

  var cartQuantity_inputs = document.querySelectorAll(".cart-quantity");
  cartQuantity_inputs.forEach((input) => {
    input.removeEventListener("change", handle_changeItemQuantity);
    input.addEventListener("change", handle_changeItemQuantity);
  });

  let addCart_btns = document.querySelectorAll(".add-cart");
  addCart_btns.forEach((btn) => {
    btn.removeEventListener("click", handle_addCartItem);
    btn.addEventListener("click", handle_addCartItem);
  });
}

// ============= HANDLE EVENTS FUNCTIONS =============

let itemsAdded = [];
var titulo = 0;
var precio = 0;
function handle_addCartItem() {
  let product = this.parentElement;
  let title = product.querySelector(".product-title").innerHTML;
  let price = parseFloat(product.querySelector(".product-price").innerHTML); // Parsea el precio como número
  let imgSrc = product.querySelector(".product-img").src;

  // Verifica si el producto ya está en el inventario
  if (inventario.hasOwnProperty(title)) {
    alert("¡Este producto ya está en la compra!");
    return;
  }

  // Agrega el producto al inventario
  let quantity = 0.00; // Define una cantidad inicial
  let unidad = 0.00; // Define una unidad inicial
  inventario[title] = {
    precio: price,
    cantidadKilos: quantity,
    unidad: unidad,
  };

  // Agrega el producto al carrito visualmente
  let cartBoxElement = CartBoxComponent(title, price, imgSrc);
  let newNode = document.createElement("div");
  newNode.innerHTML = cartBoxElement;
  const cartContent = cart.querySelector(".cart-content");
  cartContent.appendChild(newNode);

  update(); // Actualiza la interfaz
}


function handle_removeCartItem() {
  // Obtén el título del producto que se está eliminando
  const productTitle = this.parentElement.querySelector(".cart-product-title").innerHTML;

  // Elimina el producto del inventario
  if (inventario.hasOwnProperty(productTitle)) {
    delete inventario[productTitle];
  }

  // Elimina el elemento del DOM
  this.parentElement.remove();

  update();
}

function handle_changeItemQuantity() {
  if (isNaN(this.value) || parseFloat(this.value) < 0.0010) {
    this.value = 0.0010;
  }
  update();
}

// Agrega el evento de clic a los botones de pago
const buy_btns = document.querySelectorAll(".btn-pagar");
buy_btns.forEach((btn) => {
  btn.addEventListener("click", () => {
    handle_buyOrder(btn.value); // Pasa el valor del botón como argumento a la función
  });
});

function handle_buyOrder(paymentMethod) {
  // Verifica si se seleccionó un método de pago
  if (!paymentMethod) {
    alert("Por favor, seleccione un método de pago.");
    return;
  }

  // Agrega el método de pago al inventario
  inventario["metodoPago"] = paymentMethod;

  // Envía el inventario al archivo PHP o base de datos
  enviarInventarioAlPHP(inventario)
    .then((result) => {
      if (result === "Éxito") {
        console.error("Error:", error);
        alert("Se produjo un error al realizar la compra. Inténtalo de nuevo.");
      }
    })
    .catch((error) => {
      // Si la compra se realizó con éxito, limpia el inventario y muestra un mensaje de éxito
      inventario = {};
      alert("¡Compra realizada con éxito!");
      // Limpia el carrito de compras y actualiza el total a $0.00
      const cartContent = cart.querySelector(".cart-content");
      cartContent.innerHTML = '';
      const totalElement = cart.querySelector(".total-price");
      totalElement.innerHTML = "$0.00";
      itemsAdded = [];
    });
}

// Función para enviar el inventario al archivo PHP
function enviarInventarioAlPHP(inventario) {
  return new Promise((resolve, reject) => {
    var url = "Recibir.php";
    var data = {
      inventario: inventario
    };
    fetch(url, {
      method: "POST",
      body: JSON.stringify(data),
    })
      .then((response) => response.text())
      .then((result) => {
        console.log("Respuesta del servidor:", result);
        if (result === "Éxito") {
          resolve("Éxito"); // Resuelve la promesa si la compra se realizó con éxito
        } else {
          reject("Error al realizar la compra"); // Rechaza la promesa en caso de error
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        reject("Error al realizar la compra"); // Rechaza la promesa en caso de error
      });
  });
}

// =========== UPDATE & RERENDER FUNCTIONS =========

var Kilitos = 0;

var Money_Total = 0;

var Contador = 0;

function updateTotal() {
  let cartBoxes = document.querySelectorAll(".cart-box");

  

  cartBoxes.forEach((cartBox) => {
    let quantity = parseFloat(cartBox.querySelector(".cart-quantity").value);

    // Acceder a la información del producto en el carrito
    const productTitle = cartBox.querySelector(".cart-product-title").innerHTML;
    const productPrice = parseFloat(cartBox.querySelector(".cart-price").innerHTML);

    // Verificar si la cantidad llevada es mayor a 0.0001
    if (quantity > 0.0001) {
      // Actualizar el inventario con la información del producto
      var Unidads = parseFloat(quantity / productPrice);
      agregarProductoAlCarritoYInventario(productTitle, productPrice, quantity, Unidads); // Asegúrate de proporcionar la información correcta.
    }
  });
}
function updateTotal2(){
  let totalKilitos = 0; // Variable para almacenar la suma de los kilogramos
  for (const key in inventario) {
    if (inventario.hasOwnProperty(key)) {
      const cantidadKilos = parseFloat(inventario[key].cantidadKilos);
      if (!isNaN(cantidadKilos)) {
        totalKilitos += cantidadKilos;
      }
    }
  }
  
  // Mostrar el total en el carrito
  const totalElements = document.querySelector(".cart .total-price");
  totalElements.textContent = `$${totalKilitos.toFixed(2)}`; // Mostrar el total de kilogramos

};




// ============= HTML COMPONENTS =============

function CartBoxComponent(title, price, imgSrc) {

  return `

  <form action="POST">

    <div class="cart-box">

        <img src=${imgSrc} alt="" class="cart-img">

        <div class="detail-box">

            <div class="cart-product-title" name="titulo">${title}</div>

            <div class="cart-price" name = "precio">${price}</div>

            <input type="number" name = "Kilitos" inputmode="numeric" value="" class="cart-quantity">

        </div>

        <!-- REMOVE CART  -->

        <i name="eliminar" class='bx bxs-trash-alt cart-remove'></i>

    </div>

  </form>

  </a>`;
}
console.log("Inventario:", inventario);
function reloadPage() {
  window.location.reload();
}