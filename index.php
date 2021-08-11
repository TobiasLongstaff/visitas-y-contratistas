<?php

    session_start();

    if(!empty($_SESSION['id_usuario']))
    {
        // require 'partials/header.html';
        // require 'activos-del-dia.php';
    }
    else
    {
        require 'partials/header.html';
        require 'login.php';
    }
?>