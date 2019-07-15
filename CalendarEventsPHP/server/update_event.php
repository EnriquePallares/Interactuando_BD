<?php
    require('conector.php');
    session_start();

    if (isset($_SESSION['fk_user'])) {
        $con = new ConectorBD('localhost', 'root', '');
        $response['conexion'] = $con->initConexion('agenda_eventos');

        $data['id'] = '"' . $_POST['id'] . '"';
        $data['fecha_inicio'] = '"' . $_POST['start_date'] . '"';
        $data['hora_inicio'] = '"' . $_POST['start_hour'] . '"';
        $data['fecha_finalizacion'] = '"' . $_POST['end_date'] . '"';
        $data['hora_finalizacion'] = '"' . $_POST['end_hour'] . '"';

        if ($response['conexion'] == 'OK') {
            if ($con->actualizarRegistro('eventos', $data, "id = ". $data['id'])) {
                $response['msg'] = "OK";
            } else {
                $response['msg'] = "Ha ocurrido un error al actualizar el evento";
            }
        } else {
            $response['msg'] = "No se pudo conectar a la Base de Datos";
        }
    } else {
        $response['msg'] = "No se ha iniciado una sesión";
    }

    echo json_encode($response);
    $con->cerrarConexion();
?>
