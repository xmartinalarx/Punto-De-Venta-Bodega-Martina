<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bodega/Admin/assent/css/index_admin1.css">
    <title>Administración Bodega Martina</title>
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
    <div class="arriva"><h3 class ="logo3"><a class="logo"><span>Bodega</span>Martina</a></h3></div>
        <?php
            date_default_timezone_set('America/Santiago');
            include("conexion.php"); 
        ?>
        <center><br><br>
            <div class="slide">
            <a class="logo2"><span></span>Bienvenido</a><br>
            <a class="logo2" style="font-size:30px;"><span>a</span> Administración</a><br>
            <a class="logo2"><span>Bodega</span>Martina</a>

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
