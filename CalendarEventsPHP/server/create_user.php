<?php
    require('conector.php');

    $con = new ConectorBD('localhost', 'root', '');

    if ($con->initConexion('agenda_eventos') == "OK") {
        $conexion = $con->getConexion();

        $insert = $conexion->prepare('INSERT INTO usuarios (correo, nombre, password, fecha_nacimiento) VALUES (?, ?, ?, ?)');
        $insert->bind_param("ssss", $correo, $nombre, $password, $fecha_nacimiento);

        $correo = "enrique@mail.com";
        $nombre = "Enrique Pallares";
        $password = password_hash("1234", PASSWORD_DEFAULT);
        $fecha_nacimiento = "1997-05-20";
        $insert->execute();

        $correo = "juancho@mail.com";
        $nombre = "Juancho Polo";
        $password = password_hash('1234', PASSWORD_DEFAULT);
        $fecha_nacimiento = "1980-03-12";
        $insert->execute();

        $correo = "juana@mail.com";
        $nombre = "Juana Palo";
        $password = password_hash('1234', PASSWORD_DEFAULT);
        $fecha_nacimiento = "1995-01-31";
        $insert->execute();

        echo "Exito en la inserción de usuarios";
        $con->cerrarConexion();
    } else {
        echo "Error de conexion";
    }
?>