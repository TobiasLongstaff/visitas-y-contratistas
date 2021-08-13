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
        <form method="post">
            <div class="form-group">
                <input type="text" id="" class="form-style" placeholder="Nombre y Apellido" autocomplete="off" required>
                <i class="input-icon uil uil-user"></i>
            </div>	
            <div class="form-group">
                <input type="text" id="" class="form-style" placeholder="DNI" autocomplete="off" required>
                <i class="input-icon uil uil-postcard"></i>
            </div>
            <div class="form-group">
                <input type="date" id="" class="form-style" placeholder="Fecha de Nacimiento" autocomplete="off" required>
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
                <i class="input-icon uil uil-user"></i>
            </div>
            <div class="form-group">
                <input type="text" id="" class="form-style" placeholder="Vehiculo Modelo" autocomplete="off" required>
                <i class="input-icon uil uil-user"></i>
            </div>
            <div class="form-group">
                <input type="text" id="" class="form-style" placeholder="Patente" autocomplete="off" required>
                <i class="input-icon uil uil-user"></i>
            </div>
            <div class="form-group">
                <input type="text" id="" class="form-style" placeholder="Registra Fichada S/N" autocomplete="off" required>
                <i class="input-icon uil uil-user"></i>
            </div>
            <div class="form-group">
                <input type="date" id="" class="form-style" placeholder="Fecha y Hora" autocomplete="off" required>
            </div>
        </form>
    </div>
</body>