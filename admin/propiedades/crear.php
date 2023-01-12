<?php

    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consulta para vendedores

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db,$consulta);

    //Arreglo con mensajes de errores
    $errores=[];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedores_id = '';

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

        echo "<pre>";
        var_dump($imagen);
        echo "</pre>";
        
        //Validar formulario
        if(!$titulo)$errores[]='Debes añadir un titulo';
        if(!$precio)$errores[]='El precio es obligatiorio';
        if(strlen($descripcion)<50)$errores[]='La descripcion es obligatoria y debe tener almenos  50 caracteres';
        if(!$habitaciones )$errores[]='Indica el número de habitaciones';
        if(!$wc )$errores[]='Indica el número de baños';
        if(!$estacionamiento )$errores[]='Indica el número de espacios de estacionamiento';
        if(!$vendedores_id )$errores[]='Elige un vendedor';

        //Validar imagen

        if(!$imagen['name'] || $imagen['error'])$errores[]='La imagen es obligatoria';
        
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

        //Generar un nombre único
        $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";

        //Subir imagen
        move_uploaded_file($imagen['tmp_name'],$carpetaImagenes . $nombreImagen);

        //Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id)
        VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedores_id') ";
        
        $resultado = mysqli_query($db,$query);

        if($resultado){
            //Redireccionando al usuario
            
            header('Location:/bienesraices/admin/index.php');
        }
        }

        
    }



    require '../../includes/funciones.php';
    incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Crear</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error):?>
        <div class="alerta error ">
         <?php echo $error; ?>
        </div>
        
    <?php endforeach;?>
    <form method="POST" action="/bienesraices/admin/propiedades/crear.php" class="formulario" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio?>">

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

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

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>
<?php 
    incluirTemplate('footer');
?>