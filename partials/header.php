<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ICONOS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <?php
        if($_SESSION['planta_usuario'] == 'Landl')
        {
        ?>
            <link rel="stylesheet" href="assets/styles/root_land.css">
        <?php
        }
        else
        {
        ?>
            <link rel="stylesheet" href="assets/styles/root_frigopico.css">
        <?php
        }
    ?>
    <link rel="stylesheet" href="assets/styles/style.css">

    <!-- ANIMACIONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">


    <title>Visitas y contratistas</title>
</head>