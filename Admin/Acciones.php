<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bodega/Admin/assent/css/index_admin1.css">
    <title>Acciones</title>
</head>
<body>
    <style>
        
.lds-ring,
.lds-ring div {
  box-sizing: border-box;
}
.lds-ring {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 64px;
  height: 64px;
  margin: 8px;
  border: 8px solid currentColor;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  border-color: currentColor transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


    </style>
<div class="centrado" id="carga"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div><!-- loader -->    
            <div class="sidebar" id="slidebar">
                <!-- Contenido de la barra lateral -->
                <ul>
                <li><h3><a href="Administrador.php" class="logo"><span>Bodega</span>Martina</a></h3></li>
                    <li><a href="Local1.php">Local 1</a></li>
                    <li><a href="Local2.php">Local 2</a></li>
                    <li><a href="Bodega.php">Bodega</a></li>
                    <li><a href="Acciones.php">Acciones</a></li>
                    <li><a href="Ventas_locales.php">Ventas Locales</a></li>
                    <li><a href="Rentabilidades.php">Rentabilidad</a></li>
                    <li><a href="SacarTotal.php">Sacar Total</a></li>
                    <li><a href="Vermov.php">Movimientos bodega</a></li>
                </ul>
            </div>
            <button class="toggle-sidebar-btn" id="toggle-sidebar-btn" onclick="toggleSidebar()">
                <p>Ocultar Barra Lateral</p>
            </button>
    <main class="cont">
        <?php
            date_default_timezone_set('America/Santiago');
            include("conexion.php");
            
        ?>
        <center>
        <div class="arriva"><h3 class ="logo3"><a class="logo"><span>Bodega</span>Martina</a></h3></div>
            <div id="ventas" class="slide">
                <h2>Acciones</h2>
                <div class="botones-acciones">
                    <button class="btn-agregar-producto" onclick="showAddProductForm()">Agregar Producto</button>
                    <button class="btn-eliminar-producto" onclick="showDeleteProductForm()">Eliminar Producto</button>
                    <button class="btn-editar-producto" onclick="showEditProductForm()">Editar Producto</button>
                    <button class="btn-agregar-kilos" onclick="showAddKilosForm()">Agregar Kilos</button>
                    <button class="btn-enviar-kilos" onclick="showSendKilosForm()">Enviar Kilos</button>
                    <button class="btn-agregar-promo" onclick="AddPromo()">Agregar Promocion</button>
                    <button class="btn-eliminar-promo btn-eliminar-producto" onclick="deletePromotionForm()">Eliminar Promocion</button>
                    <button class="btn-edit-promo btn-editar-producto" onclick="editPromotionForm()">Editar Promocion</button>
                </div>
                <div id="addProductForm">
                    <h3>Agregar Producto</h3>
                    <form method="post" enctype="multipart/form-data" onsubmit="reloadPage()">
                        <label for="productName">Nombre:</label><br>
                        <input type="text" id="productName" name="productName" placeholder="Agregar Nombre aquí"><br>
                        <label for="productPrice">Precio:</label><br>
                        <input type="number" id="productPrice" name="productPrice"placeholder="Agregar Precio aquí"><br>
                        <label for="tipo">Tipo:</label><br>
                        <select id="tipo" name="tipo">
                            <option value="Seleccione">Seleccione una Opción</option>
                            <option value="Pollo">Pollo</option>
                            <option value="Pavo">Pavo</option>
                            <option value="Cerdo">Cerdo</option>
                            <option value="Vacuno">Vacuno</option>
                            <option value="Enbutidos">Enbutidos</option>
                            <option value="Congelados">Congelados</option>
                            <option value="Abarrotes">Abarrotes</option>
                        </select><br>
                        <label for="productImage" class="image-upload">
                            <span>Seleccionar Imagen</span>
                            <input type="file" id="productImage" name="productImage">
                        </label><br>
                        <button type="submit" onclick="reloadPage()" name="Boton_enviar">Agregar</button>
                    </form>
                    <!-- 1 -->
                    <?php
                    if(isset($_POST['Boton_enviar'])){
                    // Directorio donde se almacenarán las imágenes
                    $directorioImagenes = "assent/img/Productos/";

                    // Verificar si se ha enviado un archivo
                    if(isset($_FILES['productImage'])){
                        $nombreArchivo = $_FILES['productImage']['name'];
                        $rutaTemporal = $_FILES['productImage']['tmp_name'];
                        $rutaDestino = $directorioImagenes . $nombreArchivo;

                        // Verificar si el producto ya existe con el mismo nombre
                        $nombreProducto = $_POST['productName'];
                        $sql_check = "SELECT * FROM productos WHERE nombre_Producto = '$nombreProducto'";
                        $sql_check2 = "SELECT * FROM bodega WHERE Nombre_producto = '$nombreProducto'";
                        $result_check = $conn->query($sql_check);
                        $result_check2 = $conn->query($sql_check2);
                        if ($result_check->num_rows > 0 && $result_check2->num_rows > 0 ) {
                            echo "<script>alert('El producto ya existe.')</script>";
                        } else {
                            // Mover el archivo desde la ruta temporal al directorio de imágenes
                            if(move_uploaded_file($rutaTemporal, $rutaDestino)){
                                // Obtener otros datos del formulario
                                $precio = $_POST['productPrice'];
                                $tipo = $_POST['tipo'];
                                $currentDate = date("d-m-Y");
                                $currentDate2 = date("m-Y");

                                // Preparar la consulta SQL para insertar los datos en la tabla
                                $sql = "INSERT INTO productos (nombre_Producto, Precio_Producto, Tipo, img) VALUES ('$nombreProducto', '$precio', '$tipo', '$rutaDestino')";
                                $sqlb = "INSERT INTO `bodega`(`Nombre_producto`, `Cantidad_Camara`, `Fecha_Ingreso`, `Mes_Ingreso`, `Tipo`,`img`) VALUES ('$nombreProducto','0','$currentDate','$currentDate2','$tipo','$rutaDestino')";
                                // Ejecutar la consulta
                                if ($conn->query($sql) === TRUE && $conn->query($sqlb) === True) {
                                    echo "<script>alert('Producto agregado correctamente.')</script>";
                                } else {
                                    // Si hay un error en la consulta SQL, eliminar la imagen
                                    unlink($rutaDestino);
                                    echo "<script>alert('Error al agregar el producto: " . $conn->error . "')</script>";
                                }
                            } else {
                                echo "<script>alert('Error al subir la imagen ')</script>";
                            }
                        }
                    }

                    // Cerrar la conexión
                    
                }
                    ?>
                    <!-- /1 -->
                </div>
                <div id="deleteProductForm">
                    <h3>Eliminar Producto</h3>
                    <form method="post" >
                        <label for="nombreProducto">Nombre del Producto:</label>
                        <?php 
                        $sql = "SELECT nombre_Producto FROM productos";
                        $result = $conn->query($sql);
                        
                        // Arreglo para almacenar los nombres de productos
                        $productos = array();
                        
                        // Verificar si se encontraron resultados
                        if ($result->num_rows > 0) {
                            // Almacenar los nombres de productos en el arreglo
                            while ($row = $result->fetch_assoc()) {
                                $productos[] = $row["nombre_Producto"];
                            }
                        }
                        
                        ?>
                        <select id="nombreProducto" name="nombreProductos">
                            <option value="Seleccione">Seleccione una Opción</option>
                            <?php
                            // Iterar sobre los nombres de productos y mostrarlos en el select
                            foreach ($productos as $producto) {
                                echo "<option value='$producto'>$producto</option>";
                            }
                            ?>
                        </select><br>

                        <label for="ubicacion">Ubicación:</label><br>
                        <select id="ubicacion" name="ubicacions">
                            <option value="Seleccione">Seleccione una Opción</option>
                            <option value="productos">Productos Y Bodega</option>
                            <option value="local1">Local 1</option>
                            <option value="local2">Local 2</option>
                            <option value="todas">Todas</option>
                        </select><br>

                        <button type="submit" onclick="reloadPage()" name="Boton_eliminar">Eliminar</button>
                    </form>
                    <?php
                    if(isset($_POST['Boton_eliminar'])) {
                        $nombreProducto = $_POST['nombreProductos'];
                        $ubicacion = $_POST['ubicacions'];
                        
                        // Verificar si se ha seleccionado un producto antes de intentar eliminarlo
                        if($nombreProducto !== 'Seleccione' && $ubicacion !== 'Seleccione') {
                            // Consulta SQL para eliminar el producto según la ubicación
                            if ($ubicacion === 'todas') {
                                // Eliminar de todas las ubicaciones
                                $sql1 = "DELETE FROM bodega WHERE Nombre_producto = '$nombreProducto'";
                                $sql2 = "DELETE FROM local_1 WHERE Nombre_Producto = '$nombreProducto'";
                                $sql3 = "DELETE FROM local_2 WHERE Nombre_Producto = '$nombreProducto'";
                                $sql4 = "DELETE FROM productos WHERE nombre_Producto = '$nombreProducto'";
                                
                                // Ejecutar las consultas SQL
                                if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql4) === TRUE) {
                                    echo "<script>alert('Producto eliminado de todas las ubicaciones')</script>";
                                } else {
                                    // Mostrar el error SQL si ocurre
                                    echo "<script>alert('Error al eliminar el producto de todas las ubicaciones: " . $conn->error . "')</script>";
                                }
                            } else {
                                // Eliminar de una ubicación específica
                                switch ($ubicacion) {
                                    case 'local1':
                                        $sql = "DELETE FROM local_1 WHERE Nombre_Producto = '$nombreProducto'";
                                        break;
                                    case 'local2':
                                        $sql = "DELETE FROM local_2 WHERE Nombre_Producto = '$nombreProducto'";
                                        break;
                                    case 'productos':
                                        $sql = "DELETE FROM productos WHERE nombre_Producto = '$nombreProducto'";
                                        $sql2 = "DELETE FROM bodega WHERE Nombre_producto = '$nombreProducto'";
                                        break;
                                    default:
                                }
                                
                                // Ejecutar la consulta SQL
                                if (isset($sql) && $conn->query($sql) === TRUE) {
                                    // Mostrar el mensaje de alerta adecuadamente después de la ejecución de la consulta SQL
                                    echo "<script>alert('Producto eliminado correctamente.')</script>";
                                } else {
                                    // Mostrar el error SQL si ocurre
                                    echo "<script>alert('Error al eliminar el producto: " . $conn->error . "')</script>";
                                }
                            }
                        } else {
                            echo "<script>alert('Por favor, seleccione un producto y una ubicación válida.')</script>";
                        }
                    }
                    ?>
                    
                </div>
                <div id="editProductForm">
                    <h3>Editar Producto</h3>
                    <form method="post" enctype="multipart/form-data" id="editForm" >
                        <?php 
                            $sql = "SELECT nombre_Producto FROM productos";
                            $result = $conn->query($sql);
                            
                            // Arreglo para almacenar los nombres de productos
                            $productos = array();
                            
                            // Verificar si se encontraron resultados
                            if ($result->num_rows > 0) {
                                // Almacenar los nombres de productos en el arreglo
                                while ($row = $result->fetch_assoc()) {
                                    $productos[] = $row["nombre_Producto"];
                                }
                            }
                        ?>
                        <label for="editProductName">Nombre del Producto:</label>
                        <select id="editProductName" name="editProductName" required>
                            <option value="Seleccione">Seleccione una Opción</option>
                            <?php
                            // Iterar sobre los nombres de productos y mostrarlos en el select
                            foreach ($productos as $producto) {
                                echo "<option value='$producto'>$producto</option>";
                            }
                            ?>
                        </select><br>    
                        <label for="editField">Campo a editar:</label><br>
                        <select id="editField" name="editField">
                            <option value="Seleccione">Seleccione una Opción</option>
                            <option value="nombre">Nombre</option>
                            <option value="imagen">Imagen</option>
                            <option value="precio">Precio</option>
                        </select><br>

                        <!-- Input oculto de tipo file -->
                        <input type="file" id="imageInput" name="editValue" style="display: none;">

                        <!-- Input para editar el nombre -->
                        <div id="editProductNameContainer" style="display: none;">
                            <label for="editProductNameInput">Nuevo Nombre del Producto:</label><br>
                            <input type="text" id="editProductNameInput" name="editProductNameInput" placeholder="Ingrese nuevo nombre del producto"><br>
                        </div>

                        <!-- Input para editar el precio -->
                        <div id="editPriceContainer" style="display: none;">
                            <label for="editPriceInput">Nuevo Precio:</label><br>
                            <input type="number" id="editPriceInput" name="editPriceInput" placeholder="Ingrese el nuevo Precio"><br>
                        </div>

                        <!-- Botón para enviar el formulario -->
                        <button type="submit" name="Boton_editar" onclick="reloadPage()">Editar</button>
                    </form>
                    <script>
                    document.getElementById('editField').addEventListener('change', function() {
                        var editField = this.value;
                        var editProductNameContainer = document.getElementById('editProductNameContainer');
                        var editPriceContainer = document.getElementById('editPriceContainer');
                        var imageInput = document.getElementById('imageInput');

                        // Ocultar todos los campos
                        editProductNameContainer.style.display = 'none';
                        editPriceContainer.style.display = 'none';
                        imageInput.style.display = 'none';

                        // Mostrar el campo relevante según la opción seleccionada
                        if (editField === 'nombre') {
                            editProductNameContainer.style.display = 'block';
                        } else if (editField === 'imagen') {
                            imageInput.style.display = 'block';
                        } else if (editField === 'precio') {
                            editPriceContainer.style.display = 'block';
                        }
                    });

                    document.getElementById('editForm').addEventListener('submit', function(event) {
                        var editField = document.getElementById('editField').value;
                        var imageInput = document.getElementById('imageInput');
                        var editProductNameInput = document.getElementById('editProductNameInput');
                        var editPriceInput = document.getElementById('editPriceInput');
                        
                        // Si se selecciona 'Imagen' y no se ha seleccionado ningún archivo, prevenir el envío del formulario.
                        if (editField === 'imagen' && imageInput.files.length === 0) {
                            alert('Por favor seleccione una imagen.');
                            event.preventDefault();
                        }

                        // Validar si se han ingresado datos en los campos de texto requeridos
                        if ((editField === 'nombre' && editProductNameInput.value.trim() === '') || (editField === 'precio' && editPriceInput.value.trim() === '')) {
                            alert('Por favor complete todos los campos requeridos.');
                            event.preventDefault();
                        }
                    });
                </script>
                <?php
                if(isset($_POST["Boton_editar"])) {
                    // Verificar si se han recibido todos los datos del formulario
                    if(isset($_POST['editProductName']) && isset($_POST['editField'])) {
                        $editProductName = $_POST['editProductName'];
                        $editField = $_POST['editField'];
                        
                        // Verificar si se ha seleccionado un producto antes de intentar editarlo
                        if($editProductName !== 'Seleccione' && $editField !== 'Seleccione') {
                            // Consulta SQL para actualizar el producto según el campo especificado
                            switch ($editField) {
                                case 'nombre':
                                    // Verificar si se proporcionó un nuevo nombre
                                    if(isset($_POST['editProductNameInput'])) {
                                        $editValue = $_POST['editProductNameInput'];
                                        $sql = "UPDATE productos SET nombre_Producto = '$editValue' WHERE nombre_Producto = '$editProductName'";
                                        $sql_bodega = "UPDATE bodega SET Nombre_producto = '$editValue' WHERE Nombre_producto = '$editProductName'";
                                        $sql_local1 = "UPDATE local_1 SET Nombre_Producto = '$editValue' WHERE Nombre_Producto = '$editProductName'";
                                        $sql_local2 = "UPDATE local_2 SET Nombre_Producto = '$editValue' WHERE Nombre_Producto = '$editProductName'";
                                    }
                                    break;
                                case 'imagen':
                                    // Verificar si se ha subido una nueva imagen
                                    if(isset($_FILES['editValue']) && $_FILES['editValue']['error'] === UPLOAD_ERR_OK) {
                                        $newImageName = $_FILES['editValue']['name'];
                                        $newImagePath = "assent/img/Productos" . $newImageName; // Ruta completa de la nueva imagen

                                        // Consulta SQL para obtener la URL completa de la imagen anterior
                                        $sqlGetOldImage = "SELECT img FROM productos WHERE nombre_Producto = '$editProductName'";
                                        $result = $conn->query($sqlGetOldImage);

                                        // Verificar si se encontró la imagen anterior en la base de datos
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $oldImagePath = $row['img']; // URL completa de la imagen anterior

                                            // Actualizar la URL de la imagen en la base de datos
                                            $sqlUpdateImage = "UPDATE productos SET img = '$newImagePath' WHERE nombre_Producto = '$editProductName'";
                                            $sqlUpdateImage2 = "UPDATE bodega SET img = '$newImagePath' WHERE Nombre_producto = '$editProductName'";

                                            // Ejecutar la consulta para actualizar la URL de la imagen
                                            if ($conn->query($sqlUpdateImage) === TRUE && $conn->query($sqlUpdateImage2)) {
                                                // Mover el archivo subido a la carpeta de destino
                                                if(move_uploaded_file($_FILES['editValue']['tmp_name'], $newImagePath)) {
                                                    // Eliminar la imagen anterior del servidor si existe
                                                    if (file_exists($oldImagePath)) {
                                                        unlink($oldImagePath); // Eliminar la imagen anterior del servidor
                                                        echo "<script>console.log('Imagen anterior eliminada del servidor.')</script>";
                                                    } else {
                                                        echo "<script>console.log('La imagen anterior no existe en el servidor.')</script>";
                                                    }
                                                    echo "<script>alert('Producto editado correctamente.')</script>";
                                                } else {
                                                    echo "<script>alert('Error al mover la imagen subida.')</script>";
                                                }
                                            } else {
                                                echo "<script>alert('Error al actualizar la URL de la imagen en la base de datos.')</script>";
                                            }
                                        } else {
                                            echo "<script>alert('No se pudo obtener la URL de la imagen anterior.')</script>";
                                        }
                                    } else {
                                        echo "<script>alert('No se subió ninguna imagen o hubo un error al subir la imagen.')</script>";
                                    }
                                    break;
                                case 'precio':
                                    // Verificar si se proporcionó un nuevo precio
                                    if(isset($_POST['editPriceInput'])) {
                                        $editValue = floatval($_POST['editPriceInput']);
                                        $sql = "UPDATE productos SET Precio_Producto = '$editValue' WHERE nombre_Producto = '$editProductName'";
                                    }
                                    break;
                                default:
                                    echo "<script>console.log('Campo a editar no válido.')</script>";
                            }
                            
                            // Ejecutar las consultas SQL si están definidas
                            if (isset($sql)) {
                                $success = true; // Variable para rastrear el éxito de todas las consultas

                                // Verificar y ejecutar la consulta SQL principal
                                if ($conn->query($sql) === TRUE) {
                                    // Consulta principal ejecutada con éxito
                                    echo "<script>alert('Producto editado correctamente.')</script>";
                                } else {
                                    // Error al ejecutar la consulta principal
                                    echo "<script>alert('Error al editar el producto.')</script>";
                                    $success = false; // Establecer el éxito como falso
                                }

                                // Verificar y ejecutar otras consultas solo si la principal tuvo éxito
                                if ($success) {
                                    // Ejecutar otras consultas solo si la consulta principal tuvo éxito
                                    if (isset($sql_bodega)) {
                                        $conn->query($sql_bodega);
                                    }
                                    if (isset($sql_local1)) {
                                        $conn->query($sql_local1);
                                    }
                                    if (isset($sql_local2)) {
                                        $conn->query($sql_local2);
                                    }
                                }
                            } else {
                                // No se definió ninguna consulta SQL
                                echo "<script>alert('No se realizó ninguna modificación en el producto.')</script>";
                            }

                        } else {
                            echo "<script>alert('Por favor, seleccione un producto y un campo válido para editar.')</script>";
                        }
                    } else {
                        echo "<script>alert('Por favor, llene todos los campos para editar el producto.')</script>";
                    }
                }
                ?>
                </div>
                <div id="addKilosForm" style="display: none;">
                    <h3>Agregar Kilos</h3>
                    <form method="post" onsubmit="reloadPage()">
                        <label for="productNameKilos">Nombre del Producto:</label><br>
                        <?php 
                        $sql = "SELECT Nombre_producto FROM bodega";
                        $result = $conn->query($sql);
                        
                        // Arreglo para almacenar los nombres de productos
                        $productos3 = array();
                        
                        // Verificar si se encontraron resultados
                        if ($result->num_rows > 0) {
                            // Almacenar los nombres de productos en el arreglo
                            while ($row = $result->fetch_assoc()) {
                                $productos3[] = $row["Nombre_producto"];
                            }
                        }
                        
                        ?>
                        <select id="nombreProducto" name="nombreProductos2">
                            <option value="Seleccione">Seleccione una Opción</option>
                            <?php
                            // Iterar sobre los nombres de productos y mostrarlos en el select
                            foreach ($productos3 as $producto3) {
                                echo "<option value='$producto3'>$producto3</option>";
                            }
                            ?>
                        </select><br>
                        <label for="kilos">Cantidad de Kilos:</label><br>
                        <input type="number" step="0.01" id="kilos" name="kilos"><br>
                        <button type="submit" onclick="addKilos()"name = "boton_agregar_kilos">Agregar</button>
                    </form>
                    <?php
                        // Verificar si se ha enviado el formulario para agregar kilos a la bodega
                        if(isset($_POST['boton_agregar_kilos'])){ 
                        if(isset($_POST['nombreProductos2']) && isset($_POST['kilos'])) {
                            $productName = $_POST['nombreProductos2'];
                            $kilosToAdd = $_POST['kilos'];

                            // Verificar si se han ingresado valores válidos
                            if(empty($productName) || empty($kilosToAdd)) {
                                echo "<script>alert('Por favor, ingrese todos los campos.');</script>";
                            } else {
                                // Consulta SQL para obtener la cantidad de kilos actual en la bodega para el producto dado
                                $sqlSelect = "SELECT Cantidad_Camara FROM bodega WHERE Nombre_producto = '$productName'";
                                $result = $conn->query($sqlSelect);

                                if($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $currentKilos = $row['Cantidad_Camara'];
                                    $newTotalKilos = $currentKilos + $kilosToAdd;
                                    $currentDate = date("d/m/Y");
                                    $currentDate2 = date("m/Y");
                                    $horaActual = date("H:i:s");
                                    // Consulta SQL para actualizar la cantidad de kilos en la bodega
                                    $sqlUpdate = "UPDATE bodega SET Cantidad_Camara = $newTotalKilos WHERE Nombre_producto = '$productName'";
                                    $sqln = "INSERT INTO `movimientos_bodega`(`Nombre Producto`, `Cantidad_enviada`, `Fecha Ingreso`, `Hora Ingreso`, `Local`,`Mes_Ingreso`) VALUES ('$productName',' $kilosToAdd',' $currentDate','$horaActual','bodega','$currentDate2')";
                                    
                                    if($conn->query($sqln) === TRUE) {
                                        echo "";
                                    } else {
                                        echo "";
                                    }

                                    if($conn->query($sqlUpdate) === TRUE) {
                                        echo "<script>alert('Se agregaron $kilosToAdd kilos al producto $productName en la bodega.');</script>";
                                    } else {
                                        echo "<script>alert('Error al agregar kilos a la bodega.');</script>";
                                    }
                                } else {
                                    echo "<script>alert('No se encontró el producto en la bodega.');</script>";
                                }
                            }
                        }}
                        ?>
                </div>
                <div id="sendKilosForm" style="display: none;">
                    <h3>Enviar Kilos</h3>
                    <form method="post" >
                        <label for="productNameSend">Nombre del Producto:</label><br>
                        <?php 
                        $sql = "SELECT nombre_Producto FROM productos";
                        $result = $conn->query($sql);
                        
                        // Arreglo para almacenar los nombres de productos
                        $productos = array();
                        
                        // Verificar si se encontraron resultados
                        if ($result->num_rows > 0) {
                            // Almacenar los nombres de productos en el arreglo
                            while ($row = $result->fetch_assoc()) {
                                $productos[] = $row["nombre_Producto"];
                            }
                        }
                        
                        ?>
                        <select id="productNameSend" name="productNameSend">
                            <option value="Seleccione">Seleccione una Opción</option>
                            <?php
                            // Iterar sobre los nombres de productos y mostrarlos en el select
                            foreach ($productos as $producto) {
                                echo "<option value='$producto'>$producto</option>";
                            }
                            ?>
                        </select><br>
                            <!-- Opciones para seleccionar el nombre del producto -->
                        </select><br>
                        <label for="kilosToSend">Cantidad de Kilos a enviar:</label><br>
                        <input type="number" step="0.01" id="kilosToSend" placeholder="Ingrese la Cantidad de kilos" name="kilosToSend"><br>
                        <label for="localToSend">Local a enviar:</label><br>
                        <select id="localToSend" name="localToSend">
                            <option value="Seleccione">Seleccione una Opción</option>
                            <option value="local_1">Local 1</option>
                            <option value="local_2">Local 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select><br>
                        <button type="submit" onclick="reloadPage()" name="agregar_locales">Enviar</button>
                    </form>
                    <?php
