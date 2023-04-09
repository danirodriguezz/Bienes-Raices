<?php
    declare(strict_types = 1);
    require "includes/funciones.php";
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de Contacto">
        </picture>
        <h2>Llene el formulario de Contacto</h2>
        <form class="formulario">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">
                <label for="emial">E-mail</label>
                <input type="email" placeholder="Tu E-mail" id="email">
                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Tu Teléfono" id="telefono">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje"></textarea>
            </fieldset>
            <fieldset>
                <legend>Información sobre la Propiedad</legend>
                <label for="opciones">Vende o Compra</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Selecione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>
                <label for="presupuesto">Teléfono</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto">
            </fieldset>
            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" name="contacto" value="telefono" id="contactar-telefono">
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" name="contacto" id="contactar-email">
                </div>
                <p>Si eligio telefono eliga la fecha y hora para ser contactado</p>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">
                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="9:00" max="18:00">
            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>


<?php 
    incluirTemplates("footer");
?>