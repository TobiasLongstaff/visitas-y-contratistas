<?php
    require 'partials/header.html'
?>
<body>
    <div class="container">
        <nav>
            <h2>Ingreso de visitas</h2>
            <div class="container-controles-nav">
                <img class="img-nav" src="assets/img/frigopico.png" alt="">
                <a href="cerrarsesion.php">
                    <button type="button" class="btn-nav">
                        <i class="uil uil-sign-out-alt"></i>
                    </button>                 
                </a>                
            </div>
        </nav>
        <form method="post" class="container-form-ingreso-visitas">
            <div class="container-left-ingreso">
                <div class="form-group">
                    <input type="text" id="" class="form-style" placeholder="Nombre y Apellido" autocomplete="off" required>
                    <i class="input-icon uil uil-user"></i>
                </div>	
                <div class="form-group">
                    <input type="text" id="" class="form-style" placeholder="DNI" autocomplete="off" required>
                    <i class="input-icon uil uil-postcard"></i>
                </div>
                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input type="date" id="" class="form-style-date" placeholder="Fecha de Nacimiento" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <select class="form-style" autocomplete="off" required>
                        <option value="" selected disabled>Empresa</option>
                    </select>
                    <i class="input-icon uil uil-building"></i>
                </div>
                <div class="form-group">
                    <input type="text" id="" class="form-style" placeholder="Temperatura" autocomplete="off" required>
                    <i class="input-icon uil uil-temperature-half"></i>
                </div>
                <div class="form-group">
                    <select class="form-style" autocomplete="off" required>
                        <option value="" selected disabled>Sector Habilitado</option>
                    </select>
                    <i class="input-icon uil-chart-pie-alt"></i>
                </div>
                <div class="form-group">
                    <input type="text" id="" class="form-style" placeholder="Visita a ..." autocomplete="off" required>
                    <i class="input-icon uil uil-user-location"></i>
                </div>
                <div class="form-group">
                    <input type="text" id="" class="form-style" placeholder="Vehiculo Modelo" autocomplete="off" required>
                    <i class="input-icon uil-car-sideview"></i>
                </div>
                <div class="form-group">
                    <input type="text" id="" class="form-style" placeholder="Patente" autocomplete="off" required>
                    <i class="input-icon uil uil-car"></i>
                </div>
                <div class="form-group">
                    <select id="" class="form-style" autocomplete="off" required>
                        <option value="" selected disabled>Registra Fichada S/N</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <i class="input-icon uil uil-registered"></i>
                </div>
                <div class="form-group">
                    <label>Fecha y Hora</label>
                    <input type="date" id="" class="form-style-date" placeholder="Fecha y Hora" autocomplete="off" required>
                </div>          
            </div>
            <div class="container-right-visitas">
                <div class="container-img-visita">
                    <img class="img-visita" src="">
                </div>
                <label>Observacion:</label>
                <textarea class="form-style-textarea"></textarea> 
                <div class="container-controles-visitas">
                    <input type="submit" class="btn-acceder" value="Guardar y Imprimir">
                    <button type="button" class="btn-acceder btn-secundario">Cancelar</button>
                </div>     
            </div>
        </form>
    </div>
</body>