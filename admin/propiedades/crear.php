<?php
    require '../../includes/funciones.php';
    incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Crear</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <form action="" class="formulario">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" placeholder="Titulo propiedad">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" placeholder="Precio propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea name="" id="descripcion"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" placeholder="3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" placeholder="3" min="1" max="9">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" placeholder="3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="" id="">
                <option value="1">Juan</option>
                <option value="2">Karen</option>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>
<?php 
    incluirTemplate('footer');
?>