<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bodega/Admin/assent/css/index_admin1.css">
    <title>Rentabilidad</title>
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
            <div id="acciones2" class="slide">
                <h2>Rentabilidad</h2>
                <div class="botones-acciones">
                    <button class="btn-agregar-provedor" onclick="agregarProvedor()">Agregar Provedor</button>
                    <button class="btn-agregar-rentabilidad" onclick="agregarProducto()">Agregar Producto</button>
                    <button class="btn-eliminar-rentabilidad" onclick="eliminarRentabilidad()">Eliminar Rentabilidiadd</button>
                    <button class="btn-rentabilidad" onclick="Rentabilidad()">Ver Rentabilidiadd</button>
                </div>
                <div id="agregarProvedores2" style="display: none;">
                <div id="opciones" style="">
                    <form method="post" onsubmit="reloadPage()">
                        <h2>Seleccionar una Opción</h2>
                        <label for="select_e_a">Seleccionar la opción</label>
                        <select id="select_e_a" name="select_e_a">
                            <option value="none">Seleccione una opción</option>
                            <option value="agregar">Agregar Proveedor</option>
                            <option value="eliminar">Eliminar Proveedor</option>
                            <option value="editar">Editar Proveedor</option>
                        </select>
                    </form>
                </div>

                    <div id="agregar" style="display: none;">
                        <form method="post">
                            <h2>Agregar Proveedor</h2>
                            <label for="nuevoProveedor">Nuevo Proveedor</label>
                            <input id="nuevoProveedor" name="nuevoProveedor" placeholder="Ingrese Nuevo Proveedor" type="text"><br>
                            <button type="submit" onclick="reloadPage()" name="agregarProvedores">Agregar</button>
                        </form>
                        <br><br><br><br><br><br><br><br>
                    </div>

                    <div id="eliminar" style="display: none;">
                        <form method="post">
                            <h2>Eliminar Proveedor</h2>
                            <label for="eliminarProveedor">Proveedor a Eliminar</label><br>
                            <select id="eliminarProveedor" name="eliminarProveedor">
                                <option value="none">Seleccione una Opción</option>
                                <?php
                                $sql = "SELECT nombre FROM proveedores";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['nombre']}'>{$row['nombre']}</option>";
                                    }
                                }
                                ?>
                            </select><br>
                            <button type="submit" onclick="reloadPage()" name="eliminarProvedores">Eliminar</button>
                        </form>
                        <br><br><br><br><br><br><br><br>
                    </div>

                    <div id="editar" style="display: none;">
                        <form method="post">
                            <h2>Editar Proveedor</h2>
                            <label for="editarProveedor">Proveedor a Editar</label><br>
                            <select id="editarProveedor" name="editarProveedor">
                                <option value="none">Seleccione una Opción</option>
                                <?php
                                $sql = "SELECT nombre FROM proveedores";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['nombre']}'>{$row['nombre']}</option>";
                                    }
                                }
                                ?>
                            </select><br>
                            <label for="nuevoNombre">Nuevo Nombre</label>
                            <input id="nuevoNombre" name="nuevoNombre" placeholder="Ingrese Nuevo Nombre" type="text"><br>
                            <button type="submit" onclick="reloadPage()" name="editarProvedores">Editar</button>
                        </form>
                        <br><br><br><br><br><br><br><br>
                    </div>

                    <?php
                    if (isset($_POST["eliminarProvedores"])) {
                        if (isset($_POST['eliminarProveedor'])) {
                            $nombreProveedor = $_POST['eliminarProveedor'];

                            $sql = "DELETE FROM proveedores WHERE nombre = '$nombreProveedor'";

                            if ($conn->query($sql) === TRUE) {
                                echo "<script> alert('Proveedor eliminado con éxito.')</script>";
                            } else {
                                echo "<script> alert('Error al eliminar el Proveedor')</script>" . $conn->error;
                            }
                        }
                    }

                    if (isset($_POST["editarProvedores"])) {
                        if (isset($_POST['editarProveedor']) && isset($_POST['nuevoNombre'])) {
                            $nombreProveedor = $_POST['editarProveedor'];
                            $nuevoNombre = $_POST['nuevoNombre'];

                            $sql = "UPDATE proveedores SET nombre = '$nuevoNombre' WHERE nombre = '$nombreProveedor'";

                            if ($conn->query($sql) === TRUE) {
                                echo "<script> alert('Proveedor actualizado con éxito.')</script>";
                            } else {
                                echo "<script> alert('Error al actualizar el Proveedor')</script>" . $conn->error;
                            }
                        }
                    }

                    if (isset($_POST["agregarProvedores"])) {
                        if (isset($_POST['nuevoProveedor'])) {
                            $nuevoProveedor = $_POST['nuevoProveedor'];

                            $query = "SELECT * FROM proveedores WHERE nombre = '$nuevoProveedor'";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                echo "<script> alert('Ya existe un proveedor con el mismo nombre.')</script>";
                            } else {
                                $fecha_actual_str = date('d-n-y');
                                $sql = "INSERT INTO proveedores (nombre, fecha_ingreso) VALUES ('$nuevoProveedor', '$fecha_actual_str')";

                                if ($conn->query($sql) === TRUE) {
                                    echo "<script> alert('Proveedor agregado con éxito.')</script>";
                                } else {
                                    echo "<script> alert('Error al agregar Proveedor')</script>" . $conn->error;
                                }
                            }
                        }
                    }
                    ?>


                </div>
                <div id="agregarProducto" style="display: none;">
                <form  method="Post" onsubmit="reloadPage()">
                    <h2>Agregando rentabilidad</h2>
                    <label for="productoProvedor">Nombre del Provedor:</label><br>
                        <?php 
                        $sql = "SELECT nombre FROM proveedores";
                        $result = $conn->query($sql);
                        
                        // Arreglo para almacenar los nombres de productos
                        $productos = array();
                        
                        // Verificar si se encontraron resultados
                        if ($result->num_rows > 0) {
                            // Almacenar los nombres de productos en el arreglo
                            while ($row = $result->fetch_assoc()) {
                                $productos[] = $row["nombre"];
                            }
                        }
                        
                        ?>
                        <select id="productoProvedor" name="productoProvedor">
                            <option value="Seleccione">Seleccione una Opción</option>
                            <?php
                            // Iterar sobre los nombres de productos y mostrarlos en el select
                            foreach ($productos as $producto) {
                                echo "<option value='$producto'>$producto</option>";
                            }
                            ?>
                        </select><br>
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
                        <label for="productoNombre">Nombre Del Porducto</label><br>
                        <select id="productoNombre" name="productoNombre"><br>
                            <option value="No seleccionada">Seleccione una Opción</option>
                            <?php
                            // Iterar sobre los nombres de productos y mostrarlos en el select
                            foreach ($productos as $producto) {
                                echo "<option value='$producto'>$producto</option>";
                            }
                            ?>
                        </select><br>
                        <label for="Cant_compra">Cantidad Comprada</label><br>
                        <input id ="Cant_compra" name="Cant_compra" type="text" placeholder="Ingrese la cantidad comprada"><br>

                        <label for="rent">Eliga la rentabilidad</label><br>
                        <select name="rent" id="rent">
                            <option value="No Seleccionada">Seleccione la rentabilidad</option>
                            <option value="1%">1%</option>
                            <option value="2%">2%</option>
                            <option value="3%">3%</option>
                            <option value="4%">4%</option>
                            <option value="5%">5%</option>
                            <option value="6%">6%</option>
                            <option value="7%">7%</option>
                            <option value="8%">8%</option>
                            <option value="9%">9%</option>
                            <option value="10%">10%</option>
                            <option value="11%">11%</option>
                            <option value="12%">12%</option>
                            <option value="13%">13%</option>
                            <option value="14%">14%</option>
                            <option value="15%">15%</option>
                            <option value="16%">16%</option>
                            <option value="17%">17%</option>
                            <option value="18%">18%</option>
                            <option value="19%">19%</option>
                            <option value="20%">20%</option>
                            <option value="21%">21%</option>
                            <option value="22%">22%</option>
                            <option value="23%">23%</option>
                            <option value="24%">24%</option>
                            <option value="25%">25%</option>
                            <option value="26%">26%</option>
                            <option value="27%">27%</option>
                            <option value="28%">28%</option>
                            <option value="29%">29%</option>
                            <option value="30%">30%</option>
                            <option value="31%">31%</option>
                            <option value="32%">32%</option>
                            <option value="33%">33%</option>
                            <option value="34%">34%</option>
                            <option value="35%">35%</option>
                            <option value="36%">36%</option>
                            <option value="37%">37%</option>
                            <option value="38%">38%</option>
                            <option value="39%">39%</option>
                            <option value="40%">40%</option>
                            <option value="41%">41%</option>
                            <option value="42%">42%</option>
                            <option value="43%">43%</option>
                            <option value="44%">44%</option>
                            <option value="45%">45%</option>
                            <option value="46%">46%</option>
                            <option value="47%">47%</option>
                            <option value="48%">48%</option>
                            <option value="49%">49%</option>
                            <option value="50%">50%</option>
                            <option value="51%">51%</option>
                            <option value="52%">52%</option>
                            <option value="53%">53%</option>
                            <option value="54%">54%</option>
                            <option value="55%">55%</option>
                            <option value="56%">56%</option>
                            <option value="57%">57%</option>
                            <option value="58%">58%</option>
                            <option value="59%">59%</option>
                            <option value="60%">60%</option>
                            <option value="61%">61%</option>
                            <option value="62%">62%</option>
                            <option value="63%">63%</option>
                            <option value="64%">64%</option>
                            <option value="65%">65%</option>
                            <option value="66%">66%</option>
                            <option value="67%">67%</option>
                            <option value="68%">68%</option>
                            <option value="69%">69%</option>
                            <option value="70%">70%</option>
                            <option value="71%">71%</option>
                            <option value="72%">72%</option>
                            <option value="73%">73%</option>
                            <option value="74%">74%</option>
                            <option value="75%">75%</option>
                            <option value="76%">76%</option>
                            <option value="77%">77%</option>
                            <option value="78%">78%</option>
                            <option value="79%">79%</option>
                            <option value="80%">80%</option>
                            <option value="81%">81%</option>
                            <option value="82%">82%</option>
                            <option value="83%">83%</option>
                            <option value="84%">84%</option>
                            <option value="85%">85%</option>
                            <option value="86%">86%</option>
                            <option value="87%">87%</option>
                            <option value="88%">88%</option>
                            <option value="89%">89%</option>
                            <option value="90%">90%</option>
                            <option value="91%">91%</option>
                            <option value="92%">92%</option>
                            <option value="93%">93%</option>
                            <option value="94%">94%</option>
                            <option value="95%">95%</option>
                            <option value="96%">96%</option>
                            <option value="97%">97%</option>
                            <option value="98%">98%</option>
                            <option value="99%">99%</option>
                            <option value="100%">100%</option>
                        </select><br>

                    <button type="submit" name="enviarRentabilidad">Agregar</button>
                </form><br><br><br><br><br><br>  
                 <?php 
                    // Verificar si se han enviado los datos del formulario
                    if(isset($_POST['enviarRentabilidad'])) {
                        // Verificar la conexión
                        include_once 'conexion.php'; // Reemplaza 'conexion.php' con el archivo donde tengas la conexión a la base de datos
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Obtener los datos del formulario
                        $nombreProveedor = $_POST['productoProvedor'];
                        $nombreProducto = $_POST['productoNombre'];
                        $cantidadComprada = $_POST['Cant_compra'];
                        $rentabilidad = $_POST['rent'];
                        $mes= date("m/Y");
                        $dia= date("d/m/Y");
                        $hora= date("H:i:s");

                        // Preparar la consulta SQL para insertar los datos en la tabla de rentabilidad
                        $sql = "INSERT INTO rentabilidad (mes_entrada,fecha_entrada,hora_entrada,Nombre_Provedores, Nombre_Producto, Cantidad_Comprada, Total_Rentabilidad)
                                VALUES ('$mes',' $dia','$hora','$nombreProveedor', '$nombreProducto', '$cantidadComprada', '$rentabilidad')";

                        // Ejecutar la consulta
                        if ($conn->query($sql) === TRUE) {
                            echo "<script> alert('Datos agregados correctamente a la tabla de rentabilidad.')</script>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }

                
                    }

                 ?>         
                </div>  
                <div id="Rentabilidad" style="display: none;"> 
                <h2>Rentabilidad</h2>
                <!-- Formulario de entrada del mes -->
                    <form action="resultados_rent.php" onsubmit="reloadPage()" method="GET">
                        <label for="mes">Ingrese el mes (MM/YYYY):</label>
                        <input type="text" id="mes" name="mes" placeholder="MM/YYYY" required><br>
                        <button type="submit" >Buscar</button>
                    </form>  
                </div>        
                <div id="eliminarRentabilidad">
                    <h2>Eliminar Rentabilidad</h2>
                    <form action="" method="post">
                        <label for="idRentabilidad">ID de Rentabilidad:</label><br>
                        <input type="text" id="idRentabilidad" name="idRentabilidad" placeholder="Ingrese el ID de la rentabilidad"><br>
                        <button type="submit" name="eliminarRentabilidad">Eliminar</button>
                    </form>
                
                <?php
                    // Verificar si se han enviado los datos del formulario
                    if(isset($_POST['eliminarRentabilidad'])) {
                        // Verificar si se ha ingresado el ID de la rentabilidad
                        if(isset($_POST['idRentabilidad'])) {
                            // Obtener el ID de la rentabilidad desde el formulario
                            $idRentabilidad = $_POST['idRentabilidad'];

                            // Incluir el archivo de conexión a la base de datos
                            include "conexion.php";

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Preparar la consulta SQL para eliminar la rentabilidad con el ID especificado
                            $sql = "DELETE FROM rentabilidad WHERE id = $idRentabilidad";

                            // Ejecutar la consulta
                            if ($conn->query($sql) === TRUE) {
                                // Mostrar alerta de éxito
                                echo "<script>alert('Rentabilidad eliminada correctamente.');</script>";
                            } else {
                                // Mostrar alerta de error
                                echo "<script>alert('Error al eliminar la rentabilidad: " . $conn->error . "');</script>";
                            }

                            // Cerrar la conexión
                            $conn->close();
                        } else {
                            // Mostrar alerta si no se ingresó el ID de la rentabilidad
                            echo "<script>alert('Por favor, ingrese el ID de la rentabilidad a eliminar.');</script>";
                        }
                    }
                    ?>   
                </div>    
            </div>

            
            
            <!-- 
?> -->
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
