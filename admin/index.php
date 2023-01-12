<?php

    //Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();
    //Escribir el Query
    $query = 'SELECT * FROM propiedades';

    //Consultar la BD
    $resultado = mysqli_query($db, $query);

    //Muestra mensaje condicional
    $result = $_GET['result'] ?? null;

    //Incluye un template
    require '../includes/funciones.php';
    incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <!-- Inyecta mensaje condicional -->
    <?php if(intval($result)===1):?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif(intval($result)===2): ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php endif;?>
    <!-- Fin de inyección de mensaje -->

    <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados -->
            <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $propiedad['id']?></td>
                <td><?php echo $propiedad['titulo']?></td>
                <td>
                    <img src="/bienesraices/imagenes/<?php echo $propiedad['imagen']?>" alt="Imagen de la propiedad" class="imagen-tabla"> 
                </td>
                <td>$<?php echo $propiedad['precio']?></td>
                <td>
                    <a href="" class="boton-rojo-block">Eliminar</a>
                    <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>
</main>

<?php 

    //Cerrar la conexión
    mysqli_close($db);

    incluirTemplate('footer');
?>