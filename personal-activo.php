<?php

    session_start();
    require 'partials/header.php';
    require 'partials/conexion_por_planta.php';    

    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('Y-m-d');
?>
<body>
    <div class="container">
            <nav style="--delay: .3s">
                <h2>Personal Activo</h2>
                <div class="container-controles-nav">
                    <img class="img-nav" src="assets/img/frigopico.png" alt="">
                    <a href="cerrarsesion.php">
                        <button type="button" class="btn-nav">
                            <i class="uil uil-sign-out-alt"></i>
                        </button>                 
                    </a>                
                </div>
            </nav>
            <div class="container-tabla-pesonal">
                <div class="container-tabla" style="--delay: .6s">
                    <table id="tabla">
                        <thead>
                            <tr>
                                <th class="columna-header">
                                    <span>Controles</span>    
                                </th>
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
                            </tr>   
                        </thead>
                        <tbody id="container-personal-activo">                     
                        </tbody>
                    </table>
                </div>            
            </div>
        </div>
    </div>
</body>
<script src="assets/plugins/jquery-3.5.1.min.js"></script>
<script src="assets/plugins/sweetalert2.all.min.js"></script>
<script src="assets/scripts/personal-activo.js"></script>
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