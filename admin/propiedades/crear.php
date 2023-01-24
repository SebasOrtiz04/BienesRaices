<?php
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    //Revisar si el usuario está autenticado
    estaAutenticado();

    //Consulta para vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = $db->query($consulta);

    //Declaro objeto de propiedad
    $propiedad = new Propiedad;

    //Arreglo con mensajes de errores
    $errores= Propiedad::getErrores();

    //Ejecuta código después de que el usuario envía el formulario
    if($_SERVER['REQUEST_METHOD']==='POST'){

        $propiedad = new Propiedad($_POST['propiedad']);

        //Generar un nombre único
        $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";

        //Realizar un resize a la imagen con Intervention
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //Validación
        $errores = $propiedad->validar();

        //Revisar que el arreglo de errores esté vacio
        if(empty($errores)){
            /**SUBIDA DE ARCHIVOS */

            //Crear carpeta
            if(!is_dir(CARPETA_IMAGENES)) mkdir(CARPETA_IMAGENES);
            
            //Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES.$nombreImagen);
            
            //Guarda en la base de datos
            $propiedad->guardar();
        }
        $propiedad->setImagen('');
     }

    //Incluir template del header
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Añadir nueva propiedad para venta</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error):?>
        <div class="alerta error ">
         <?php echo $error; ?>
        </div>    
    <?php endforeach;?>

    <form method="POST" action="/bienesraices/admin/propiedades/crear.php" class="formulario" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>

</main>

<?php 
    incluirTemplate('footer');
?>