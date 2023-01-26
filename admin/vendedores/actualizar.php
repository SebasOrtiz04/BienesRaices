<?php
    require '../../includes/app.php';

    use App\Vendedor;

    //Revisar si el usuario está autenticado
    estaAutenticado();

    //Validar que sea un id válido
    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /bienesraices/admin/index.php');
    }

    //Consulta para vendedores
    $vendedor = Vendedor::find($_GET['id']);

    //Arreglo con mensajes de errores
    $errores= Vendedor::getErrores();

    //Ejecuta código después de que el usuario envía el formulario
    if($_SERVER['REQUEST_METHOD']==='POST'){

        //Se asigna la información del post a un array
        $args = $_POST['vendedor'];

        //Sincroiza el objeto en memoria con la información del usuario
        $vendedor->sincronizar($args);

        //Valida el formulario
        $errores = $vendedor->validar();

        //Revisar que el arreglo de errores esté vacio
        if(empty($errores)){
            $vendedor->guardar();
        }
    }

    //Incluir template del header
incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Actualizar Vendedor o Vendedora</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error):?>
        <div class="alerta error ">
         <?php echo $error; ?>
        </div>    
    <?php endforeach;?>

    <form method="POST" class="formulario" >
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>
        <input type="submit" value="Guardar cambios" class="boton boton-verde">
    </form>

</main>
<?php 
    incluirTemplate('footer');
?>