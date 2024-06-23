<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="http://localhost/Bodega/Admin/assent/js/Main3.js"></script>
    <link rel="stylesheet" href="http://localhost/Bodega/Admin/assent/css/index_admin2.css">
    <title>Resultado Total</title>
    <style>
        
.container {
    display: flex;
    justify-content: space-between;}

.local {
  flex: 1 1 100%;
  padding: 20px;
  border: 1px solid #ccc;
  margin-bottom: 20px;
}
@media only screen and (max-width: 768px) {
    .container {
  display: flex;
  flex-wrap: wrap;
}
}


.local {
  flex: 1;
  padding: 20px;
  border: 1px solid #ccc;
  margin-right: 20px;
}

.totals,
.details {
  margin-top: 10px;
}

/* Estilos para los encabezados de sección */
h3 {
  margin-top: 30px;
  margin-bottom: 10px;
  font-size: 24px;
  color: #333333;
  text-transform: uppercase;
  border-bottom: 2px solid #333333;
  padding-bottom: 5px;
}

/* Estilos para los encabezados de tabla */
th {
  background-color: #f8f9fa;
  color: #333333;
  font-weight: bold;
  text-transform: uppercase;
  padding: 10px 15px; /* Añadir un poco de espacio alrededor del texto */
  border-bottom: 2px solid #dee2e6; /* Línea inferior más suave */
}

/* Estilos para los encabezados de tabla */
th {
  background-color: #f8f9fa;
  color: #333333;
  font-weight: bold;
  text-transform: uppercase;
}

        /* Estilos para las tablas */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
  font-family: Arial, sans-serif;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

th, td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 12px;
}

th {
  background-color: #f8f9fa;
  color: #333333;
}

/* Estilos para los encabezados de sección */
h3 {
  margin-top: 30px;
  margin-bottom: 10px;
  font-size: 24px;
  color: #333333;
}

/* Estilos para los párrafos de total de ventas */
p {
  margin-bottom: 5px;
  font-weight: bold;
  font-size: 16px;
  color: #555555;
}

    </style>
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
<?php
// Incluir el archivo de conexión a la base de datos
include "conexion.php";

// Definir las variables para los resultados totales y detalles de ventas por local
$totalVentasLocal1 = $totalEfectivoLocal1 = $totalTarjetaLocal1 = $totalTransferenciaLocal1 = 0;
$totalVentasLocal2 = $totalEfectivoLocal2 = $totalTarjetaLocal2 = $totalTransferenciaLocal2 = 0;
$resultDetalleVentasLocal1 = $resultDetalleVentasLocal2 = null;

