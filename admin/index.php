<?php
    $result = $_GET['result'] ?? null;
    require '../includes/funciones.php';
    incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if(intval($result)===1):?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif;?>
    <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
</main>
<?php 
    incluirTemplate('footer');
?>