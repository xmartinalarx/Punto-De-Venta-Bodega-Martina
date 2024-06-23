<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="http://localhost/Bodega/Admin/assent/js/Main3.js"></script>
    <link rel="stylesheet" href="http://localhost/Bodega/Admin/assent/css/index_admin1.css">
    <title>Resultado Total</title>
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
        
        .container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .local {
            flex: 1 1 100%;
            padding: 20px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            margin-top: 20px;
        }

        .details th, .details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .details th {
            background-color: #f2f2f2;
        }

        .details tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .details tr:hover {
            background-color: #ddd;
        }

        .details th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }

        /* Estilos para el botón */
        .details button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .details button:hover {
            background-color: #45a049;
        }

        /* Estilos para el formulario */
        .search-form {
            margin-bottom: 20px;
        }

        .search-form label {
            margin-right: 10px;
        }

        .search-form input[type="text"], .search-form select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-form button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-form button[type="submit"]:hover {
            background-color: #45a049;
        }
        /* Tus estilos CSS van aquí */
    </style>
</head>
<body>
<!-- Contenido HTML y estilos CSS -->

<?php
// Incluir el archivo de conexión a la base de datos
include "conexion.php";

// Consulta SQL para obtener todos los movimientos de la tabla movimientos_bodega


// Verificar si se ha enviado el formulario de búsqueda
// Verificar si se ha enviado el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y obtener los datos del formulario
    $tipoBusqueda = $_POST['tipoBusqueda'];
    $tipoBusqueda2 = $_POST['tipoBusqueda2'];
    $fecha = $_POST['fecha'];

    // Construir la consulta SQL inicial
    $sqlMovimientos = "SELECT * FROM `movimientos_bodega`";

    // Construir el filtro por local
    $filtroLocal = "";
    if ($tipoBusqueda2 != "todas") {
        // Si el tipo de búsqueda por local no es "todas", agregar el filtro
        $filtroLocal = " WHERE `Local` = '$tipoBusqueda2'";
    }

    // Agregar el filtro por local a la consulta SQL principal si no es "todas"
    $sqlMovimientos .= ($tipoBusqueda2 != "todas") ? $filtroLocal : '';

    // Construir el filtro por fecha
    $filtroFecha = "";
    if ($tipoBusqueda == "dia") {
        // Formatear la fecha para que coincida con el formato de la base de datos (asumiendo que es 'YYYY-MM-DD')
        $fechaFormateada = date('d/m/Y', strtotime($fecha));
        $filtroFecha = " AND `Fecha Ingreso` = '$fechaFormateada'";
    } elseif ($tipoBusqueda == "mes") {
        // Convertir el formato de la fecha ingresada por el usuario ('02/2024') al formato esperado en la base de datos ('YYYY-MM-DD')
        $fechaFormateada2 = date("m/Y");
        $filtroFecha = " AND `Mes_Ingreso` = '$fechaFormateada2'" ;
    }

    // Agregar el filtro de fecha a la consulta SQL principal
    $sqlMovimientos .= $filtroFecha;
}


// Ejecutar la consulta SQL
$resultMovimientos = $conn->query($sqlMovimientos);
?>

<!-- Resultados de la búsqueda -->
<br><br><br>
<!-- Formulario de búsqueda -->
<!-- Contenedor de resultados -->
<div class="container">
    <div class="local">
        <!-- Contenido de los movimientos -->
        <center><h3>Movimientos de la bodega:</h3>
        <button onclick="volver()">Volver inicio</button></center>
        <div class="details" id="detailsMovimientos">
            <?php
            if ($resultMovimientos !== null && $resultMovimientos !== false && $resultMovimientos->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad Enviada</th>
                            <th>Fecha de Ingreso</th>
                            <th>Hora de Ingreso</th>
                            <th>Mes Ingreso</th>
                            <th>Local</th>
                        </tr>";
                while ($rowMovimiento = $resultMovimientos->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $rowMovimiento["Nombre Producto"] . "</td>
                            <td>" . $rowMovimiento["Cantidad_enviada"] . "</td>
                            <td>" . $rowMovimiento["Fecha Ingreso"] . "</td>
                            <td>" . $rowMovimiento["Hora Ingreso"] . "</td>
                            <td>" . $rowMovimiento["Mes_Ingreso"] . "</td>
                            <td>" . $rowMovimiento["Local"] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron movimientos en la bodega.";
            }
            ?>
        </div>
    </div>
</div>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script> 
    // Tu script JavaScript va aquí
    window.onload = function() {
        $('#carga').fadeOut();
    };
</script>    
</body>
</html>
