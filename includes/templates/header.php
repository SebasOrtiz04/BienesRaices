<?php

//Validar si el usuario está autenticado
if(!isset($_SESSION))session_start();
$auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''  ?>">
        <div class="contenedor contenido-header">
          <div class="barra">
            <a href="/bienesraices/index.php">
            <img src="/bienesraices/build/img/logo.svg" alt="Logotipo de Bienes Raices" class="logo">
            </a>

            <div class="mobile-menu">
                <img src="/bienesraices/build/img/barras.svg" alt="Menú responsive">
            </div>
            <div class="derecha">
                <nav class="navegacion">
                    <a href="/bienesraices/nosotros.php">Nosotros</a>
                    <a href="/bienesraices/anuncios.php">Anuncios</a>
                    <a href="/bienesraices/blog.php">Blog</a>
                    <a href="/bienesraices/contacto.php">Contacto</a>
                    <?php if($auth): ?> 
                        <a href="/bienesraices/cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?> 
                </nav>

                <dic class="contenedor-imagen">
                    <img src="/bienesraices/build/img/dark-mode.svg" alt="Icono dark-mode" class="dark-mode-boton">
                </dic>
                
            </div>

          </div>
          <?php if($inicio){?>
            <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
          <?php } ?>
        </div>
    </header>