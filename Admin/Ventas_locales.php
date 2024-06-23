<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bodega/Admin/assent/css/index_admin1.css">
    <title>Venta Locales</title>
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
            <div id="acciones" class="slide">
                <div id="ventasLocal1" class="ventas-local">
                    <h2>Ventas - Locales </h2>
                    <form action="Resultados_ventas.php" method="POST" >
                        <label for="ingresofecha">Filtrar por fecha</label>
                        <input type="text" id="ingresofecha" name="fecha" placeholder="Ingrese la fecha en formato DD/MM/YYYY"><br>
                        <label for="Local_vender">Ingrese El local</label>
                        <select name="local" id="Local_vender">
                            <option value="Elige_un_Local">Elige un Local</option>
                            <option value="Local1">Local 1</option>
                            <option value="Local2">Local 2</option>
                        </select><br>
                        <button type="submit" name="Buscar_ventas1">Buscar</button>
                    </form>

                    
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
