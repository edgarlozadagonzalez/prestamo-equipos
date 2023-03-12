<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if(!isset($titulo) || empty($titulo)){
        $titulo = 'Centro Tic';
    }
    echo "<title>$titulo</title>";
    ?>
    <!-- Bootstrap CSS y ESTILOS -->
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS_LIBRERIAS?>bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS_LIBRERIAS?>dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS_LIBRERIAS?>responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS_LIBRERIAS?>buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS_LIBRERIAS ?>all.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS_PROPIAS ?>estilos.css">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS_LIBRERIAS?>alertify.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS_LIBRERIAS?>default.min.css">

</head>
<body>