<?php

require '../includes/app.php';
use App\Propiedad;

    //Revisar si el usuario está autenticado
    estaAutenticado();

    //Implementar un método para obtener todas las propiedades
    $propiedades =  Propiedad::all();
    
    //Muestra mensaje condicional
    $result = $_GET['result'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);

        if($id){

            $propiedad = Propiedad::find($id);

            $propiedad->eliminar();
            //Peticion del nombre de la imagen
            $query = "SELECT imagen FROM propiedades WHERE id = $id";
            $resultado = mysqli_query($db,$query);
            $propiedad = mysqli_fetch_assoc($resultado);

            //Se elimina la imagen
            unlink('../imagenes/'.$propiedad['imagen']);

            //Elimina la propiedad
            $query = "DELETE FROM propiedades WHERE id =$id";
            $resultado = mysqli_query($db,$query);
            if($resultado)header('Location:/bienesraices/admin/index.php?result=3');
        }
    }

    //Incluye un template
    incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <!-- Inyecta mensaje condicional -->
    <?php if(intval($result)===1):?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    
    <?php elseif(intval($result)===2): ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    
    <?php elseif(intval($result)===3): ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
    
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
            <?php foreach($propiedades as $propiedad): ?>
            <tr>
                <td><?php echo $propiedad->id?></td>
                <td><?php echo $propiedad->titulo?></td>
                <td>
                    <img src="/bienesraices/imagenes/<?php echo $propiedad->imagen?>" alt="Imagen de la propiedad" class="imagen-tabla"> 
                </td>
                <td>$<?php echo $propiedad->precio?></td>
                <td>
                    <form method="POST" action="" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    
                    <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</main>

<?php 

    //Cerrar la conexión
    mysqli_close($db);

    incluirTemplate('footer');
?>