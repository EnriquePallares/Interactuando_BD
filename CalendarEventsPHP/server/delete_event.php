<?php
    require('conector.php');
    session_start();

    if (isset($_SESSION['fk_user'])) {
        $con = new ConectorBD('localhost', 'root', '');
        $response['conexion'] = $con->initConexion('agenda_eventos');

        $data['id'] = '"' . $_POST['id'] . '"';

        if ($response['conexion'] == 'OK') {
            if ($con->eliminarRegistro('eventos', "id = ". $data['id'])) {
                $response['msg'] = "OK";
            } else {
                $response['msg'] = "Ha ocurrido un error al eliminar el evento";
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
