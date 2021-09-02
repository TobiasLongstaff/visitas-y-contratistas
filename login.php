<?php

    session_start();
    require 'partials/conexion.php';

?>
<body>
    <div class="container-alerta">
        <div class="container-card-alerta">
            <i class="uil uil-exclamation-triangle"></i>
            <label id="text-alerta">Error: Lorem, ipsum dolor 404</label>
        </div>        
    </div>
    <div class="section">
        <div>
            <div class="full-height justify-content-center">
                <div class="container-text-opciones">
                    <span>Iniciar Sesión</span>
                    <span>Registrarse</span>
                </div>
                <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                <label for="reg-log"></label>
                <div class="card-3d-wrap mx-auto">
                    <div class="card-3d-wrapper">
                        <div class="card-front">
                            <div class="center-wrap">
                                <form method="POST" id="form-login" class="section container-login">
                                    <h2>Iniciar Sesión</h2>
                                    <div class="form-group">
                                        <input type="email" id="log-mail" class="form-style" placeholder="E-mail" autocomplete="off" required>
                                        <i class="input-icon uil uil-at"></i>
                                    </div>	
                                    <div class="form-group">
                                        <input type="password" id="log-pass" class="form-style" placeholder="Contraseña" autocomplete="off" required>
                                        <i class="input-icon uil uil-padlock"></i>
                                    </div>	
                                    <input type="submit" class="btn-acceder" value="Acceder">
                                </form>
                            </div>
                        </div>
                        <div class="card-back">
                            <div class="center-wrap">
                                <form method="POST" id="form-registrarse" class="section container-login">
                                    <h2 class="titulo-regis">Registrarse</h2>
                                    <div class="form-group">
                                        <input type="text" id="regis-user" class="form-style" placeholder="Nombre y Apellido" autocomplete="off" required>
                                        <i class="input-icon uil uil-user"></i>
                                    </div>	
                                    <div class="form-group">
                                        <input type="email" id="regis-mail" class="form-style" placeholder="E-mail" autocomplete="off" required>
                                        <i class="input-icon uil uil-at"></i>
                                    </div>	
                                    <div class="form-group">
                                        <select id="regis-planta" class="form-style-selectlist" autocomplete="off" required>
                                            <option selected disabled>Planta</option>
                                            <option value="FrigoPico">FrigoPico</option>
                                            <option value="Landl">Landl</option>
                                        </select>
                                        <i class="input-icon uil uil-building"></i>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="regis-pass" class="form-style" placeholder="Contraseña" autocomplete="off" required>
                                        <i class="input-icon uil uil-padlock"></i>
                                    </div>	
                                    <div class="form-group">
                                        <input type="password" id="regis-pass-veri" class="form-style" placeholder="Verificar Contraseña" autocomplete="off" required>
                                        <i class="input-icon uil uil-padlock"></i>
                                    </div>
                                    <input type="submit" class="btn-acceder" value="Crear">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>    
<script src="assets/plugins/jquery-3.5.1.min.js"></script>
<script src="assets/scripts/login-registro.js"></script>
</html>   
