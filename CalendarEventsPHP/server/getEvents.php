<?php
    require('conector.php');
    session_start();

    if (isset($_SESSION['fk_user'])) {
        $con = new ConectorBD('localhost', 'root', '');
        $response['conexion'] = $con->initConexion('agenda_eventos');

        if ($response['conexion'] == 'OK') {
            $resultado_consulta = $con->consultar(['eventos'], ['*'], "WHERE fk_usuario ='" . $_SESSION['fk_user'] . "'");

            $i = 0;
            while ($fila = $resultado_consulta->fetch_assoc()) {
                $response['eventos'][$i]['id'] = $fila['id'];
                $response['eventos'][$i]['title'] = $fila['titulo'];
                $response['eventos'][$i]['fk_usuario'] = $fila['fk_usuario'];

                if ($fila['dia_completo'] == 0) {
                    $dia_completo = false;
                    $response['eventos'][$i]['start'] = $fila['fecha_inicio'].' '.$fila['hora_inicio'];
                    $response['eventos'][$i]['end'] = $fila['fecha_finalizacion'].' '.$fila['hora_finalizacion'];
                } else {
                    $dia_completo = true;
                    $response['eventos'][$i]['start'] = $fila['fecha_inicio'];
                    $response['eventos'][$i]['end'] = ""; 
                }
                
                $response['eventos'][$i]['allDay'] = $dia_completo;
                $i++;
            }
            $response['msg'] = "OK";
        } else {
            $response['msg'] = "No se pudo conectar a la Base de Datos";
        }
    } else {
        $response['msg'] = "No se ha iniciado una sesión";
    }

    echo json_encode($response);
    $con->cerrarConexion();
?>