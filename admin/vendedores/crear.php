<?php
    require '../../includes/app.php';

    use App\Vendedor;

    //Revisar si el usuario está autenticado
    estaAutenticado();

    //Consulta para vendedores
    $vendedor = new Vendedor;

    //Arreglo con mensajes de errores
    $errores= Vendedor::getErrores();

    //Ejecuta código después de que el usuario envía el formulario
    if($_SERVER['REQUEST_METHOD']==='POST'){

        $vendedor = new Vendedor($_POST['vendedor']);

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
    <h1>Añadir nuevo Vendedor o Vendedora</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error):?>
        <div class="alerta error ">
         <?php echo $error; ?>
        </div>    
    <?php endforeach;?>

    <form method="POST" action="/bienesraices/admin/vendedores/crear.php" class="formulario" >
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>
        <input type="submit" value="Crear Vendedor" class="boton boton-verde">
    </form>

</main>
<?php 
    incluirTemplate('footer');
?>