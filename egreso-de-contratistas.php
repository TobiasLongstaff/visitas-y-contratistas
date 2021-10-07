<?php
    session_start();
    require 'partials/header.html';
    require 'partials/conexion_por_planta.php';

    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('Y-m-d H:i');
    $fecha_actual = str_replace(' ','T', $fecha_actual);
?>
<body>
    <div class="container">
        <nav style="--delay: .3s">
            <h2>Egreso de Contratistas</h2>
            <div class="container-controles-nav">
                <img class="img-nav" src="assets/img/frigopico.png" alt="">
                <a href="cerrarsesion.php">
                    <button type="button" class="btn-nav">
                        <i class="uil uil-sign-out-alt"></i>
                    </button>                 
                </a>                
            </div>
        </nav>
        <div class="container-egreso-de-contratistas">
            <div class="container-codigo-qr" style="--delay: .5s">
                <i class="icono-qr uil uil-qrcode-scan"></i>
                <h2>Escanear codigo QR</h2>
                <input type="password" id="codigo-contratista" class="form-qr" placeholder="Codigo QR" autocomplete="off" required>
            </div>
            <form method="post" id="form-egreso-de-contratista" class="container-info-egreso-de-contratistas" style="--delay: .6s">
                <input type="hidden" id="id-trabajador">
                <div class="form-group">
                    <input type="search" id="buscar-nombres" class="form-style-search" placeholder="Buscar por nombre" autocomplete="off">
                    <i class="input-icon uil uil-search"></i>
                </div>
                <div id="container-nombres">
                </div>
                <div class="container-info-contratistas" id="container-info-contratistas">
                </div> 
                <input type="submit" class="btn-acceder" value="Egresar Contratista">              
            </form>
        </div>
    </div>
</body>
<script src="assets/plugins/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="assets/plugins/sweetalert2.all.min.js"></script>
<script src="assets/scripts/egreso-de-contratistas.js"></script>
<?php

    if($_SESSION['planta_usuario'] == 'Landl')
    {
?>
        <script type="text/javascript">
            $('body').css("background-image", "url(assets/img/fondo-landl.jpg)"); 
            $('.img-nav').attr("src", "assets/img/Landl.png")</script>
        </script>
<?php
    }
?>
</html>