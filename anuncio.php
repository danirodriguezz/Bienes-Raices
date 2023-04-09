<?php
    declare(strict_types = 1);
    require "includes/funciones.php";
    incluirTemplates("header");
?>

    <main class="contenedor seccion resumen-propiedad">
        <h1>Casa en Venta Frente al Bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de Anuncio">
        </picture>
        <p class="precio">$3,000,000</p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono de caracteristicas">
                <p>3</p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono de caracteristicas">
                <p>3</p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono de caracteristicas">
                <p>1</p>
            </li>
        </ul>
        <p>
            Bienvenido a esta hermosa casa ubicada en medio del bosque, donde podrás disfrutar de la tranquilidad y la belleza natural que te rodea. <br>
            La casa cuenta con una arquitectura moderna y elegante, con grandes ventanales que permiten una vista panorámica del bosque circundante. 
            Al entrar, serás recibido por un amplio salón con una chimenea de piedra natural que se convierte en el corazón de la casa en las 
            noches de invierno. <br>
            La cocina está totalmente equipada con electrodomésticos modernos y un amplio espacio de trabajo, perfecto para aquellos que disfrutan 
            de cocinar. El comedor se encuentra en una zona abierta junto a la cocina y tiene capacidad para seis personas, ofreciendo un espacio 
            cómodo para disfrutar de las comidas en familia. <br>
            La casa cuenta con tres habitaciones, cada una con su propio baño privado. La habitación principal tiene una cama King size y 
            acceso a una terraza privada con vistas impresionantes del bosque. Las otras dos habitaciones tienen camas Queen size, 
            perfectas para amigos o familiares. <br>
            En el exterior de la casa, podrás disfrutar de una gran terraza con muebles de jardín y una parrilla para hacer barbacoas 
            en las noches de verano. También hay un jardín con una hermosa vista del bosque, donde podrás relajarte y disfrutar de la 
            tranquilidad del entorno natural. <br>
            En resumen, esta casa es el lugar perfecto para aquellos que buscan escapar de la ciudad y disfrutar de la paz 
            y la tranquilidad del bosque. Con su arquitectura moderna y elegante, vistas impresionantes y comodidades de alta calidad, 
            esta casa es el lugar perfecto para pasar unas vacaciones inolvidables.
        </p>
    </main>


<?php 
    incluirTemplates("footer");
?>