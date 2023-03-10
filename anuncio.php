<?php
    require 'includes/app.php';

    use App\Propiedad;

    //Validar por ID válido
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);
    if(!$id) header('Location:/bienesraices/anuncios.php');

    $propiedad = Propiedad::find($id);

    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
    <a href="/bienesraices/anuncios.php" class="boton-verde">Más propiedades</a>
        <h1><?php echo $propiedad->titulo?></h1>

        <img loading="lazy" src="/bienesraices/imagenes/<?php echo $propiedad->imagen?>" alt="Imagen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad->precio?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="/bienesraices/build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                    <p><?php echo $propiedad->wc?></p>
                </li>
                <li>
                    <img class="icono" src="/bienesraices/build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                    <p><?php echo $propiedad->estacionamiento?></p>
                </li>
                <li>
                    <img class="icono" src="/bienesraices/build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                    <p><?php echo $propiedad->habitaciones?></p>
                </li>
            </ul>

            <p><?php echo $propiedad->descripcion?></p>
        </div>
    </main>
    
<?php 
    incluirTemplate('footer');
?>