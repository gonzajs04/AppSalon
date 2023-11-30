<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $nombre;
    public $email;
    public $token;
    public function __construct($email,$nombre,$token){
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }


    public function enviarConfirmacion(){
        //crear el objeto de email
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '94f2e9a2c92946';
        $phpmailer->Password = '0a7131951c6720';
        $phpmailer->setFrom('appsalon04@gmail.com'); // quien envia el email
        $phpmailer->addAddress('appsalon04@gmail.com'); //setea email del receptor
        $phpmailer->Subject = "Confirma tu cuenta"; //ASUNTO DEL MAIL


        //Set HTML
        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';


        $contenido = "<html>";
        $contenido.="<p><strong>Hola" .$this->nombre . "</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido.= "<p>Presiona aca: <a href='http://localhost:3000/confirmar-cuenta?token=" .$this->token . "'>Confirmar Cuenta</a></p>";
        $contenido.="<p>Si tu no solicitaste esta cuenta, ignora el mensaje</p>";
        $contenido.="</html>";

        $phpmailer->Body = $contenido; // agrego el contenido en el cuerpo del mail

        //Enviar el email
        if($phpmailer->send()){
            echo "Enviado correctamente";
        }
    
     
    }

    public function enviarInstrucciones(){
          //crear el objeto de email
          $phpmailer = new PHPMailer();
          $phpmailer->isSMTP();
          $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
          $phpmailer->SMTPAuth = true;
          $phpmailer->Port = 2525;
          $phpmailer->Username = '94f2e9a2c92946';
          $phpmailer->Password = '0a7131951c6720';
          $phpmailer->setFrom('appsalon04@gmail.com'); // quien envia el email
          $phpmailer->addAddress('appsalon04@gmail.com'); //setea email del receptor
          $phpmailer->Subject = "Restablece tu password"; //ASUNTO DEL MAIL
  
  
          //Set HTML
          $phpmailer->isHTML(TRUE);
          $phpmailer->CharSet = 'UTF-8';
  
  
          $contenido = "<html>";
          $contenido.="<p><strong>Hola" .$this->nombre . "</strong> Has solicitado restablecer tu contraseña, presiona el siguiente enlace</p>";
          $contenido.= "<p>Presiona aca: <a href='http://localhost:3000/recuperar?token=" .$this->token . "'>Recuperar</a></p>";
          $contenido.="<p>Si tu solicitaste esto, ignora el mensaje</p>";
          $contenido.="</html>";
  
          $phpmailer->Body = $contenido; // agrego el contenido en el cuerpo del mail

          
        //Enviar el email
        if($phpmailer->send()){
            echo "Enviado correctamente";
        }
    }
}

?>