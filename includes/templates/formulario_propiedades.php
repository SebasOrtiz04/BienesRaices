<fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo s($propiedad->titulo);?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo s($propiedad->precio);?>">

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo s($propiedad->descripcion);?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="3" min="1" max="9" value="<?php echo s($propiedad->habitaciones);?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="3" min="1" max="9" value="<?php echo s($propiedad->wc);?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento);?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id" id="">
                <option value="">--Elige vendedor--</option>
                <?php while($row = mysqli_fetch_assoc($resultado)):?>
                    <option <?php echo s($propiedad->vendedores_id) === $row['id'] ? 'selected' : '';?> value="<?php echo s($row['id']);?>"><?php echo s($row['nombre']).' '.s($row['apellido']); ?></option>
                <?php endwhile;?>
            </select>
        </fieldset>