// Verificar si se ha enviado el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y obtener los datos del formulario
    $tipoBusqueda = $_POST['tipoBusqueda'];
    $fecha = $_POST['fecha'];

    // Construir la consulta SQL para el filtro por fecha
    $filtroFecha = "";
    if ($tipoBusqueda == "dia") {
        // No se realiza ninguna conversión, ya que el formato ingresado coincide con el de la base de datos
        $filtroFecha = " AND Fecha_ingreso = '$fecha'";
    } elseif ($tipoBusqueda == "mes") {
        // Para el formato de mes (mm/YY), podemos usar la función DATE_FORMAT para extraer el mes y el año de la fecha en la base de datos
        $filtroFecha = " AND fechames = '$fecha'";
    }

    // Consulta SQL para calcular el total de ventas para Local1 con filtro por fecha
    $sqlTotalVentasLocal1 = "SELECT SUM(Dinero_total) AS total_ventas_local1,
                                    SUM(CASE WHEN Tipo_de_venta = 'Efectivo' THEN Dinero_total ELSE 0 END) AS total_efectivo_local1,
                                    SUM(CASE WHEN Tipo_de_venta = 'Tarjeta' THEN Dinero_total ELSE 0 END) AS total_tarjeta_local1,
                                    SUM(CASE WHEN Tipo_de_venta = 'Transferencia' THEN Dinero_total ELSE 0 END) AS total_transferencia_local1
                            FROM ventas
                            WHERE Lugar_Venta = 'Local1' $filtroFecha";

    // Ejecutar la consulta SQL
    $resultTotalVentasLocal1 = $conn->query($sqlTotalVentasLocal1);

    // Verificar si se encontraron resultados
    if ($resultTotalVentasLocal1 !== false && $resultTotalVentasLocal1->num_rows > 0) {
        // Obtener los resultados
        $rowTotalVentasLocal1 = $resultTotalVentasLocal1->fetch_assoc();
        $totalVentasLocal1 = number_format($rowTotalVentasLocal1["total_ventas_local1"], 0, ',', '.');
        $totalEfectivoLocal1 = number_format($rowTotalVentasLocal1["total_efectivo_local1"], 0, ',', '.');
        $totalTarjetaLocal1 = number_format($rowTotalVentasLocal1["total_tarjeta_local1"], 0, ',', '.');
        $totalTransferenciaLocal1 = number_format($rowTotalVentasLocal1["total_transferencia_local1"], 0, ',', '.');
    }

    // Consulta SQL para calcular el total de ventas para Local2 con filtro por fecha
    $sqlTotalVentasLocal2 = "SELECT SUM(Dinero_total) AS total_ventas_local2,
                                    SUM(CASE WHEN Tipo_de_venta = 'Efectivo' THEN Dinero_total ELSE 0 END) AS total_efectivo_local2,
                                    SUM(CASE WHEN Tipo_de_venta = 'Tarjeta' THEN Dinero_total ELSE 0 END) AS total_tarjeta_local2,
                                    SUM(CASE WHEN Tipo_de_venta = 'Transferencia' THEN Dinero_total ELSE 0 END) AS total_transferencia_local2
                            FROM ventas
                            WHERE Lugar_Venta = 'Local2' $filtroFecha";

    // Ejecutar la consulta SQL
    $resultTotalVentasLocal2 = $conn->query($sqlTotalVentasLocal2);

    // Verificar si se encontraron resultados
    if ($resultTotalVentasLocal2 !== false && $resultTotalVentasLocal2->num_rows > 0) {
        // Obtener los resultados
        $rowTotalVentasLocal2 = $resultTotalVentasLocal2->fetch_assoc();
        $totalVentasLocal2 = number_format($rowTotalVentasLocal2["total_ventas_local2"], 0, ',', '.');
        $totalEfectivoLocal2 = number_format($rowTotalVentasLocal2["total_efectivo_local2"], 0, ',', '.');
        $totalTarjetaLocal2 = number_format($rowTotalVentasLocal2["total_tarjeta_local2"], 0, ',', '.');
        $totalTransferenciaLocal2 = number_format($rowTotalVentasLocal2["total_transferencia_local2"], 0, ',', '.');
    }

    // Consulta SQL para obtener los detalles de ventas por producto para Local1 con filtro por fecha
    $sqlDetalleVentasLocal1 = "SELECT Nombre_Producto, SUM(Kilos_Llevados) AS cantidad_vendida_local1,
                              SUM(CASE WHEN Tipo_de_venta = 'Efectivo' THEN Dinero_total ELSE 0 END) AS cantidad_efectivo_local1,
                              SUM(CASE WHEN Tipo_de_venta = 'Tarjeta' THEN Dinero_total ELSE 0 END) AS cantidad_tarjeta_local1,
                              SUM(CASE WHEN Tipo_de_venta = 'Transferencia' THEN Dinero_total ELSE 0 END) AS cantidad_transferencia_local1
                          FROM ventas
                          WHERE Lugar_Venta = 'Local1' $filtroFecha
                          GROUP BY Nombre_Producto";


    // Ejecutar la consulta SQL
    $resultDetalleVentasLocal1 = $conn->query($sqlDetalleVentasLocal1);

    // Consulta SQL para obtener los detalles de ventas por producto para Local2 con filtro por fecha
    $sqlDetalleVentasLocal2 = "SELECT Nombre_Producto, SUM(Kilos_Llevados) AS cantidad_vendida_local2,
                              SUM(CASE WHEN Tipo_de_venta = 'Efectivo' THEN Dinero_total ELSE 0 END) AS cantidad_efectivo_local2,
                              SUM(CASE WHEN Tipo_de_venta = 'Tarjeta' THEN Dinero_total ELSE 0 END) AS cantidad_tarjeta_local2,
                              SUM(CASE WHEN Tipo_de_venta = 'Transferencia' THEN Dinero_total ELSE 0 END) AS cantidad_transferencia_local2
                          FROM ventas
                          WHERE Lugar_Venta = 'Local2' $filtroFecha
                          GROUP BY Nombre_Producto";


    // Ejecutar la consulta SQL
    $resultDetalleVentasLocal2 = $conn->query($sqlDetalleVentasLocal2);
}
?>

