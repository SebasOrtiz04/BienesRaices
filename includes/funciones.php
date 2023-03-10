<?php
declare(strict_types=1);

define('TEMPLATES_URL', __DIR__."/templates/");
define('FUNCIONES_URL', __DIR__."funciones.php");
define('CARPETA_IMAGENES',__DIR__.'/../imagenes/');

function incluirTemplate(string $nombre,bool $inicio = false)
{
    include TEMPLATES_URL . $nombre . ".php";
}

function estaAutenticado():void{
    session_start();

    $auth = $_SESSION['login'];

    if(!$auth) header('Location: /bienesraices/login.php');
}

function debugear($foo):void{
    echo '<pre>';
    var_dump($foo);
    echo '</pre>';
    exit;
}

//Escapa el HTML
function s(string $html): string{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor','propiedad'];
    return in_array($tipo,$tipos);
}

//Muestra los mensajes

function mostrarNotificacion($codigo){
    $mensaje = '';
    switch($codigo){
        case 1:
            $mensaje='Creado correctamente';
        break;  
        case 2:
            $mensaje='Actualizado correctamente';
        break;  
        case 1:
            $mensaje='Eliminado correctamente';
        break;  
        default:
            $mensaje=false;
        break;
    }

    return $mensaje;
}