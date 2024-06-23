<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodega Martina 1</title>

    <!-- box icons  -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- styles  -->
    <link rel="stylesheet" href="http://localhost/Bodega/Local_1/assent_Local1/css/style_Local1.css">
</head>
<?php
    include('Recibir.php');
    include('Con_db.php');
    define('BASE_URL', 'http://localhost/Bodega/');
    ?>
<body>
    <!-- HEADER  -->
    <header>
        <!-- NAV  -->
        <div class="nav container">
            <a href="#" class="logo"><span>Bodega</span>Martina</a>
            <!-- CART ICON  -->
            <i class='bx bx-shopping-bag' id="cart-icon"></i>

            <!-- CART  -->
            <div class="cart active">
                <h2 class="cart-title">Compra</h2>

                <!-- CONTENT  -->
                <div class="cart-content">
 

                </div>

                <!-- TOTAL   -->
                <div class="total">
                    <div class="total-title">Total</div>
                    <div class="total-price">$0</div>
                </div>

                <!-- BUY BUTTON  -->
                <center>
                <br><button id="apply-discounts-btn">Agregar Descuentos</button><br><br>
                <div id="" class="Descuentoss">
                    <center><h3>Descuentos:</h3></center>
                    <div  class="Descuentos">

                    </div>

                </div> <br><hr>
                
                <button class=" b btn-pagar" id="btn-pagar-efectivo" value="Efectivo" onclick="reloadPage()">Pagar efectivo</button>
                <button class=" c btn-pagar" id="btn-pagar-tarjeta" value="Tarjeta" onclick="reloadPage()">Pagar tarjeta</button>
                <button class=" d btn-pagar" id="btn-pagar-transferencia" value="Transferencia" onclick="reloadPage()">Pagar transferencia</button>
                </center>
                <!-- CART CLOSE  -->
                <i class='bx bx-x' id="cart-close"></i>
            </div>
        </div>
    </header>
<section>
<div id="bodega" class="slide"> 
            <h2 style="margin-left:21%;">Contenido Local 1</h2><br>
                <button class="slide-button" onclick="Pollo()">Pollo</button>
                <button class="slide-button" onclick="Pavo()">Pavo</button>
                <button class="slide-button" onclick="Cerdo()">Cerdo</button>
                <button class="slide-button" onclick="Vacuno()">Vacuno</button>
                <button class="slide-button" onclick="Embutidos()">Embutidos</button>
                <button class="slide-button" onclick="Congelados()">Congelados</button>
                <button class="slide-button" onclick="Abarrotes()">Abarrotes</button>

