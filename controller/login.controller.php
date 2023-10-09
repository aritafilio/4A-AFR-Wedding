<?php

class loginController{
    static public function iniciarSesion(){
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $tabla = 'registros';

            $respuesta = modelLogin::iniciarSesion($email, $tabla);

            if(is_array($respuesta) && $respuesta['correo'] == $email && $respuesta['password'] == $password){
                session_start();

                $_SESSION['sesionIniciada'] = true;

                header('location: index.php?pagina=inicio');
            }else{
                echo'<div class="alert alert-danger">El Email o la contraseña no son correctos</div>';
            }

            return $respuesta;
        }
    }


    static public function cerrarSesion(){
        session_start();
        session_unset();
        session_destroy();
        header("location: http://localhost/MVC_T/"); // Cambia la ubicación según tus necesidades
        exit();
    }


    static public function obtenerRegistros(){
        $tabla = 'registros';

        $respuesta = modelLogin::obtenerRegistros($tabla);

        return $respuesta;
    }


    static public function registrar($crear){
        if(isset($_POST['registrar'])){
            
            if(preg_match('/^[a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nombreR"]) &&
            preg_match('/^[a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["apellidoR"])){

                $datos = array("nombre" => $_POST['nombreR'],
                                "apellido" => $_POST['apellidoR'],
                                "correo" => $_POST['correoR'],
                                "contraseña" => $_POST['contraseñaR']
                                );
                                
                $tabla = 'registros';

                $respuesta = modelLogin::registrar($datos, $tabla);

                if($respuesta == "ok"){
                    if($crear == true){
                        header('location: index.php?pagina=registros');
                    }else{
                        header('location: index.php?pagina=inicio');
                    }
                }

                return $respuesta;
            
            }else{
                echo'<div class="alert alert-danger">Error en los caracteres</div>';
            }
        }
        
    }


    static public function eliminarRegistro($id){

        $tabla = 'registros';

        $respuesta = modelLogin::eliminarRegistro($id, $tabla);

        return $respuesta;
    }


    static public function obtenerRegistro($id){
        $tabla = 'registros';

        $respuesta = modelLogin::obtenerRegistro($id, $tabla);

        return $respuesta;
    }


    static public function actualizarRegistro($id){
        
        if(isset($_POST['actualizar'])){
            
            $tabla = 'registros';
            
            if(preg_match('/^[a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nombreU"]) &&
            preg_match('/^[a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["apellidoU"])){

                $datos = array("nombre" => $_POST['nombreU'],
                                "apellidos" => $_POST['apellidoU'],
                                "correo" => $_POST['correoU']);
                                
                $tabla = 'registros';

                $respuesta = modelLogin::actualizarRegistro($id, $datos, $tabla);

                return $respuesta;
            
            }else{
                echo'<div class="alert alert-danger">Error en los caracteres</div>';
            }
        }
    }


    static public function buscarRegistros($parametro){
        $tabla = 'registros';

        $respuesta = modelLogin::buscarRegistros($parametro, $tabla);

        return $respuesta;
    }
}