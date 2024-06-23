<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bodega/Admin/assent/css/index_admin2.css">
    <script defer src="http://localhost/Bodega/Admin/assent/js/Main3.js"></script>
    <title>Document</title>
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
<center><br><br><br><button onclick="volver()">Volver inicio</button><br><br><br>
<div class="ventas-table-container">
                    <?php
                        include ("conexion.php");
                        // Verificar si se ha enviado el formulario
                        if (isset($_POST["Buscar_ventas1"])) {
                            // Recuperar los datos del formulario
                            $fecha = $_POST["fecha"];
                            $local = $_POST["local"];
                            // Consulta SQL para obtener los datos de la base de datos
                            $query = "SELECT `Nombre_Producto`, `Precio_Producto`, `Kilos_Llevados`, `Dinero_total`, `Fecha_ingreso`, `fechames`, `Lugar_Venta` FROM `ventas` WHERE `Fecha_ingreso` = '$fecha' AND `Lugar_Venta` = '$local'";
                            $result = $conn->query($query);
                            // Ejecutar la consulta

                            // Verificar si hay resultados
                            if ($result->num_rows > 0) {
                                // Generar la tabla HTML con los resultados
                                echo "<table class='ventas-table'>";
                                echo "<thead><tr><th>Nombre Producto</th><th>Precio Producto</th><th>Kilos Llevados</th><th>Dinero Total</th><th>Fecha Vendido</th><th>Imagen</th></tr></thead>";
                                echo "<tbody>";

                                // Recorrer los resultados y mostrar cada fila de la tabla
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["Nombre_Producto"] . "</td>";
                                    echo "<td>" . $row["Precio_Producto"] . "</td>";
                                    echo "<td>" . $row["Kilos_Llevados"] . "</td>";
                                    echo "<td>" . $row["Dinero_total"] . "</td>";
                                    echo "<td>" . $row["Fecha_ingreso"] . "</td>";
                            
                                    // Obtener la imagen correspondiente al producto
                                    $img_query = "SELECT img FROM Productos WHERE nombre_Producto = '" . $row['Nombre_Producto'] . "'";
                                    $img_result = $conn->query($img_query);
                                    if ($img_result->num_rows > 0) {
                                        $img_row = $img_result->fetch_assoc();
                                        $img_src = $img_row['img'];
                                        echo "<td><img src='" . $img_src . "' alt='" . $row["Nombre_Producto"] . "'></td>";
                                    } else {
                                        echo "<td>No se encontró la imagen</td>";
                                    }
                            
                                    echo "</tr>";
                                }

                                echo "</tbody></table>";
                            } else {
                                echo "No se encontraron resultados.";
                            }

                        }    
                        $conn->close();
                        ?>

                        </div></center>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script> 
        window.onload = function() {
            $('#carga').fadeOut();
        };
    </script>    
</body>
</html>