</div>
<div class="bodega-slider" style="margin-top:1%;">
    
    <div class="sliders" id="Pollo">
        <h2 class="section-title">Pollo</h2>
        <div class="shop-content">
            <?php
            $consultar_productos = mysqli_query($conex, "SELECT l.*, p.Precio_Producto FROM `local_1` l JOIN `productos` p ON l.Nombre_Producto = p.nombre_Producto WHERE l.`Tipo` = 'Pollo' AND l.Cantidad_Kilos > 0");
            $resultado_final = mysqli_num_rows($consultar_productos);
            
            if ($resultado_final > 0) {
                while ($data = mysqli_fetch_array($consultar_productos)) {
            ?>
                    <div class="product-box">
                        <img src="<?php echo BASE_URL . "Admin/" . $data["img"] ?>" alt="" class="product-img">
                        <h2 class="product-title"><?php echo $data["Nombre_Producto"] ?></h2>
                        <span class="product-price"><?php echo $data["Precio_Producto"] ?></span>
                        <i name="Entrar" class='bx bx-shopping-bag add-cart'> AGREGAR</i>
                    </div>
            <?php
                }
            } else {
                echo "<h2 style='margin-left:11%;'>Sin Stock de producto <br>(Porfavor llamar supervisor)</h2>";
            }
            ?>
        </div>
    </div>

    <div class="sliders" id="Cerdo" style="display: none;">
        <h2 class="section-title">Cerdo</h2>
        <div class="shop-content">
            <?php
            $consultar_productos = mysqli_query($conex, "SELECT l.*, p.Precio_Producto FROM `local_1` l JOIN `productos` p ON l.Nombre_Producto = p.nombre_Producto WHERE l.`Tipo` = 'Cerdo' AND l.Cantidad_Kilos > 0");
            $resultado_final = mysqli_num_rows($consultar_productos);
            
            if ($resultado_final > 0) {
                while ($data = mysqli_fetch_array($consultar_productos)) {
            ?>
                    <div class="product-box">
                        <img src="<?php echo BASE_URL . "Admin/" . $data["img"] ?>" alt="" class="product-img">
                        <h2 class="product-title"><?php echo $data["Nombre_Producto"] ?></h2>
                        <span class="product-price"><?php echo $data["Precio_Producto"] ?></span>
                        <i name="Entrar" class='bx bx-shopping-bag add-cart'> AGREGAR</i>
                    </div>
            <?php
                }
            } else {
                echo "<h2 style='margin-left:11%;'>Sin Stock de producto <br>(Porfavor llamar supervisor)</h2>";
            }
            ?>
        </div>
    </div>

    <div class="sliders" id="Vacuno" style="display: none;">
        <h2 class="section-title">Vacuno</h2>
        <div class="shop-content">
            <?php
            $consultar_productos = mysqli_query($conex, "SELECT l.*, p.Precio_Producto FROM `local_1` l JOIN `productos` p ON l.Nombre_Producto = p.nombre_Producto WHERE l.`Tipo` = 'Vacuno' AND l.Cantidad_Kilos > 0");
            $resultado_final = mysqli_num_rows($consultar_productos);
            
            if ($resultado_final > 0) {
                while ($data = mysqli_fetch_array($consultar_productos)) {
            ?>
                    <div class="product-box">
                        <img src="<?php echo BASE_URL . "Admin/" . $data["img"] ?>" alt="" class="product-img">
                        <h2 class="product-title"><?php echo $data["Nombre_Producto"] ?></h2>
                        <span class="product-price"><?php echo $data["Precio_Producto"] ?></span>
                        <i name="Entrar" class='bx bx-shopping-bag add-cart'> AGREGAR</i>
                    </div>
            <?php
                }
            } else {
                echo "<h2 style='margin-left:11%;'>Sin Stock de producto <br>(Porfavor llamar supervisor)</h2>";
            }
            ?>
        </div>
    </div>

    <div class="sliders" id="Pavo" style="display: none;">
        <h2 class="section-title">Pavo</h2>
        <div class="shop-content">
            <?php
            $consultar_productos = mysqli_query($conex, "SELECT l.*, p.Precio_Producto FROM `local_1` l JOIN `productos` p ON l.Nombre_Producto = p.nombre_Producto WHERE l.`Tipo` = 'Pavo' AND l.Cantidad_Kilos > 0");
            $resultado_final = mysqli_num_rows($consultar_productos);
            
            if ($resultado_final > 0) {
                while ($data = mysqli_fetch_array($consultar_productos)) {
            ?>
                    <div class="product-box">
                        <img src="<?php echo BASE_URL . "Admin/" . $data["img"] ?>" alt="" class="product-img">
                        <h2 class="product-title"><?php echo $data["Nombre_Producto"] ?></h2>
                        <span class="product-price"><?php echo $data["Precio_Producto"] ?></span>
                        <i name="Entrar" class='bx bx-shopping-bag add-cart'> AGREGAR</i>
                    </div>
            <?php
                }
            } else {
                echo "<h2 style='margin-left:11%;'>Sin Stock de producto <br>(Porfavor llamar supervisor)</h2>";
            }
            ?>
        </div>
    </div>

    <div class="sliders" id="Embutidos" style="display: none;">
        <h2 class="section-title">Embutidos</h2>
        <div class="shop-content">
            <?php
            $consultar_productos = mysqli_query($conex, "SELECT l.*, p.Precio_Producto FROM `local_1` l JOIN `productos` p ON l.Nombre_Producto = p.nombre_Producto WHERE l.`Tipo` = 'Embutidos' AND l.Cantidad_Kilos > 0");
            $resultado_final = mysqli_num_rows($consultar_productos);
            
            if ($resultado_final > 0) {
                while ($data = mysqli_fetch_array($consultar_productos)) {
            ?>
                    <div class="product-box">
                        <img src="<?php echo BASE_URL . "Admin/" . $data["img"] ?>" alt="" class="product-img">
                        <h2 class="product-title"><?php echo $data["Nombre_Producto"] ?></h2>
                        <span class="product-price"><?php echo $data["Precio_Producto"] ?></span>
                        <i name="Entrar" class='bx bx-shopping-bag add-cart'> AGREGAR</i>
                    </div>
            <?php
                }
            } else {
                echo "<h2 style='margin-left:11%;'>Sin Stock de producto <br>(Porfavor llamar supervisor)</h2>";
            }
            ?>
        </div>
    </div>

    <div class="sliders" id="Congelados" style="display: none;">
        <h2 class="section-title">Congelados</h2>
        <div class="shop-content">
            <?php
            $consultar_productos = mysqli_query($conex, "SELECT l.*, p.Precio_Producto FROM `local_1` l JOIN `productos` p ON l.Nombre_Producto = p.nombre_Producto WHERE l.`Tipo` = 'Congelados' AND l.Cantidad_Kilos > 0");
            $resultado_final = mysqli_num_rows($consultar_productos);
            
            if ($resultado_final > 0) {
                while ($data = mysqli_fetch_array($consultar_productos)) {
            ?>
                    <div class="product-box">
                        <img src="<?php echo BASE_URL . "Admin/" . $data["img"] ?>" alt="" class="product-img">
                        <h2 class="product-title"><?php echo $data["Nombre_Producto"] ?></h2>
                        <span class="product-price"><?php echo $data["Precio_Producto"] ?></span>
                        <i name="Entrar" class='bx bx-shopping-bag add-cart'> AGREGAR</i>
                    </div>
            <?php
                }
            } else {
                echo "<h2 style='margin-left:11%;'>Sin Stock de producto <br>(Porfavor llamar supervisor)</h2>";
            }
            ?>
        </div>
    </div>

    <div class="sliders" id="Abarrotes" style="display: none;">
        <h2 class="section-title">Abarrotes</h2>
        <div class="shop-content">
            <?php
            $consultar_productos = mysqli_query($conex, "SELECT l.*, p.Precio_Producto FROM `local_1` l JOIN `productos` p ON l.Nombre_Producto = p.nombre_Producto WHERE l.`Tipo` = 'Abarrotes' AND l.Cantidad_Kilos > 0");
            $resultado_final = mysqli_num_rows($consultar_productos);
            
            if ($resultado_final > 0) {
                while ($data = mysqli_fetch_array($consultar_productos)) {
            ?>
                    <div class="product-box">
                        <img src="<?php echo BASE_URL . "Admin/" . $data["img"] ?>" alt="" class="product-img">
                        <h2 class="product-title"><?php echo $data["Nombre_Producto"] ?></h2>
                        <span class="product-price"><?php echo $data["Precio_Producto"] ?></span>
                        <i name="Entrar" class='bx bx-shopping-bag add-cart'> AGREGAR</i>
                    </div>
            <?php
                }
            } else {
                echo "<h2 style='margin-left:11%;'>Sin Stock de producto <br>(Porfavor llamar supervisor)</h2>";
            }
            ?>
        </div>
    </div>

