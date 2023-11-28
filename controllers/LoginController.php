<?php
namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Classes\Email;
class LoginController{

    public static function login(Router $router){

        $alertas = [];
        $auth = new Usuario;
        //SI EL METODO HTTP QUE SE ESTA ENVIADO ES POST:
        if($_SERVER['REQUEST_METHOD'] ==='POST'){
           $auth = new Usuario($_POST); //CREO EL USUARIO CON LO QUE INGRESO EN EL FORM
           $auth->validarLogin(); //VALIDO CUANTAS ALERTAS HAY Y LAS AGREGO
           $alertas = $auth->getAlertas(); //OBTENGO LAS ALERTAS CORRESPONDIENTES A LA INSTANCIA

           if(empty($alertas)){//si no hay errores, significa que ingreso mail y pass

            //verficamos si existe el usuario
            $usuario = Usuario::where('email', $auth->email);
                if($usuario){

                    //CONFIRMO SI la PASSWORD ESTA BIEN Y SI ESTA CONFIRMADO
                    $usuario->comprobarPasswordAndVerificado($auth->pass);
                    $alertas = $usuario->getAlertas();

                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                    $alertas = Usuario::getAlertas();
                }
           }
        }
       


        $router->render('auth/login',[
            "alertas"=>$alertas,
            "auth" =>$auth
        ]);
        
    }

    public static function logout(){
        echo "Desde logout";

    }

    public static function olvide(Router $router){
        $router->render('auth/olvide-password');

    }

    public static function recuperar(){
        echo "Desde recuperar mi contraseña";

    }
    public static function crear(Router $router){
        $usuario = new Usuario; //EVITAMOS ERRORES DE DECLARACION EN LA VISTA DE CREAR-CUENTA
        //Alertas vacias
        $alertas = [];


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST); //SINCRONIZAMOS TODOS LOS DATOS CUANDO HAGAMOIS EL POST
            $alertas = $usuario->validarNuevaCuenta(); //VALIDA ERRORES
            if(empty($alertas)){
                //verificar a traves del email

                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){ // si hay un resultado
                    $alertas = Usuario::getAlertas(); //OBTENGO LA ALERTA PARA PASARLA A LA VISTA
                }else{
                    //HASHEAR PASSWORD
                    $usuario->hashPassword();
                    
                    //GENERAR UN TOKEN UNICO
                    $usuario->crearToken();


                    //Enviar el email
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarConfirmacion();

                    //CREAR EL USUARIO

                    $resultado = $usuario->guardar(); //GUARDO EL USUARIO EN LA BASE DE DATOS
                    if($resultado){
                        header('Location: /mensaje');
                    }            

                    
                }

            }
        }
        $router->render("auth/crear-cuenta",[
            'usuario'=>$usuario, //LE PASAMOS A LA VISTA DE CREARCUENTA EL USUARIO
            'alertas'=>$alertas
        ]);
        
       

    }
    //MENSAJE RUTA DE QUE SE ENVIO MAIL PARA CONFIRMAR CUENTA
    public static function mensaje(Router $router){
        $router->render("auth/mensaje");
    }

    //URL DE CONFIRMAR LA CUENTA
    public static function confirmar(Router $router){
        $alertas = [];
        
        $token = s($_GET['token']); //OBTENGO EL TOKEN DE LA URL
        $usuario = Usuario::where("token",$token);
    
        if(empty($usuario)){ //SI NO HAY UN USUARIO QUE EXISTA CON ESE TOKEN
            //MOSTRAR MENSAJE DE ERROR
            Usuario::setAlerta('error',"El token no es valido");
        }else{
            //MODIFICAR A USUARIO CONFIRMADO
           $usuario->confirmado = "1"; //confirmamos al usuario
           $usuario->token=null; //ELIMINAMOS EL TOKEN PARA EVITAR PROBLEMAS DE SEGURIDAD
           $usuario->guardar(); // SINCRONIZAMOS EL OBJETO CON LA BASE DE DATOS
           Usuario::setAlerta('exito',"Cuenta comprobada correctamente");
         
        }
        //Obtener alertas
        $alertas = Usuario::getAlertas();

        //Renderiza la vista
        $router->render("auth/confirmar-cuenta",[
            "alertas" =>$alertas
        ]);
    }
    
}

?>