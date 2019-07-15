<?php
    require('conector.php');
    session_start();

    if (isset($_SESSION['fk_user'])) {
        $con = new ConectorBD('localhost', 'root', '');
        $response['conexion'] = $con->initConexion('agenda_eventos');

        $data['titulo'] = "'".$_POST['titulo']."'";
        $data['fecha_inicio'] = "'".$_POST['start_date']."'";
        $data['fk_usuario'] = "'".$_SESSION['fk_user']."'";
        
        if ($_POST['allDay'] == "false") {
            $data['hora_inicio'] = "'".$_POST['start_hour']."'";
            $data['fecha_finalizacion'] = "'".$_POST['end_date']."'";
            $data['hora_finalizacion'] = "'".$_POST['end_hour']."'";
            $data['dia_completo'] = '0';   
        } else {
            $data['dia_completo'] = '1';
        }

        if ($response['conexion'] == "OK") {
            if ($con->insertData('eventos', $data)) {
                $response['msg'] = "OK";
            } else {
                $response['msg'] = "Error al insertar evento";
            }
        } else {
            $response['conexion'] = "Error de conexion";
        }
    } else {
        $response['msg'] = "No se ha iniciado una sesión";
    }

    echo json_encode($response);
    $con->cerrarConexion();
?>
