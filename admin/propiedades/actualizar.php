<?php
    require '../../includes/app.php';

    //Revisar si el usuario está autenticado
    estaAutenticado();

    //Validar por ID válido
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);
    if(!$id) header('Location:/bienesraices/admin/index.php');
    
    // Base de datos
    $db = conectarDB();

    //Consulta obtener datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = $id ";
    $resultado = mysqli_query($db,$consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    //Consulta para vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db,$consulta);

    //Arreglo con mensajes de errores
    $errores=[];

    //Preload del formuario
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedores_id = $propiedad['vendedores_id'];
    $imagenPropiedad= $propiedad['imagen'];

    //Ejecuta código después de que el usuario envía el formulario
    if($_SERVER['REQUEST_METHOD']==='POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";


        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedores_id']);
        $creado = date('Y/m/d');

        //Asignar files hacia una variable
        $imagen=$_FILES['imagen'];

        // echo "<pre>";
        // var_dump($imagen);
        // echo "</pre>";
        
        //Validar formulario
        if(!$titulo)$errores[]='Debes añadir un titulo';
        if(!$precio)$errores[]='El precio es obligatiorio';
        if(strlen($descripcion)<50)$errores[]='La descripcion es obligatoria y debe tener almenos  50 caracteres';
        if(!$habitaciones )$errores[]='Indica el número de habitaciones';
        if(!$wc )$errores[]='Indica el número de baños';
        if(!$estacionamiento )$errores[]='Indica el número de espacios de estacionamiento';
        if(!$vendedores_id )$errores[]='Elige un vendedor';

        //Validar tamaño de  la imagen
        $medida = 1000 * 1000;

        if($imagen['size']>$medida) {
            $errores[]= 'La imagen es muy pesada';
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        //Revisar que el arreglo de errores esté vacio
        if(empty($errores)){

            /**SUBIDA DE ARCHIVOS */

            //Crear carpeta
            $carpetaImagenes = '../../imagenes/';
            if(!is_dir($carpetaImagenes)) mkdir($carpetaImagenes);
            
            //Verifica si hay una nueva imagen
            if($imagen['name']){ 
                //Eliminar la imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);

                //Generar un nombre único
                $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";

                //Subir imagen
                move_uploaded_file($imagen['tmp_name'],$carpetaImagenes . $nombreImagen);
            } else $nombreImagen = $propiedad['imagen'];

            //Insertar en la base de datos
            $query = "UPDATE propiedades SET titulo = '".$titulo."',imagen = '".$nombreImagen."', 
                     descripcion = '".$descripcion."', habitaciones = $habitaciones, wc = $wc, 
                     estacionamiento = $estacionamiento, vendedores_id = $vendedores_id WHERE id = $id";

            $resultado = mysqli_query($db,$query);

            if($resultado){
                //Redireccionando al usuario
                header('Location:/bienesraices/admin/index.php?result=2');
            }
            /** TERMINA SUBIDA DE ARCHIVOS */
        }

        
    }

    //Se requieren funciones
    incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Actualizar información de Propiedad</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error):?>
        <div class="alerta error ">
         <?php echo $error; ?>
        </div>
        
    <?php endforeach;?>
    <form method="POST" class="formulario" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio?>">

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

            <img src="/bienesraices/imagenes/<?php echo $imagenPropiedad?>" alt="Imagen de la propiedad" class="imagen-small">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="3" min="1" max="9" value="<?php echo $habitaciones?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="3" min="1" max="9" value="<?php echo $wc?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="3" min="1" max="9" value="<?php echo $estacionamiento?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id" id="">
                <option value="">--Elige vendedor--</option>
                <?php while($row = mysqli_fetch_assoc($resultado)):?>
                    <option <?php echo $vendedores_id === $row['id'] ? 'selected' : '';?> value="<?php echo $row['id'];?>"><?php echo $row['nombre'].' '.$row['apellido'] ?></option>
                <?php endwhile;?>
            </select>
        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>
<?php 
    incluirTemplate('footer');
?>  