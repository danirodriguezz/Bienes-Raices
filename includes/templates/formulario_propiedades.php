<fieldset>
    <legend>Infomación General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titutlo Propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo sanitizar($propiedad->precio); ?>">
    
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
    <?php if($propiedad->imagen):?>
        <img src="/Bienes_raices/imagenes/<?php echo $propiedad->imagen ?>" alt="Imagen de propiedad" class="imagen-small">
    <?php endif ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input 
    type="number" 
    id="habitaciones" 
    name="propiedad[habitaciones]" 
    value="<?php echo sanitizar($propiedad->habitaciones); ?>" 
    placeholder="Número Habitaciones" 
    min="1" 
    max="10">

    <label for="wc">Baños:</label>
    <input 
    type="number" 
    id="wc" 
    name="propiedad[wc]" 
    placeholder="Número Baños" 
    value="<?php echo sanitizar($propiedad->wc); ?>" 
    min="1" 
    max="10">

    <label for="estacionamiento">Estacionamiento:</label>
    <input 
    type="number" 
    id="estacionamiento" 
    name="propiedad[estacionamiento]" 
    value="<?php echo sanitizar($propiedad->estacionamiento); ?>" 
    placeholder="Número Estacionamiento" 
    min="1" 
    max="10">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <select name="propiedad[vendedor_id]">
        <option value="">--Seleccione--</option>
        <?php while($row = mysqli_fetch_assoc($resultado_consulta)): ?>
        <option 
        <?php echo $row["id"] === sanitizar($propiedad->vendedor_id) ? "selected" : "";?> 
        value="<?php echo $row["id"];?>"><?php echo $row["nombre"] . " " . $row["apellido"]; ?></option>
        <?php endwhile; ?>
    </select>
</fieldset>
