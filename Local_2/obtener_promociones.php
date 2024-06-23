<?php
// Conecta con la base de datos
include ("Con_db.php");

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las promociones aplicables
$sql = "SELECT * FROM `promociones`";
$result = $conn->query($sql);

// Prepara el array para almacenar las promociones
$promociones = array();

// Verifica si hay resultados
if ($result->num_rows > 0) {
    // Itera sobre los resultados y agrega cada promoción al array
    while ($row = $result->fetch_assoc()) {
        $promociones[] = $row;
    }
}

// Retorna las promociones en formato JSON
echo json_encode(array("promociones" => $promociones));

// Cierra la conexión
$conn->close();
?>
