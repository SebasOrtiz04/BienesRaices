<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombres:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del Vendedor" value="<?php echo s($vendedor->nombre);?>">

    <label for="apellido">Apellidos:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del Vendedor" value="<?php echo s($vendedor->apellido);?>">
</fieldset>

<fieldset>
    <legend>Información extra</legend>

    <label for="telefono">Telefono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono del Vendedor" value="<?php echo s($vendedor->telefono);?>">
</fieldset>