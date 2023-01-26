<?php
    require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    //Revisar si el usuario está autenticado
    estaAutenticado();

    //Validar por ID válido
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);
    if(!$id) header('Location:/bienesraices/admin/index.php');

    //Consulta obtener datos de la propiedad
    $propiedad=Propiedad::find($id);

    //Consulta para obtener los vendedores
    $vendedores=Vendedor::all();

    //Arreglo con mensajes de errores
    $errores= Propiedad::getErrores();

    //Ejecuta código después de que el usuario envía el formulario
    if($_SERVER['REQUEST_METHOD']==='POST'){

        //Asignar atibutos
        $args = $_POST['propiedad'];

        //Se guardan los cambios en el objeto en memoria
        $propiedad->sincronizar($args);

        //Vaalidación
        $errores = $propiedad->validar();

        //Generar un nombre único
        $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";

        //Realizar un resize a la imagen con Intervention
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //Revisar que el arreglo de errores esté vacio
        if(empty($errores)){
            /**SUBIDA DE ARCHIVOS */

            //Crear carpeta
            if(!is_dir(CARPETA_IMAGENES)) mkdir(CARPETA_IMAGENES);
            
            if($_FILES['propiedad']['tmp_name']['imagen']){
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES.$nombreImagen);
            }
            //Guarda en la base de datos
            $propiedad->guardar();
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
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>
<?php 
    incluirTemplate('footer');
?>  