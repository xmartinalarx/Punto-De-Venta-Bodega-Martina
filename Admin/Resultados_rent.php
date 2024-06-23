<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentabilidad</title>
    <script defer src="http://localhost/Bodega/Admin/assent/js/Main3.js"></script>
    <link rel="stylesheet" href="http://localhost/Bodega/Admin/assent/css/index_admin2.css">
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
include "conexion.php";
// Verificar si se ha enviado el formulario con el mes
if (isset($_GET['mes'])) {
    // Obtener el mes enviado por el formulario
    $mes = $_GET['mes'];
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL con el mes como filtro
    $sql = "SELECT id, mes_entrada, fecha_entrada, hora_entrada, Nombre_Producto, Nombre_Provedores, Cantidad_Comprada, Total_Rentabilidad, (Cantidad_Comprada * Total_Rentabilidad / 100) AS Ganancia
            FROM rentabilidad 
            WHERE mes_entrada LIKE '%$mes%'";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Mostrar la tabla de resultados
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Mes de Entrada</th>
                    <th>Fecha de Entrada</th>
                    <th>Hora de Entrada</th>
                    <th>Nombre Producto</th>
                    <th>Nombre Proveedor</th>
                    <th>Cantidad Comprada</th>
                    <th>Total Rentabilidad</th>
                    <th>Ganancia</th>
                </tr>";
        // Mostrar cada fila de resultados
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['mes_entrada']}</td>
                    <td>{$row['fecha_entrada']}</td>
                    <td>{$row['hora_entrada']}</td>
                    <td>{$row['Nombre_Producto']}</td>
                    <td>{$row['Nombre_Provedores']}</td>
                    <td> $ {$row['Cantidad_Comprada']}</td>
                    <td>{$row['Total_Rentabilidad']}</td>
                    <td>$ {$row['Ganancia']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados para el mes ingresado.";
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Si no se ha enviado el formulario, redirigir a la página principal
    header("Location: index.php");
    exit();
}
?> </div></center>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script> 
        window.onload = function() {
            $('#carga').fadeOut();
        };
    </script>    
</body>
</html>
