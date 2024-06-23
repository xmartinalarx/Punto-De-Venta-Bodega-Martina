<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bodega/Admin/assent/css/index_admin1.css">
    <title>Bodega</title>
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
            <div id="bodega" class="slide"> 
            <h2>Contenido Bodega</h2>
                <button class="slide-button" onclick="Pollo()">Pollo</button>
                <button class="slide-button" onclick="Pavo()">Pavo</button>
                <button class="slide-button" onclick="Cerdo()">Cerdo</button>
                <button class="slide-button" onclick="Vacuno()">Vacuno</button>
                <button class="slide-button" onclick="Embutidos()">Embutidos</button>
                <button class="slide-button" onclick="Congelados()">Congelados</button>
                <button class="slide-button" onclick="Abarrotes()">Abarrotes</button>
                <button class="slide-button" onclick="Promociones()">Promociones</button>

                
                <div class="bodega-slider">
                    <div class="sliders" id="Pollo">
                        <h1>Pollo</h1>
                    <?php
                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla de Local 1
                        $sql = "SELECT * FROM `bodega` WHERE Tipo = 'Pollo'";

                        // Ejecutar la consulta
                        $result = $conn->query($sql);

                        // Verificar si la consulta se ejecutó correctamente
                        if ($result === false) {
                            die("Error en la consulta SQL: " . $conn->error);
                        }

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            echo "<div class='product-container'>";
                            // Iterar sobre los resultados y generar el HTML para cada producto
                            while ($row = $result->fetch_assoc()) {
                                $nombreProducto = $row['Nombre_producto'];
                                $cantidad = $row['Cantidad_Camara'];
                                $imgUrl = $row['img'];

                                // Generar el HTML para el producto
                                echo "<div class='product'>";
                                echo "<h3>$nombreProducto</h3>";
                                echo "<p>Cantidad: $cantidad</p>";
                                echo "<img src='$imgUrl' alt='$nombreProducto'>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            // Si no hay resultados, mostrar un mensaje
                            echo "No hay productos en bodega";
                        }
                        ?>

                    </div>
                    <div class="sliders" id="Cerdo" style="display: none;">
                        <h1>Cerdo</h1>
                    <?php
                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla de Local 1
                        $sql = "SELECT * FROM `bodega` WHERE Tipo = 'Cerdo'";

                        // Ejecutar la consulta
                        $result = $conn->query($sql);

                        // Verificar si la consulta se ejecutó correctamente
                        if ($result === false) {
                            die("Error en la consulta SQL: " . $conn->error);
                        }

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            echo "<div class='product-container'>";
                            // Iterar sobre los resultados y generar el HTML para cada producto
                            while ($row = $result->fetch_assoc()) {
                                $nombreProducto = $row['Nombre_producto'];
                                $cantidad = $row['Cantidad_Camara'];
                                $imgUrl = $row['img'];

                                // Generar el HTML para el producto
                                echo "<div class='product'>";
                                echo "<h3>$nombreProducto</h3>";
                                echo "<p>Cantidad: $cantidad</p>";
                                echo "<img src='$imgUrl' alt='$nombreProducto'>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            // Si no hay resultados, mostrar un mensaje
                            echo "No hay productos en bodega";
                        }
                        ?>
                    </div>
                    <div class="sliders" id="Vacuno" style="display: none;">
                    <h1>Vacuno</h1>
                    <?php
                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla de Local 1
                        $sql = "SELECT * FROM `bodega` WHERE Tipo = 'Vacuno'";

                        // Ejecutar la consulta
                        $result = $conn->query($sql);

                        // Verificar si la consulta se ejecutó correctamente
                        if ($result === false) {
                            die("Error en la consulta SQL: " . $conn->error);
                        }

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            echo "<div class='product-container'>";
                            // Iterar sobre los resultados y generar el HTML para cada producto
                            while ($row = $result->fetch_assoc()) {
                                $nombreProducto = $row['Nombre_producto'];
                                $cantidad = $row['Cantidad_Camara'];
                                $imgUrl = $row['img'];

                                // Generar el HTML para el producto
                                echo "<div class='product'>";
                                echo "<h3>$nombreProducto</h3>";
                                echo "<p>Cantidad: $cantidad</p>";
                                echo "<img src='$imgUrl' alt='$nombreProducto'>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            // Si no hay resultados, mostrar un mensaje
                            echo "No hay productos en bodega";
                        }
                        ?>
                     </div>
                    <div class="sliders" id="Pavo" style="display: none;">
                        <h1>Pavo</h1>
                    <?php
                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla de Local 1
                        $sql = "SELECT * FROM `bodega` WHERE Tipo = 'Pavo'";

                        // Ejecutar la consulta
                        $result = $conn->query($sql);

                        // Verificar si la consulta se ejecutó correctamente
                        if ($result === false) {
                            die("Error en la consulta SQL: " . $conn->error);
                        }

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            echo "<div class='product-container'>";
                            // Iterar sobre los resultados y generar el HTML para cada producto
                            while ($row = $result->fetch_assoc()) {
                                $nombreProducto = $row['Nombre_producto'];
                                $cantidad = $row['Cantidad_Camara'];
                                $imgUrl = $row['img'];

                                // Generar el HTML para el producto
                                echo "<div class='product'>";
                                echo "<h3>$nombreProducto</h3>";
                                echo "<p>Cantidad: $cantidad</p>";
                                echo "<img src='$imgUrl' alt='$nombreProducto'>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            // Si no hay resultados, mostrar un mensaje
                            echo "No hay productos en bodega";
                        }
                        ?>
                     </div>
                    <div class="sliders" id="Embutidos" style="display: none;">
                    <h1>Embutidos</h1>
                    <?php
                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla de Local 1
                        $sql = "SELECT * FROM `bodega` WHERE Tipo = 'Embutidos'";

                        // Ejecutar la consulta
                        $result = $conn->query($sql);

                        // Verificar si la consulta se ejecutó correctamente
                        if ($result === false) {
                            die("Error en la consulta SQL: " . $conn->error);
                        }

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            echo "<div class='product-container'>";
                            // Iterar sobre los resultados y generar el HTML para cada producto
                            while ($row = $result->fetch_assoc()) {
                                $nombreProducto = $row['Nombre_producto'];
                                $cantidad = $row['Cantidad_Camara'];
                                $imgUrl = $row['img'];

                                // Generar el HTML para el producto
                                echo "<div class='product'>";
                                echo "<h3>$nombreProducto</h3>";
                                echo "<p>Cantidad: $cantidad</p>";
                                echo "<img src='$imgUrl' alt='$nombreProducto'>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            // Si no hay resultados, mostrar un mensaje
                            echo "No hay productos en bodega";
                        }
                        ?>
                     </div>
                    <div class="sliders " id="Abarrotes" style="display: none;">
                    <h1>Abarrotes</h1>
                    <?php
                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla de Local 1
                        $sql = "SELECT * FROM `bodega` WHERE Tipo = 'Abarrotes'";

                        // Ejecutar la consulta
                        $result = $conn->query($sql);

                        // Verificar si la consulta se ejecutó correctamente
                        if ($result === false) {
                            die("Error en la consulta SQL: " . $conn->error);
                        }

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            // Iterar sobre los resultados y generar el HTML para cada producto
                            echo "<div class='product-container'>";
                            while ($row = $result->fetch_assoc()) {
                                $nombreProducto = $row['Nombre_producto'];
                                $cantidad = $row['Cantidad_Camara'];
                                $imgUrl = $row['img'];

                                // Generar el HTML para el producto
                                echo "<div class='product'>";
                                echo "<h3>$nombreProducto</h3>";
                                echo "<p>Cantidad: $cantidad</p>";
                                echo "<img src='$imgUrl' alt='$nombreProducto'>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            // Si no hay resultados, mostrar un mensaje
                            echo "No hay productos en bodega";
                        }
                        ?>
                     </div>
                    <div class="sliders " id="Congelados" style="display: none;">
                    <h1>Congelados</h1>
                    <?php
                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla de Local 1
                        $sql = "SELECT * FROM `bodega` WHERE Tipo = 'Congelados'";

                        // Ejecutar la consulta
                        $result = $conn->query($sql);

                        // Verificar si la consulta se ejecutó correctamente
                        if ($result === false) {
                            die("Error en la consulta SQL: " . $conn->error);
                        }

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            // Iterar sobre los resultados y generar el HTML para cada producto
                            echo "<div class='product-container'>";
                            while ($row = $result->fetch_assoc()) {
                                $nombreProducto = $row['Nombre_producto'];
                                $cantidad = $row['Cantidad_Camara'];
                                $imgUrl = $row['img'];

                                // Generar el HTML para el producto
                                echo "<div class='product'>";
                                echo "<h3>$nombreProducto</h3>";
                                echo "<p>Cantidad: $cantidad</p>";
                                echo "<img src='$imgUrl' alt='$nombreProducto'>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            // Si no hay resultados, mostrar un mensaje
                            echo "No hay productos en bodega";
                        }
                        ?>
                     </div>
                    <div class="sliders " id="Promociones" style="display: none;">
                    <h1>Promociones</h1>
                    <?php
                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla de Local 1
                        $sql = "SELECT * FROM `bodega` WHERE Tipo = 'Promociones'";

                        // Ejecutar la consulta
                        $result = $conn->query($sql);

                        // Verificar si la consulta se ejecutó correctamente
                        if ($result === false) {
                            die("Error en la consulta SQL: " . $conn->error);
                        }

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            // Iterar sobre los resultados y generar el HTML para cada producto
                            echo "<div class='product-container'>";
                            while ($row = $result->fetch_assoc()) {
                                $nombreProducto = $row['Nombre_producto'];
                                $cantidad = $row['Cantidad_Camara'];
                                $imgUrl = $row['img'];

                                // Generar el HTML para el producto
                                echo "<div class='product'>";
                                echo "<h3>$nombreProducto</h3>";
                                echo "<p>Cantidad: $cantidad</p>";
                                echo "<img src='$imgUrl' alt='$nombreProducto'>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            // Si no hay resultados, mostrar un mensaje
                            echo "No hay productos en bodega";
                        }
                        ?>
                     </div>
                </div>
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
