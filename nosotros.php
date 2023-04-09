<?php
    declare(strict_types = 1);
    require "includes/funciones.php";
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
        <section class="contenido-nosotros">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen Sobre Nosotros">
            </picture>
            <div>
                <h4>25 Años de Experiencia</h4>
                <p>
                    Bienvenidos a nuestra empresa de bienes raíces, una compañía comprometida en ayudar a nuestros 
                    clientes a encontrar la propiedad perfecta que se adapte a sus necesidades. <br>
                    Nuestro equipo está formado por profesionales altamente capacitados en el sector inmobiliario, 
                    con una amplia experiencia en la compra, venta y alquiler de propiedades en todo el país. 
                    Nos enorgullece ofrecer un servicio personalizado y una atención al cliente excepcional 
                    en todo momento. <br>
                    En nuestra empresa, creemos que cada cliente tiene necesidades únicas, por lo que nos esforzamos
                    por entender los requisitos específicos de cada uno y ofrecer soluciones personalizadas 
                    que se ajusten a sus necesidades. Nuestro objetivo es hacer que el proceso de compra, 
                    venta o alquiler de una propiedad sea lo más sencillo y eficiente posible. <br>
                    En definitiva, nuestra empresa de bienes raíces es una solución confiable y efectiva 
                    para aquellos que buscan comprar, vender o alquilar una propiedad. Si necesita 
                    ayuda en el proceso inmobiliario, no dude en ponerse en contacto con nosotros y 
                    estaremos encantados de ayudarle en todo lo que necesite. <br>
                </p>
            </div>
        </section>
        <section class="contenedor seccion">
            <h1>Más Sobre Nosotros</h1>
            <div class="iconos-nosotros">
                <div class="icono">
                    <img src="build/img/icono1.svg" alt="Icono de Seguridad" loading="lazy">
                    <h3>Seguridad</h3>
                    <p>
                        Encuentra propiedades que cumplen con altos estándares de seguridad 
                        en nuestra página web. ¡Compra con confianza sabiendo que tu hogar es 
                        seguro con nosotros!
                    </p>
                </div>
                <div class="icono">
                    <img src="build/img/icono2.svg" alt="Icono de Precio" loading="lazy">
                    <h3>Precio</h3>
                    <p>
                        Ofrecemos propiedades de alta calidad a precios competitivos, junto 
                        con financiamiento y opciones de pago flexibles para hacer que la 
                        compra de tu hogar sea más fácil y accesible. ¡Encuentra la propiedad 
                        de tus sueños a un precio asequible en nuestra página web!
                    </p>
                </div>
                <div class="icono">
                    <img src="build/img/icono3.svg" alt="Icono de Tiempo" loading="lazy">
                    <h3>Tiempo</h3>
                    <p>
                        Nuestra página web ofrece herramientas de búsqueda avanzadas 
                        y visitas virtuales para ayudarte a encontrar la propiedad perfecta 
                        de manera rápida y eficiente.
                    </p>
                </div>
            </div>
        </section>
    </main>


<?php 
    incluirTemplates("footer");
?>