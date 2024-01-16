let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;


document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // Cambia la sección cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente(); 
    paginaAnterior();


    consumirApi(); //Consulta la API en el backend de PHP
}

async function consumirApi(){ //funcion asincrona debido a que necesitamos que se ejecuten otras funciones mientras se consulta la API

    try {
        const response = await fetch("http://localhost:3000/api/servicios"); //Hasta que no se complete el fetch, no se ejecutara la siguiente linea. Esto me devuelve un JSON
        
        return await response.json(); // JSON a OBJETO O ARRAY
    } catch (error) {
        console.error(error);
    }
    //El try catch permite que la aplicacion siga funcionando aunque haya un ERROR. Consume mucha memoria, es lento. Se debe usar en partes criticas.
   
}

function mostrarSeccion() {

    // Ocultar la sección que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    // Seleccionar la sección con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs() {

    // Agrega y cambia la variable de paso según el tab seleccionado
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach( boton => {
        boton.addEventListener('click', function(e) {
            e.preventDefault();

            paso = parseInt( e.target.dataset.paso );
            mostrarSeccion();

            botonesPaginador(); 
        });
    });
}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');

    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function() {

        if(paso <= pasoInicial) return;
        paso--;
        
        botonesPaginador();
    })
}
function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function() {

        if(paso >= pasoFinal) return;
        paso++;
        
        botonesPaginador();
    })
}

