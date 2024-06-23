<?php
include('Con_db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir el contenido del inventario enviado desde JavaScript
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        // El diccionario del inventario estará en $data["inventario"]
        $inventario = $data["inventario"];

        // Verifica si el diccionario del inventario no está vacío
        if (!empty($inventario)) {
            // Configura la conexión a tu base de datos
            // Verifica la conexión
            if ($conex->connect_error) {
                die("Conexión fallida: " . $conex->connect_error);
            }

            // Recorre el diccionario e inserta cada producto en la base de datos
            foreach ($inventario as $nombreProducto => $detalles) {
                $nombreProducto = $conex->real_escape_string($nombreProducto);
                $precioProducto = $conex->real_escape_string($detalles["precio"]);
                $kilosLlevados = $conex->real_escape_string($detalles["cantidadKilos"]);
                // Aquí es donde se asigna la unidad
                $Unidad = $conex->real_escape_string($detalles["unidad"]);
                $fechaIngreso = date("d/m/y");
                $fechames = date("m/y");
                $lugarVenta = "Local2";
                // Obtener el método de pago del inventario
                $tipoPago = array_key_exists("metodoPago", $inventario) ? $conex->real_escape_string($inventario["metodoPago"]) : "";
            
                $query = "INSERT INTO ventas (Nombre_Producto, Precio_Producto, Kilos_Llevados, Dinero_total, Fecha_ingreso, fechames, Lugar_Venta, Tipo_de_venta) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
                $stmt = $conex->prepare($query);
            
                $stmt->bind_param("ssssssss", $nombreProducto, $precioProducto, $Unidad ,$kilosLlevados , $fechaIngreso, $fechames, $lugarVenta, $tipoPago);
            
                if ($stmt->execute()) {
                    echo "Registro insertado con éxito para $nombreProducto.<br>";
                } else {
                    echo "Error al insertar registro para $nombreProducto: " . $stmt->error . "<br>";
                }
            
                $stmt->close();
            }
            

            $conex->close();
        } else {
            echo "El diccionario del inventario está vacío.";
        }
    } else {
        echo "Error al decodificar los datos JSON.";
    }
} else {
}
?>
