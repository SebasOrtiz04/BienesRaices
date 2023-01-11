document.addEventListener('DOMContentLoaded',()=>{
    eventListeners();
    darkMode();
})

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click',navegacionResponsiva);
}

function navegacionResponsiva(){
    const contenedorNavegacion = document.querySelector('.derecha');
    const navegacion = document.querySelector('.navegacion');
    const body = document.querySelector('body');
    const boton = document.createElement('A');
    boton.textContent= 'X';
    boton.classList.add('btn-cerrar');

    navegacion.appendChild(boton);
    contenedorNavegacion.classList.add('mostrar');
    body.classList.add('no-scroll');

    boton.addEventListener('click', cerrarNavegacion)
}

function cerrarNavegacion(){
    navegacion = document.querySelector('.derecha');
    const body = document.querySelector('body');
    boton = document.querySelector('.btn-cerrar');
    
    navegacion.classList.remove('mostrar');
    body.classList.remove('no-scroll');
    boton.remove();   
}

function darkMode(){

    const prefiereDarkMode = window.matchMedia('(prefers-color-schema:dark)');

    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    }   else{
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change',()=>{
        const body = document.querySelector('body');
        body.classList.toggle('dark-mode');
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click',()=>{
        const body = document.querySelector('body');
        body.classList.toggle('dark-mode');
    })
}