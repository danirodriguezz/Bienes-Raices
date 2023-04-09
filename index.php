<?php
    declare(strict_types = 1);
    require "includes/funciones.php";
    incluirTemplates("header", $inicio = true);
?>

    <main class="contenedor seccion">
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
    </main>
    <section class="seccion contenedor">
        <h2>Casas Y Departamentos en Venta </h2>
        <div class="contenedor-anuncios">
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio1.webp" type="image/webp">
                    <source srcset="build/img/anuncio1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio1.jpg" alt="Anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa de Lujo en el Lago</h3>
                    <p>Casa en el Lago con acabados de lujo y a un exelente precio</p>
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
                    <a href="anuncio.php" class="boton boton-amarillo">
                        Ver propiedad
                    </a>
                </div><!-- contenido-anuncio -->
            </div><!--anuncio-->
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio2.webp" type="image/webp">
                    <source srcset="build/img/anuncio2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio2.jpg" alt="Anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa terminados de Lujo</h3>
                    <p>Casa en el Lago con acabados de lujo y a un exelente precio</p>
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
                    <a href="anuncio.php" class="boton boton-amarillo">
                        Ver propiedad
                    </a>
                </div><!-- contenido-anuncio -->
            </div><!--anuncio-->
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio3.webp" type="image/webp">
                    <source srcset="build/img/anuncio3.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio3.jpg" alt="Anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa con alberca de Lujo</h3>
                    <p>Casa en el Lago con acabdos de lujo y a un exelente precio</p>
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
                    <a href="anuncio.php" class="boton boton-amarillo">
                        Ver propiedad
                    </a>
                </div><!-- contenido-anuncio -->
            </div><!--anuncio-->
        </div><!--contenedor-anuncios-->
        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>
    <section class="imagen-contacto">
        <h2>Encuntra la casa de tus sueños</h2>
        <p>Llena el formulario un asesor se pondrá en contacto contigo</p>
        <a href="contacto.php" class="boton-amarillo-inline-block">Contáctanos</a>
    </section>
    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <!-- Entrada blog -->
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>Consejo para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>
            <!-- Fin entrada blog -->
            <!-- Entrada blog -->
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>Maxímiza el espacio de tu hogar y aprende a usar los colores que mas favorezen para tu hogar</p>
                    </a>
                </div>
            </article>
            <!-- Fin entrada blog -->
        </section>
        <section class="testimoniales">
            <h3>Testimonios</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una exelente forma, muy buena atención y la casa que me ofrecieron cumple todas mis expectativas
                </blockquote>
                <p>- Daniel Rodriguez Alonso</p>
            </div>
        </section>
    </div>

<?php 
    incluirTemplates("footer");
?>