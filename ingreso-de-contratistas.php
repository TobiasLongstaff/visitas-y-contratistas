<?php
    require 'partials/header.html';
    require 'partials/conexion.php';
    session_start();

    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('Y-m-d H:i');
    $fecha_actual = str_replace(' ','T', $fecha_actual);
?>
<body>
    <div class="container">
        <nav>
            <h2>Ingreso de contratistas</h2>
            <div class="container-controles-nav">
                <img class="img-nav" src="assets/img/frigopico.png" alt="">
                <a href="cerrarsesion.php">
                    <button type="button" class="btn-nav">
                        <i class="uil uil-sign-out-alt"></i>
                    </button>                 
                </a>                
            </div>
        </nav>
        <div class="container-form-ingreso-contratistas">
            <form class="container-left-ingreso" id="form-ingreso-de-contratistas" method="post">
                <input type="hidden" id="imagen-perfil">
                <input type="hidden" id="imagen-art">
                <div class="form-group">
                    <input type="text" id="nombre-apellido" class="form-style" placeholder="Nombre y Apellido" autocomplete="off" required>
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
                    <input type="search" id="buscar-empresa" class="form-style-search" placeholder="Empresa" required>
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
                    <input type="text" id="vehiculo-modelo" class="form-style" placeholder="Vehiculo Modelo" autocomplete="off" required>
                    <i class="input-icon uil-car-sideview"></i>
                </div>
                <div class="form-group">
                    <input type="text" id="patente" class="form-style" placeholder="Patente" autocomplete="off" required>
                    <i class="input-icon uil uil-car"></i>
                </div>
                <label>Vencimiento ART</label>
                <div class="form-group">
                    <input type="date" id="fecha-art" class="form-style" required>
                    <div class="validar-art"></div>
                </div>
                <div class="form-group">
                    <select id="registra-fichada" class="form-style" autocomplete="off" required>
                        <option value="" selected disabled>Registra Fichada S/N</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <i class="input-icon uil uil-registered"></i>
                </div>
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
                    <input type="submit" class="btn-acceder" value="Guardar y Imprimir">
                    <button type="button" id="btn-cancelar" class="btn-acceder btn-secundario">Cancelar</button>
                </div> 
            </form>
            <div class="container-right-contratistas">
                <div class="container-escanear-dni">
                    <button type="button" class="btn-dni" id="btn-dni">
                        <span>Escaner DNI</span><br>
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