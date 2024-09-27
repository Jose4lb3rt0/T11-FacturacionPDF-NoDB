<?php

    $hostname = "localhost";
    $user="root";
    $pass= "";
    $port = 3306;
    $bd = "t10";

    $conexion = mysqli_connect($hostname, $user, $pass, $bd);
    if(mysqli_connect_errno()){
        echo "No se pudo conectar a la base de datos.";
        exit();
    }else{
        echo "Funciona";
    }

    mysqli_select_db($conexion,$bd) or die("No se encuentra la base de datos");

    mysqli_set_charset($conexion,"utf8");