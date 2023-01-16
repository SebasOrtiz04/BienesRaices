<?php
    
    //Importar conexión a BD
    require 'includes/app.php';
    $db = conectarDB();

    $errores = [];
    //autenticar el usuario
    if($_SERVER['REQUEST_METHOD']==='POST') {

        //filtrar y almacenar entrada de post
        $email = mysqli_real_escape_string($db,filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),);
        $password = mysqli_real_escape_string($db, $_POST['password']); 

        //Validación del formulario
        if(!$email)$errores[]='El email es obligatorio o no es válido';
        if(!$password)$errores[]='El password es obligatorio o no es válido';
        
        //Si el formulario es válido
        if(empty($errores)){
        
            //REVISAR SI EL USUARIO EXISTE-------------------------------------

            //Consulta a la base de datos
            $query = "SELECT * FROM usuarios WHERE email = '".$email."'";
            $resultado = mysqli_query($db,$query);

            //Valída que el usuario exista
            if($resultado->num_rows){
                //EL USUARIO EXISTE------------------------

                //Extraer la variable de usuario
                $usuario = mysqli_fetch_assoc($resultado);
                
                //Verificar que el password sea correcto
                $auth = password_verify($password,$usuario['password']);

                
                if($auth){
                    //El usuario está autenticado
                    session_start();
                    
                    //Agregar datos a la sesion
                    $_SESSION['usuario'] = $usuario['email']; 
                    $_SESSION['login'] = true; 

                    header('Location: /bienesraices/admin/index.php');

                } else {
                    //el usuario no está autenticado
                    $errores[] = 'El password es incorrecto';
                }
                //FIN DEL USUARIO EXISTE-------------------

            } else{
                //El usuario no existe
                $errores[] = 'El usuario no existe';
            }
            //FIN REVISAR SI EL USUARIO EXISTE-------------------------------------
        }

    }

    //incluye el header
    incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error):?>
        <p class="alerta error"><?php echo $error?></p>
    <?php endforeach;?>
    <form method="POST" action="" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">Email</label>
            <input type="email" placeholder="Tu Email" id="email" name="email">

            <label for="password">Contraseña</label>
            <input type="password" placeholder="Tu Contraseña" id="password" name="password">
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton-verde">
    </form>
</main>
<?php 
    incluirTemplate('footer');
?>