<!-- Resultados de la Búsqueda -->
<br><br><br>
<center><button onclick="volver()">Volver inicio</button>
<br><br><br>
<?php
if ($resultDetalleVentasLocal1 !== null && $resultDetalleVentasLocal1 !== false && $resultDetalleVentasLocal1->num_rows > 0) {
} else {
    echo "<h1>No se encontraron ventas.</h1>";
}
?></center><br>
<div class="container">
    <div class="local">
        <!-- Contenido de Local1 -->
        <h3>Total de Ventas para Local1:</h3>
        <div class="totals" id="totalsLocal1">
            <p>Total: <?php echo $totalVentasLocal1; ?></p>
            <p>Efectivo: <?php echo $totalEfectivoLocal1; ?></p>
            <p>Tarjeta: <?php echo $totalTarjetaLocal1; ?></p>
            <p>Transferencia: <?php echo $totalTransferenciaLocal1; ?></p>
        </div>
        <!-- Detalle de Ventas por Producto para Local1 -->
        <h3>Detalle de Ventas por Producto para Local1:</h3>
        <div class="details" id="detailsLocal1">
            <?php
            if ($resultDetalleVentasLocal1 !== null && $resultDetalleVentasLocal1 !== false && $resultDetalleVentasLocal1->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad Vendida</th>
                            <th>Cantidad en Efectivo</th>
                            <th>Cantidad en Tarjeta</th>
                            <th>Cantidad en Transferencia</th>
                        </tr>";
                while ($rowDetalleVentasLocal1 = $resultDetalleVentasLocal1->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $rowDetalleVentasLocal1["Nombre_Producto"] . "</td>
                            <td>" . $rowDetalleVentasLocal1["cantidad_vendida_local1"] . "</td>
                            <td>" . $rowDetalleVentasLocal1["cantidad_efectivo_local1"] . "</td>
                            <td>" . $rowDetalleVentasLocal1["cantidad_tarjeta_local1"] . "</td>
                            <td>" . $rowDetalleVentasLocal1["cantidad_transferencia_local1"] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron ventas para Local1.";
            }
            ?>
        </div>
    </div>
    <div class="local">
        <!-- Contenido de Local2 -->
        <h3>Total de Ventas para Local2:</h3>
        <div class="totals" id="totalsLocal2">
            <p>Total: <?php echo $totalVentasLocal2; ?></p>
            <p>Efectivo: <?php echo $totalEfectivoLocal2; ?></p>
            <p>Tarjeta: <?php echo $totalTarjetaLocal2; ?></p>
            <p>Transferencia: <?php echo $totalTransferenciaLocal2; ?></p>
        </div>
        <!-- Detalle de Ventas por Producto para Local2 -->
        <h3>Detalle de Ventas por Producto para Local2:</h3>
        <div class="details" id="detailsLocal2">
            <?php
            if ($resultDetalleVentasLocal2 !== null && $resultDetalleVentasLocal2 !== false && $resultDetalleVentasLocal2->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad Vendida</th>
                            <th>Cantidad en Efectivo</th>
                            <th>Cantidad en Tarjeta</th>
                            <th>Cantidad en Transferencia</th>
                        </tr>";
                while ($rowDetalleVentasLocal2 = $resultDetalleVentasLocal2->fetch_assoc()) {
                    echo "<tr>
                            <td>". $rowDetalleVentasLocal2["Nombre_Producto"] . "</td>
                            <td>" . $rowDetalleVentasLocal2["cantidad_vendida_local2"] . "</td>
                            <td>" . $rowDetalleVentasLocal2["cantidad_efectivo_local2"] . "</td>
                            <td>" . $rowDetalleVentasLocal2["cantidad_tarjeta_local2"] . "</td>
                            <td>" . $rowDetalleVentasLocal2["cantidad_transferencia_local2"] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron ventas para Local2.";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script> 
        window.onload = function() {
            $('#carga').fadeOut();
        };
    </script>    
</body>
</html>