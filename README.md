#App Salon

AppSalon es una aplicación web desarrollada con las tecnologías de PHP, MySQL, GulpJS, JavaScript, SASS con la implementacion de la arquitectura MVC para el manejo de RUTAS, Controladores y diferentes modelos que interactúan con la base de datos.
Esta aplicacion permite hacer todo el procedimiento normal de una pagina web con USUARIOS. Altas de usuarios, Inicio de sesion, Olvidar contraseña, manejo de errores, entre otros.
Para el registro de nuevos clientes, se utilizo el paquete PHPmailer y MailTrap para la validacion de cuentas a traves de TOKENS.


Diferencia entre static y self

Diferencia entre static:: y self::
Static se usa cuando queremos apuntar a un metodo específico de una clase invocada, por ejemplo
class MiClase {
    Const static CONSTANTE = 'Hola';

    public static function obtenerConstante() {
        return static::CONSTANTE;
    }
}

class MiSubClase extends MiClase {
    const CONSTANTE = 'Mundo';
}

echo MiSubClase::obtenerConstante();  // Devuelve 'Mundo'


Por que devuelve el “Mundo” y no “Hola”? Porque estamos invocando desde MiSubClase y la constante en esa invocación tiene como valor “Mundo” y el método específicamente declara que lo que se retornara será estático.
De lo contrario, si diría return self:: retorna “Hola”.
https://www.youtube.com/watch?v=ACpJ2n8KMYg&ab_channel=ClubeFull-Stack