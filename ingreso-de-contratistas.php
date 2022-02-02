<?php

    session_start();
    require 'partials/header.php';
    require 'partials/conexion_por_planta.php';

    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('Y-m-d H:i');
    $fecha_actual = str_replace(' ','T', $fecha_actual);
?>
<body>
    <div class="container">
        <nav style="--delay: .3s">
            <div class="container-volver-nav">
                <button type="button" id="btn-volver" class="btn-volver">
                    <i class="uil uil-angle-left"></i>
                </button>
                <h2>Ingreso de contratistas</h2>
            </div>
            <div class="container-controles-nav">
                <img class="img-nav" src="assets/img/frigopico.png" alt="">
                <a href="cerrarsesion.php">
                    <button type="button" class="btn-nav">
                        <i class="uil uil-sign-out-alt"></i>
                    </button>                 
                </a>                
            </div>
        </nav>
        <div class="container-btn-opciones" style="--delay: .2s">
            <button id="nuevo-contratista" class="btn-general-opciones btn-prevision-left prevision-select">Crear Nuevo</button>
            <button id="ingresar-contratista" class="btn-general-opciones btn-prevision-right">Ingresar</button>
        </div>
        <div class="container-form-ingreso-contratistas" id="opcion-nuevo">
            <form class="container-left-ingreso" id="form-ingreso-de-contratistas" method="post" style="--delay: .5s">
                <input type="hidden" id="imagen-perfil">
                <input type="hidden" id="imagen-art">
                <div class="form-group">
                    <input type="text" id="nombre-apellido" maxlength="40" class="form-style" placeholder="Nombre y Apellido" autocomplete="off" required>
                    <i class="input-icon uil uil-user"></i>
                </div>	
                <div class="form-group">
                    <input type="text" id="dni" class="form-style" placeholder="DNI" autocomplete="off" required>
                    <i class="input-icon uil uil-postcard"></i>
                </div>
                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input id="fecha-de-nacimiento" class="form-style-date" type="date" required>
                </div>
                <div class="form-group">
                    <input type="search" id="buscar-empresa" class="form-style-search" placeholder="Empresa">
                    <i class="input-icon uil uil-building"></i>
                    <div id="container-empresas"></div>
                </div>
                <div id="container-empresas"></div>
                <div class="form-group">
                    <input type="text" id="temperatura" class="form-style" placeholder="Temperatura" autocomplete="off" required>
                    <i class="input-icon uil uil-temperature-half"></i>
                </div>
                <div class="form-group">
                    <select class="form-style" autocomplete="off" id="sector-habilitado" required>
                        <option value="" selected disabled>Sector Habilitado</option>
                        <?php
                            $sql="SELECT * FROM sector";
                            $resultado=mysqli_query($conexion,$sql);
                            while($filas = mysqli_fetch_array($resultado))
                            {
                                echo '<option value="'.$filas['nombre'].'">'.$filas['nombre'].'</option>';
                            }
                            mysqli_close($conexion);
                        ?>
                    </select>
                    <i class="input-icon uil-chart-pie-alt"></i>
                </div>
                <div class="form-group">
                    <input type="text" id="vehiculo-modelo" class="form-style" placeholder="Vehiculo Modelo" autocomplete="off">
                    <i class="input-icon uil-car-sideview"></i>
                </div>
                <div class="form-group">
                    <input type="text" id="patente" class="form-style" placeholder="Patente" autocomplete="off">
                    <i class="input-icon uil uil-car"></i>
                </div>
                <label>Vencimiento ART</label>
                <div class="form-group">
                    <input type="date" id="fecha-art" class="form-style">
                    <div class="validar-art"></div>
                </div>
                <!-- <div class="form-group">
                    <select id="registra-fichada" class="form-style" autocomplete="off">
                        <option value="" selected disabled>Registra Fichada S/N</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <i class="input-icon uil uil-registered"></i>
                </div> -->
                <div class="form-group">
                    <label>Fecha y Hora de entrada</label>
                    <input type="datetime-local" id="fecha-hora" class="form-style-date" required value="<?=$fecha_actual?>">
                </div>
                <div class="form-group">
                    <label>Fecha de salida</label>
                    <input type="date" id="fecha-de-salida" class="form-style-date" required>
                </div>
                <label>Observacion:</label>
                <textarea class="form-style-textarea" id="observacion"></textarea>  
                <div>
                    <input type="submit" class="btn-acceder" value="Guardar e Imprimir">
                    <button type="button" id="btn-cancelar" class="btn-acceder btn-secundario">Cancelar</button>
                </div> 
            </form>
            <div class="container-right-contratistas" style="--delay: .6s">
                <div class="container-escanear-dni">
                    <button type="button" class="btn-dni" id="btn-dni">
                        <span>Precionar para escaner DNI</span><br>
                        <i class="icono-barcode fas fa-barcode"></i>
                    </button>
                </div>
                <form id="form-cargar-datos-dni" class="container-cargar-datos-dni" method="post">
                    <input type="text" id="textbox-codigo" autocomplete="off" class="textbox-dni">
                </form>
                <form method="post">
                    <div class="file-upload">
                        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Agregar Imagen de Perfil</button>
                        <progress class="barra-progreso" id="img-upload-bar" value="0" max="100"></progress>
                        <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' id="btn-subir-imagen-sistema" onchange="readURL(this);" accept="image/*" />
                            <div class="drag-text">
                            <h3>Arrastre o suelte un imagen o seleccione agregar imagen de perfil</h3>
                            </div>
                        </div>
                        <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="your image" />
                            <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remover <span class="image-title">Uploaded Image</span></button>
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" class="container-img-art">
                    <div class="file-upload">
                        <button class="file-upload-btn-art" type="button" onclick="$('.file-upload-input-art').trigger( 'click' )">Agregar Imagen de ART</button>
                        <progress class="barra-progreso" id="img-upload-bar-art" value="0" max="100"></progress>
                        <div class="imagen-upload-art">
                            <input class="file-upload-input-art" type='file' id="btn-subir-imagen-art" onchange="readURL_art(this);" accept="image/*" />
                            <div class="drag-text">
                            <h3>Arrastre o suelte un imagen o seleccione agregar imagen de ART</h3>
                            </div>
                        </div>
                        <div class="file-upload-content-art">
                            <img class="file-upload-image-art" src="#" alt="your image" />
                            <div class="image-title-wrap-art">
                                <button type="button" onclick="removeUpload_art()" class="remove-image">Remover <span class="image-title">Uploaded Image</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>                
        </div>
        <div class="container-tabla-historial" id="opcion-ingresar">
            <div style="width: 100%">
                <form id="form-filtrar-dni" class="form-filtrar-dni" method="post">
                    <div class="form-group" style="margin: 0">
                        <input type="search" id="buscar-nombres" class="form-style-search" placeholder="Buscar por DNI o nombre" autocomplete="off">
                        <i class="input-icon uil uil-postcard"></i>
                    </div>
                    <button type="submit" class="btn-filtrar-contratista"><i class="uil uil-search"></i></button>                    
                </form>
                <div class="conteiner-buscar-por-qr">
                    <button type="button" id="btn-buscar-qr" class="btn-buscar-qr">
                        Buscar por QR
                        <i class="uil uil-qrcode-scan"></i>
                    </button>
                    <form id="form-buscar-por-qr" method="post" class="container-textbox-qr">
                        <input type="text" id="textbox-codigo-qr" autocomplete="off" class="textbox-buscar-qr">
                    </form>
                </div>
                <div class="tbl-header" style="--delay: .6s">
                    <table id="tabla">
                        <thead>
                            <tr>
                                <th class="columna-header">
                                    <span>Controles</span>    
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
                                    <span>Fecha Limite</span>
                                </th> 
                            </tr>   
                        </thead>
                    </table>  
                </div> 
                <div class="tbl-content-contratistas" style="--delay: .6s">
                    <table id="tabla">    
                        <tbody id="container-contratistas-ingresados">                     
                        </tbody>
                    </table>   
                </div>           
            </div>
        </div>
        <div class="overlay" id="overlay">
            <div class="container-popup" id="popup">
                <div class="header-popup">
                    <h2>Elegir una opcion</h2>
                </div>
                <div class="container-btn-popup">
                    <input type="hidden" id="id-ingreso-contratista">
                    <button type="button" class="btn-imprimir-general btn-tarjeta" id="btn-tarjeta">
                        <span>Imprimir tarjeta</span><br>
                        <i class="icono-popup uil uil-postcard"></i>   
                    </button>
                    <?php
                        if($_SESSION['planta_usuario'] == 'Landl')
                        {
                    ?>
                        <button type="button" class="btn-imprimir-general btn-imprimir-estado" id="btn-estado-salud">
                            <span>Imprimir estado de salud</span><br>
                            <i class="icono-popup uil uil-file-medical-alt"></i>
                        </button> 
                    <?php
                        }
                    ?>  
                    <button type="button" class="btn-imprimir-general btn-cancelar" id="btn-cerrar-popup">
                        <span>Cancelar</span><br>
                        <i class="icono-popup uil uil-times-circle"></i>
                    </button>                    
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/plugins/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="assets/plugins/sweetalert2.all.min.js"></script>
<script src="assets/scripts/ingreso-de-contratistas.js"></script>
<script src="assets/scripts/subir-imagenes.js"></script>
<script src="assets/scripts/subir-imagenes-art.js"></script>
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