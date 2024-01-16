<?php
    namespace Model;

    class Usuario extends ActiveRecord{
        //BASE DE DATOS

        protected static $tabla = 'Usuarios'; // tabla con la que se referencia Usuario
        protected static $columnasDB = ['id','nombre','apellido','email','pass','telefono','esAdmin','confirmado','token']; //Columnas de la tabla usuario
        public $id;
        public $nombre;
        public $apellido;
        public $email;
        public $pass;
        public $telefono;
        public $esAdmin;
        public $confirmado;
        public $token;

        public function __construct($args=[]) //ARREGLO ASOCIATIVO, ME REFIERO A EL MEDIANTE NOMBRE DE COLUMNAS Y NO NUMEROS
        {
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->apellido = $args['apellido'] ?? '';
            $this->email = $args['email'] ?? '';
            $this->pass = $args['pass'] ?? '';
            $this->telefono = $args['telefono'] ?? '';
            $this->esAdmin = $args['esAdmin'] ?? 0;
            $this->confirmado = $args['confirmado'] ?? 0;
            $this->token = $args['token'] ?? '';
        }


        //MENSAJES DE VALIDACION PARA LA CREACION DE UNA CUENTA
        public function validarNuevaCuenta(){
            if(!$this->nombre){
                self::$alertas['error'][] = "El nombre del Cliente es Obligatorio";//VAMOS A PODER EXTRAER A PARTIR DEL NOMBRE 'error', el mensaje correspondiente
            }

            if(!$this->apellido){
                self::$alertas['error'][] = "El apellido del Cliente es Obligatorio";//VAMOS A PODER EXTRAER A PARTIR DEL NOMBRE 'error', el mensaje correspondiente
            }
            if(!$this->pass){
                self::$alertas['error'][] = "La contraseña del Cliente es Obligatorio";//VAMOS A PODER EXTRAER A PARTIR DEL NOMBRE 'error', el mensaje correspondiente
            }
            if(strlen($this->pass)<6){
                self::$alertas['error'][] = "La contraseña del Cliente debe contener al menos 6 caracteres";//VAMOS A PODER EXTRAER A PARTIR DEL NOMBRE 'error', el mensaje correspondiente
            }
            if(!$this->email){
                self::$alertas['error'][] = "El email del Cliente es Obligatorio";//VAMOS A PODER EXTRAER A PARTIR DEL NOMBRE 'error', el mensaje correspondiente
            }
            if(!$this->telefono){
                self::$alertas['error'][] = "El telefono del Cliente es Obligatorio";//VAMOS A PODER EXTRAER A PARTIR DEL NOMBRE 'error', el mensaje correspondiente
            }
            return self::$alertas;
        }

        //REVISA SI EL USUARIO YA EXISTE
        public function existeUsuario(){
            $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' limit 1;";
            $resultado = self::$db->query($query); // PROCESO LA QUERY EN LA BASE DE DATOS
            if($resultado->num_rows){ // SI HAY UN RESULTADO CREO OTRA ALERTA
                self::$alertas['error'][] = "El Usuario Ya esta Registrado";
            }

            return $resultado;
        }

        //Hashear Password
        public function hashPassword(){
            $this->pass = password_hash($this->pass, PASSWORD_BCRYPT);
        }

        //CREAR TOKEN
        public function crearToken(){
            $this->token = uniqid(); //solo genera un ID UNICO, NO USAR PARA HASEHAR PASSWORDS
        }

        public function validarLogin(){
            if(!$this->email){
                static::$alertas['error'][] = "Debes ingresar un mail";
            }
            if(!$this->pass){
                static::$alertas['error'][] = "Debes ingresar una contraseña";
            }
        }

        public function validarEmail(){
            if(!$this->email){
                self::$alertas['error'][] = "Debes ingresar un mail";
            }
            return self::$alertas; //retorno el error
        }
        public function comprobarPasswordAndVerificado($password,$hashed_password){
           
            $estaConfirmado = false;
            //Password verify tiene 2 argumentos (valor real, hasheado), devuelve TRUE O FALSE
            if(!$this->confirmado){
                self::$alertas['error'][] = "El usuario no esta confirmado";
                return $estaConfirmado;
            }else{
                $estaConfirmado = true;
                $resultado = password_verify($password, $hashed_password);
                if(!$resultado){
                    self::$alertas['error'][] = "Contraseña incorrecta";
                    $estaConfirmado = false;
                    
                }
            }

            return $estaConfirmado;
           

        }
 


    public function validarPassword(){
         if(!$this->pass){
            self::$alertas['error'][] = "El password es obligatorio";
         }
         if(strlen($this->pass)<6){
            self::$alertas['error'][] = "El password debe tener al menos 6 caracteres";

         }

         return self::$alertas;
    }

}
?>