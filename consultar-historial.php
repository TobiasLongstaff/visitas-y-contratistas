<?php
    require 'partials/header.html';
    require 'partials/conexion.php';
    session_start();

    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('Y-m-d');
?>
<body>
    <div class="container">
        <nav>
            <h2>Consultar historial</h2>
            <div class="container-controles-nav">
                <img class="img-nav" src="assets/img/frigopico.png" alt="">
                <a href="cerrarsesion.php">
                    <button type="button" class="btn-nav">
                        <i class="uil uil-sign-out-alt"></i>
                    </button>                 
                </a>                
            </div>
        </nav>
        <div class="container-tabla-historial">
            <div class="container-tabla">
                <table id="tabla">
                    <thead>
                        <tr>
                            <th class="columna-header">
                                <span>Id</span>    
                            </th>
                            <th class="columna-header">
                                <span>Nombre y apellido</span>
                            </th>     
                            <th class="columna-header">
                                <span>DNI</span>
                            </th>  
                            <th class="columna-header">
                                <span>Empresa</span>
                            </th>     
                            <th class="columna-header">
                                <span>Sector habilitado</span>
                            </th>  
                            <th class="columna-header">
                                <span>Visita a</span>
                            </th>  
                            <th class="columna-header">
                                <span>Fecha y hora</span>
                            </th>  
                            <th class="columna-header">
                                <span>Usuario</span>
                            </th>  
                        </tr>   
                    </thead>
                    <tbody id="container-historial">                     
                    </tbody>
                </table>
            </div>            
        </div>
    </div>
</body>
<script src="assets/plugins/jquery-3.5.1.min.js"></script>
<script src="assets/plugins/sweetalert2.all.min.js"></script>
<script src="assets/scripts/consultar-historial.js"></script>
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