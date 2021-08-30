<?php

    require 'partials/header.html';
    session_start();
?>
<body>
    <div class="container">
        <nav>
            <h2>ABM Sectores</h2>
            <div class="container-controles-nav">
                <img class="img-nav" src="assets/img/frigopico.png" alt="">
                <a href="cerrarsesion.php">
                    <button type="button" class="btn-nav">
                        <i class="uil uil-sign-out-alt"></i>
                    </button>             
                </a>                
            </div>
        </nav>
        <div class="container-abm-secores">
            <div class="container-tabla-sector">
                <div class="data-tabla">
                    <div class="colborder" id="id-tabla"></div>
                    <div class="colborder" id="sector-tabla"></div>
                </div>
                <div class="container-tabla">
                    <table id="tabla">
                        <thead>
                            <tr>
                                <th class="columna-header columna-controles" colspan="2">
                                    <span>Controles</span>
                                </th>  
                                <th class="columna-header columna-id">
                                    <span>Id</span>    
                                </th>
                                <th class="columna-header columna-sector">
                                    <span>Sector</span>
                                </th>     
                                <th class="columna-header columna-sector">
                                    <span>Color</span>
                                </th>              
                            </tr>   
                        </thead>
                        <tbody id="container-sectores">                     
                        </tbody>
                    </table>
                </div>
            </div>
            <form method="post" id="form-agregar-sector" class="container-agregar-sector">
                <h3>Agregar sector</h3>
                <div class="form-group">
                    <input type="hidden" id="id-sector">
                    <input type="text" id="nombre-sector" class="form-style" placeholder="Sector" autocomplete="off" required>
                    <i class="input-icon uil-chart-pie-alt"></i>
                </div>
                <div class="form-group">
                    <input type="color" class="form-color" id="color-sector" value="#2200ee" required>	
                    <i class="input-icon uil uil-palette"></i>
                </div>
                <input type="submit" class="btn-acceder" id="btn-agregar-nuevo-sector" value="Agregar">
            </form>
        </div>
    </div>    
</body>
<script src="assets/plugins/jquery-3.5.1.min.js"></script>
<script src="assets/plugins/sweetalert2.all.min.js"></script>
<script src="assets/scripts/abm-sectores.js"></script>
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