// Verificar si se ha enviado el formulario al hacer clic en el botón "Enviar_locales"
                        if(isset($_POST["agregar_locales"])){ 
                            // Obtener los datos enviados por el formulario
                            $productName = $_POST['productNameSend'];
                            $kilosToSend = $_POST['kilosToSend'];
                            $localToSend = $_POST['localToSend'];

                            // Verificar la cantidad de kilos en la bodega antes de realizar la operación
                            $sqlCheckBodega = "SELECT Cantidad_Camara, img , Tipo FROM bodega WHERE Nombre_producto = '$productName'";
                            $resultCheckBodega = $conn->query($sqlCheckBodega);

                            if ($resultCheckBodega) {
                                // Verificar si se encontró el producto en la bodega
                                if ($resultCheckBodega->num_rows > 0) {
                                    // El producto existe en la bodega
                                    $row = $resultCheckBodega->fetch_assoc();
                                    $kilosBodega = $row['Cantidad_Camara'];
                                    $img = $row['img'];
                                    $tipo_ = $row['Tipo'];

                                    // Verificar si hay suficientes kilos en la bodega para realizar la operación
                                    if ($kilosBodega >= $kilosToSend) {
                                        // Actualizar la cantidad de kilos en la bodega
                                        $sqlUpdateBodega = "UPDATE bodega SET Cantidad_Camara = Cantidad_Camara - $kilosToSend WHERE Nombre_producto = '$productName'";
                                        if ($conn->query($sqlUpdateBodega) === TRUE) {
                                            // Verificar si el producto existe en la tabla correspondiente al local
                                            $sqlCheckProduct = "SELECT * FROM $localToSend WHERE Nombre_Producto = '$productName'";
                                            $resultCheckProduct = $conn->query($sqlCheckProduct);

                                            if ($resultCheckProduct) {
                                                date_default_timezone_set('America/Santiago');
                                                $currentDate = date("d/m/Y");
                                                $currentDate2 = date("m/Y");
                                                $horaActual = date("H:i:s");
                                                // Verificar si se encontró el producto en la tabla del local
                                                if ($resultCheckProduct->num_rows > 0) {
                                                    // El producto existe en la tabla del local
                                                    // Actualizar la cantidad de kilos sumando los kilos a enviar
                                                    $currentDate = date("d/m/Y");
                                                    $currentDate2 = date("m/Y");
                                                    $mov_kilos = "INSERT INTO `movimientos_bodega`(`Nombre Producto`, `Cantidad_enviada`, `Fecha Ingreso`, `Hora Ingreso`, `Local`,`Mes_ingreso`) VALUES ('$productName','$kilosToSend','$currentDate','$horaActual','$localToSend','$currentDate2')";
                                                    if ($conn->query($mov_kilos) === TRUE ) {
                                                        echo '';
                                                    } else {
                                                        echo "";
                                                    }
                                                    $sqlUpdateKilos = "UPDATE $localToSend SET Cantidad_Kilos = Cantidad_Kilos + $kilosToSend WHERE Nombre_Producto = '$productName'";
                                                    if ($conn->query($sqlUpdateKilos) === TRUE ) {
                                                        echo '<script> alert("Agregado Exitosamente.");</script>';
                                                    } else {
                                                        echo "<script>alert('Error al actualizar la cantidad de kilos en el local.')</script>";
                                                    }
                                                } else {
                                                    // El producto no existe en la tabla del local
                                                    // Realizar una inserción del producto en la tabla del local
                                                    $currentDate = date("d/m/Y");
                                                    $currentDate2 = date("m/Y");
                                                    $mov_kilos = "INSERT INTO `movimientos_bodega`(`Nombre Producto`, `Cantidad_enviada`, `Fecha Ingreso`, `Hora Ingreso`, `Local`,`Mes_ingreso`) VALUES ('$productName','$kilosToSend','$currentDate','$horaActual','$localToSend','$currentDate2')";
                                                    if ($conn->query($mov_kilos) === TRUE ) {
                                                        echo '';
                                                    } else {
                                                        echo "";
                                                    }
                                                    $sqlInsertProduct = "INSERT INTO $localToSend (Nombre_Producto, Cantidad_Kilos , Fecha_ingreso, Mes_Ingreso, Tipo, img) VALUES ('$productName', $kilosToSend,'$currentDate','$currentDate2','$tipo_','$img')";
                                                    if ($conn->query($sqlInsertProduct) === TRUE) {
                                                        echo "<script>alert('Agregado Exitosamente.')</script>";
                                                    } else {
                                                        echo "<script>alert('Error al insertar el producto en la tabla del local.')</script>";
                                                    }
                                                }
                                            } else {
                                                echo "<script>alert('Error al verificar si el producto existe en la tabla del local.')</script>";
                                            }
                                        } else {
                                            echo "<script>alert('Error al actualizar la cantidad de kilos en la bodega.')</script>";
                                        }
                                    } else {
                                        echo "<script>alert('No hay suficientes kilos en la bodega para realizar la operación.')</script>";
                                    }
                                } else {
                                    echo "<script>alert('El producto no existe en la bodega.')</script>";
                                }
                            } else {
                                echo "<script>alert('Error al verificar si el producto existe en la bodega.')</script>";
                            }
                        }
                    ?>          
                </div>
                <div id="addPromotionForm" style="display: none;">
                    <h3>Agregar Promoción</h3>
                    <form method="post" >
                        <label for="promotionName">Nombre:</label><br>
                        <input type="text" id="promotionName" name="promotionName" placeholder="Agregar Nombre aquí"><br>
                        
                        <label for="promotionType">Tipo de Promoción:</label><br>
                        <select id="promotionType" name="promotionType">
                            <option value="oferta">Oferta</option>
                        </select><br>
                        
                        <label for="promotionValue">Valor de la Promoción:</label><br>
                        <input type="number" id="promotionValue" name="promotionValue" step="0.01" placeholder="Agregar Valor aquí"><br>
                        
                        <label for="promotioncant">Cantidad de Producto Por Promo</label><br>
                        <input type="text" id="promotioncant" name="promotioncant" placeholder="Agregar Cantidad De Producto x promo"><br>

                        <label for="productApplies">Producto al que Aplica:</label><br>
                            <select id="productApplies" name="productApplies">
                                <option value="">Seleccione un Producto</option>
                                <?php
                                // Consulta SQL para obtener todos los productos
                                $sqlProductos = "SELECT `nombre_Producto` FROM `productos`";

                                // Ejecutar la consulta SQL
                                $resultProductos = $conn->query($sqlProductos);

                                // Verificar si hay resultados y mostrar cada producto como una opción en el select
                                if ($resultProductos->num_rows > 0) {
                                    while ($rowProducto = $resultProductos->fetch_assoc()) {
                                        $nombreProducto = $rowProducto["nombre_Producto"];
                                        echo "<option value='$nombreProducto'>$nombreProducto</option>";
                                    }
                                }
                                ?>

                            </select><br>
                    

                        <button type="submit" name="Boton_enviar_ag">Agregar</button>
                    </form>
                    <!-- PHP para agregar la promoción -->
                    <?php
                    if(isset($_POST['Boton_enviar_ag'])){
                        // Obtener los datos del formulario
                        $nombrePromocion = $_POST['promotionName'];
                        $tipoPromocion = $_POST['promotionType'];
                        $valorPromocion = $_POST['promotionValue'];
                        $cantpromo = $_POST['promotioncant'];
                        $productoAplica = $_POST['productApplies'];

                        // Preparar la consulta SQL para insertar los datos en la tabla
                        $sql = "INSERT INTO Promociones (nombre,tipo_promocion, valor_promocion, producto_aplica, Cant_promo) 
                                VALUES ('$nombrePromocion','$tipoPromocion', $valorPromocion, '$productoAplica', '$cantpromo')";

                        // Ejecutar la consulta
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('Promoción agregada correctamente.')</script>";
                        } else {
                            echo "<script>alert('Error al agregar la promoción: " . $conn->error . "')</script>";
                        }
                    }
                    ?>
                </div>
                <div id="deletePromotionForm" style="display: none;">
                    <h3>Eliminar Promoción</h3>
                    <form method="post" action="">
                        <label for="promotionSelect">Seleccione una promoción:</label>
                        <select id="promotionSelect" name="promotion">
                        <option value="">Seleccionar una Promocion</option>'
                            <?php
                            // Verificar conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta a la base de datos para obtener las promociones
                            $sql = "SELECT id, nombre, tipo_promocion, valor_promocion, producto_aplica, Cant_promo FROM promociones";
                            $result = $conn->query($sql);

                            // Verificar si hay resultados y generar las opciones del select
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nombre']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay promociones disponibles</option>';
                            }
                            ?>
                        </select><br>
                        <button type="submit" name="eliminarpromo">Eliminar</button>
                    </form>
                    <?php
                    if (isset($_POST['eliminarpromo'])) {
                        $promotionId = $_POST['promotion'];

                        // Preparar y ejecutar la consulta para eliminar la promoción
                        $stmt = $conn->prepare("DELETE FROM promociones WHERE id = ?");
                        $stmt->bind_param("i", $promotionId);

                        if ($stmt->execute()) {
                            echo "<script>alert('Promoción eliminada correctamente.');</script>";
                        } else {
                            echo "<script>alert('Error al eliminar correctamente.');</script>";
                        }

                        // Cerrar la declaración
                        $stmt->close();
                    } else {
                        echo '';
                    }

                    // Cerrar la conexión
                    ?>

                </div>
                <div id="editPromotionForm" style="display: none;">
                    <h3>Editar Promoción</h3>
                    <form method="post" action="">
                        <label for="promotion">Seleccione una promoción:</label>
                        <select name="promotion_id" id="promotion" onchange="mostrarCampos()">
                            <option value="">Seleccione una promoción</option>
                            <?php
                            $sql = "SELECT id, nombre, valor_promocion, Cant_promo FROM promociones";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["id"] . "' 
                                            data-nombre='" . $row["nombre"] . "' 
                                            data-valor_promocion='" . $row["valor_promocion"] . "' 
                                            data-Cant_promo='" . $row["Cant_promo"] . "'>" 
                                            . $row["nombre"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No hay promociones disponibles</option>";
                            }
                            ?>
                        </select>
                        
                        <div id="editFields" style="display: none;">
                            <label for="nombre">Nombre:</label><br>
                            <input type="text" name="nombre" id="nombre"><br>
                            
                            <label for="valor_promocion">Valor de la promoción:</label><br>
                            <input type="text" name="valor_promocion" id="valor_promocion"><br>
                            
                            <label for="Cant_promo">Cantidad para aplicar la promoción:</label><br>
                            <input type="text" name="Cant_promo" id="Cant_promo"><br>
                            
                            <button type="submit" name="edit" value="Editar">Editar
                        </div>
                    </form>
                    <?php   
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
                    $promotion_id = $_POST["promotion_id"];
                    $nombre = $_POST["nombre"];
                    $valor_promocion = $_POST["valor_promocion"];
                    $Cant_promo = $_POST["Cant_promo"];
                    
                    // Validar y sanitizar los datos si es necesario

                    // Actualizar la promoción en la base de datos
                    $sql = "UPDATE promociones SET nombre = ?, valor_promocion = ?, Cant_promo = ? WHERE id = ?";
                    
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("ssii", $nombre, $valor_promocion, $Cant_promo, $promotion_id);
                        if ($stmt->execute()) {
                            echo "<script>alert('Promoción actualizada correctamente.');</script>";
                        } else {
                            echo "<script>alert('Error al actualizar la promoción: " . $stmt->error . "');</script>";
                        }
                        $stmt->close();
                    } else {
                        echo "<script>alert('Error en la preparación de la consulta: " . $conn->error . "');</script>";
                    }
                }

                $conn->close();
                ?>
                </div>    

        </center>
    </main>
    <script src="http://localhost/Bodega/Admin/assent/js/Main3.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script> 
        window.onload = function() {
            $('#carga').fadeOut();
        };
    </script>    
    
</body>
</html>
