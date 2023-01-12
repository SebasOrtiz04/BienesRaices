<?php

    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Arreglo con mensajes de errores
    $errores=[];

    //Ejecuta código después de que el usuario envía el formulario
    if($_SERVER['REQUEST_METHOD']==='POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedores_id = $_POST['vendedor'];

        if(!$titulo)$errores[]='Debes añadir un titulo';
        if(!$precio)$errores[]='El precio es obligatiorio';
        if(strlen($descripcion)<50)$errores[]='La descripcion es obligatoria y debe tener almenos  50 caracteres';
        if(!$habitaciones )$errores[]='Indique el número de habitaciones';
        if(!$wc )$errores[]='Indique el número de baños';
        if(!$estacionamiento )$errores[]='Indique el número de espacios de estacionamiento';
        if(!$vendedores_id )$errores[]='Elige un vendedor';
        
        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        //Revisar que el arreglo de errores esté vacio

        if(empty($errores)){
        //Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id)
        VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedores_id') ";

        $resultado = mysqli_query($db,$query);

        if($resultado){
            echo 'Insertado Correctamente';
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
    <form method="POST" action="/bienesraices/admin/propiedades/crear.php" class="formulario">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="3" min="1" max="9">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor" id="">
                <option value="" disabled selected>--Elige vendedor--</option>
                <option value="1">Juan</option>
                <option value="2">Mari Tere</option>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>
<?php 
    incluirTemplate('footer');
?>