</div>

    <!-- link js  -->
    <script src="http://localhost/Bodega/Local_1/assent_Local1/js/Local_11.js"></script>
    <script>
    function Pollo() {
    document.getElementById('Pollo').style.display = 'block';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';

}
function Cerdo() {
    document.getElementById('Cerdo').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Vacuno() {
    document.getElementById('Vacuno').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Pavo() {
    document.getElementById('Pavo').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Embutidos() {
    document.getElementById('Embutidos').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
}
function Congelados() {
    document.getElementById('Congelados').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Abarrotes').style.display = 'none';
    }
function Abarrotes() {
    document.getElementById('Abarrotes').style.display = 'block';
    document.getElementById('Pollo').style.display = 'none';
    document.getElementById('Cerdo').style.display = 'none';
    document.getElementById('Vacuno').style.display = 'none';
    document.getElementById('Pavo').style.display = 'none';
    document.getElementById('Embutidos').style.display = 'none';
    document.getElementById('Congelados').style.display = 'none';
}
</script>
<style>
    .bodega-slider {
    display: flex;

}


.sliders {
    flex: 0 0 auto;
    width: 73%;
    border: 1px solid #ccc;
    padding: 20px;
    box-sizing: border-box;
}

.bodega-slider h2 {
    text-align: center;
}
.slide-button {
    margin: 5px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #3865ff;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.2s;
}

.slide-button:hover {
    background-color: #45a049;
    transform: scale(1.05); /* Efecto de escala al pasar el cursor */
}

.slide-button:focus {
    outline: none; /* Eliminar el contorno al hacer clic */
}

.slide-button:active {
    transform: scale(0.95); /* Efecto de escala al hacer clic */
}

</style>

</body>

</html>