<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="/bienesraices/build/img/destacada.webp" type="image/webp">
            <img width="200" loading="lazy" height="300" src="/bienesraices/build/img/destacada.jpg" alt="">
        </picture>
        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="/bienesraices/build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" src="/bienesraices/build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" src="/bienesraices/build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex explicabo quos iure esse veritatis beatae accusantium dolorum maiores quae at aut praesentium culpa, optio perferendis. Iure eos assumenda delectus in.
            Maiores quo eaque voluptas ad minima cum ullam, facilis molestiae quidem eligendi, pariatur blanditiis eius voluptatibus aliquid odio! Accusamus harum ratione ipsa, vitae consectetur voluptates perspiciatis quae natus quia similique?
            Officia, delectus cupiditate blanditiis voluptatum assumenda possimus amet dignissimos aliquam in temporibus quo natus nesciunt dolorum quaerat voluptas tempora! Asperiores perspiciatis consequuntur, aliquam fugiat odit exercitationem dolorem dicta facilis officia.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, fugit cumque? Voluptate porro incidunt expedita beatae optio itaque, iure ab libero at corrupti aperiam impedit sunt, autem nostrum error obcaecati?
            Pariatur cum amet at sint ad fugit eligendi. Quasi harum enim eius, aut quisquam libero nostrum esse quidem obcaecati sunt nisi assumenda nemo aspernatur quaerat vitae sint suscipit ex consectetur.
            Adipisci sequi error nulla mollitia odit saepe, culpa repellendus. Asperiores nostrum perspiciatis culpa ducimus odio in eaque officiis, eveniet officia est dolorum, perferendis consectetur reiciendis, ut eos voluptate? Eos, consectetur!
            Laudantium minus neque amet est facere vero accusantium deleniti a, libero delectus iure illo, qui sequi dignissimos tempora quam maiores! Consequatur ad unde voluptatum deserunt vitae alias facere rerum corporis.
            Odio labore sint, officia dolor voluptate similique unde numquam, iste voluptatum doloribus deserunt minus magni consequatur saepe earum aliquid illum ducimus consectetur aperiam officiis! Neque cupiditate totam labore atque exercitationem?</p>
        </div>
    </main>
    
<?php 
    incluirTemplate('footer');
?>