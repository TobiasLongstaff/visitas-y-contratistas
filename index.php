<?php

    session_start();

    if(!empty($_SESSION['id_usuario']))
    {
        require 'partials/header.html';
        require 'menu.php';
        if($_SESSION['planta_usuario'] == 'Landl')
        {
        ?>
            <script src="assets/plugins/jquery-3.5.1.min.js"></script>
            <script type="text/javascript">
                $('body').css("background-image", "url(assets/img/fondo-landl.jpg)"); 
                $('.img-nav').attr("src", "assets/img/Landl.png")</script>
            </script>
        <?php
        }
    }
    else
    {
        require 'partials/header.html';
        require 'login.php';
    }
?>
