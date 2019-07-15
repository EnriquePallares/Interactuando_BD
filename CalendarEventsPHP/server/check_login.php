<?php
    require('conector.php');

    $con = new ConectorBD('localhost', 'root', '');
    $response['conexion'] = $con->initConexion('agenda_eventos');

    if ($response['conexion'] == "OK") {
        $resultado_consulta = $con->consultar(['usuarios'], ['id', 'correo', 'password'], 'WHERE correo="' . $_POST['username'] . '"');

        if ($resultado_consulta->num_rows != 0) {
            $fila = $resultado_consulta->fetch_assoc();
            if (password_verify($_POST['password'], $fila['password'])) {
                $response['msg'] = 'OK';
                session_start();
                $_SESSION['fk_user'] = $fila['id'];
            } else {
                $response['motivo'] = 'Contraseña incorrecta';
                $response['msg'] = 'Rechazado';
            }
        } else {
            $response['motivo'] = 'Email incorrecto';
            $response['msg'] = 'Rechazado';
        }
    } else {
        $response['conexion'] = "Error de conexion";
    }

    echo json_encode($response);
    $con->cerrarConexion();
?>