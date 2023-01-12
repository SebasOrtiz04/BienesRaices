<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado nostros">
        <h1>Conoce Sobre Nosotros</h1>

        <div class="contenido-nostros">
            <div class="imagen">
                <picture>
                    <source srcset="/bienesraices/build/img/nosotros.webp" type="image/webp">
                    <img width="200" loading="lazy" height="300" src="/bienesraices/build/img/nosotros.jpg" alt="">
                </picture>
            </div>
            <div class="contenido-nosotros">
                <h4>25 Años de Experiencia</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae sapiente tempore perferendis reprehenderit nisi non omnis incidunt illum cumque at minima aut accusamus quaerat, eos alias qui culpa, veritatis provident!
                Excepturi labore laborum illo fugiat, molestias reiciendis optio eum error deserunt, laudantium fuga ipsum quos ut. Expedita iusto, id fugit eligendi numquam a, repellat tenetur quidem aspernatur iure, explicabo cumque.
                Aspernatur laboriosam tempora mollitia non. Tempore ducimus porro necessitatibus quod voluptatum dignissimos dicta velit est, dolore pariatur, repellat voluptate rerum autem quis officiis possimus mollitia architecto quo? Distinctio, dolor eveniet?</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">

        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="/bienesraices/build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias recusandae sed quidem molestiae ad! Distinctio libero unde quia.</p>
            </div>
            <div class="icono">
                                <img src="/bienesraices/build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias recusandae sed quidem molestiae ad! Distinctio libero unde quia.</p>
            </div>
            <div class="icono">
                                <img src="/bienesraices/build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias recusandae sed quidem molestiae ad! Distinctio libero unde quia.</p>
            </div>
        </div>
    </section>
    
<?php 
    incluirTemplate('footer');
?>