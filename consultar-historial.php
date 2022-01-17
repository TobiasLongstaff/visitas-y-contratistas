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
            <form method="post" id="form-filtrar-historial" class="container-buscar" style="--delay: .5s">
                <div class="form-group" style="margin: 0">
                    <select id="selectlist-filtrar" class="form-style" style="width: 100%">
                        <option value="Todos">Todos</option>
                        <option value="Visita">Visitas</option>
                        <option value="Contratista">Contratistas</option>
                    </select>                    
                    <i class="input-icon uil uil-filter"></i>
                </div>
                <div class="form-group" style="margin: 0">
                    <input type="search" id="buscar-nombres" class="form-style-search" placeholder="Buscar por DNI" autocomplete="off">
                    <i class="input-icon uil uil-postcard"></i>
                </div>
                <div class="form-group" style="margin: 0">
                    <input id="fecha-filtro" class="form-style-date" type="date" max="<?=$fecha_actual?>">
                </div>
                <button type="submit" class="btn-filtrar-contratista"><i class="uil uil-search"></i></button> 
            </form>
            <?php
                if($_SESSION['planta_usuario'] == 'Landl')
                {
                ?>
                    <button type="button" id="imprimir-historial" class="btn-buscar-qr">
                        Imprimir ingreso y egreso
                        <i class="uil uil-clipboard-alt"></i>
                    </button>
                <?php
                }
            ?>
            <div class="tbl-header" style="--delay: .6s">
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
                </table>
            </div>  
            <div class="tbl-content" style="--delay: .6s">
                <table id="tabla"> 
                    <tbody id="container-historial">
                        <div class="container-carga">
                            <div class="loader"></div>
                        </div>
                    </tbody>
                </table>
                <button type="button" id="cargar-mas-filas" class="file-upload-btn">
                    <i class="uil uil-angle-down"></i>
                </button>
            </div>          
        </div>
    </div>
    <div class="overlay" id="overlay">
        <div class="container-popup-imprimir" id="popup">
            <div class="header-popup-imprimir">
                <h2>Elegir Fechas</h2>
                <hr>
                <form id="form-imprimir-historial" method="post">
                    <div class="form-group">
                        <label>Fecha Desde</label>
                        <input type="date" id="fecha-desde" class="form-style-date" max="<?=$fecha_actual?>" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha Hasta</label>
                        <input type="date" id="fecha-hasta" class="form-style-date" max="<?=$fecha_actual?>" required>
                    </div>
                    <input type="submit" class="btn-acceder-imprimir" value="Imprimir">
                    <button type="button" id="btn-cerrar-popup" class="btn-acceder-imprimir btn-secundario-imprimir">Cerrar</button>
                </form>
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