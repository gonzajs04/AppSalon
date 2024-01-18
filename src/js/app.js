let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios:[]

}

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

    nombreCliente(); //Almaceno en el objeto de cita el nombre del cliente

    seleccionarFecha(); //Añade la fecha en el objeto de cita
    seleccionarHora(); //Añade la hora de la cita en el objeto

    mostrarResumen(); //Muestra el resumen
}

async function consumirApi(){ //funcion asincrona debido a que necesitamos que se ejecuten otras funciones mientras se consulta la API
    try {
        const response = await fetch("http://localhost:3000/api/servicios"); //Hasta que no se complete el fetch, no se ejecutara la siguiente linea. Esto me devuelve un JSON
        
        const servicios =  await response.json(); // JSON a OBJETO O ARRAY
        mostrarServicios(servicios);

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

            if(paso === 3){
                mostrarResumen();
            }
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

function mostrarServicios(servicios){
    servicios.forEach(servicio =>{
        const {id,nombre,precio} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent =  `$${precio}`;
        
        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id; //le añado una id en especifico correspondiente al servicio a cada contenedor
        //En el html se vera asi: data-id-servicio, quita el camelCase y pone guiones y minusculas
       // servicioDiv.setAttribute('aria-label', `Servicio ${nombreServicio} con precio de ${precioServicio}`);


        servicioDiv.appendChild(nombreServicio)
        servicioDiv.appendChild(precioServicio)

        document.querySelector('#servicios').appendChild(servicioDiv);

        //Llenar el array de cita con el servicio clickeado.
        //servicioDiv.onclick = seleccionarServicio; //No le pongo parentesis ya que si colocamos parentesis se llamara en todo momento esta funcion una vez clickee el usuario. Ahora, es necesario pasarle el servicio, como hacemos? Por medio de una funcion callback
        servicioDiv.onclick = ()=>{
            seleccionarServicio(servicio);
            //servicioDiv.classList.toggle("seleccionado");
        }
        
    } );
}

function seleccionarServicio(servicio){
    const {id} = servicio;
    const {servicios} = cita; //extraigo el array de servicios de el objeto de Cita
   
    //Comprobar si un servicio fue agregado o se quita
    if(servicios.some(agregado => agregado.id === id)){ // Some Devuelve T o F
        //Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id); //Filtramos cual es diferente al que queremos eliminar para que quede en el carrito.

    }else{
        //Agregarlo
        cita.servicios = [...servicios,servicio]; // Creo una copia al array de servicios y le agrego el servicio seleccionado. El array devuelto es almacenado en el array de servicios del objeto cita.
    }

    //Resaltar servicio seleccionado
    const divServicio = document.querySelector(`[data-id-servicio="${id}"`);
    divServicio.classList.toggle("seleccionado");
}

function nombreCliente(){
    cita.nombre = document.querySelector("#nombre").value;
}

function seleccionarFecha(){

    const fecha = document.querySelector('#fecha');
    fecha.addEventListener('input',(e)=>{ //Se llama cuando cambia el valor del input en todo momento
        //Evitar que el usuario seleccione una fecha que no se trabaja: Sabado o DOMINGO o ambos

        const dia =  new Date(e.target.value).getUTCDay(); //Obtengo el numero del dia seleccionado
        if(comprobarFechaAnteriorActual(e.target) || [6,0].includes(dia)){ // Evaluo si es Sabado o Domingo
            fecha.value = '';
            fecha.style.background = "white";
            mostrarAlerta('Fines de semana, dias anteriores u hoy no permitidos',"error",".formulario");
        }else{
            cita.fecha = e.target.value;
            fecha.style.background = "lightgreen";

        }
    })
}
function comprobarFechaAnteriorActual(contenedorFecha){
    let esAnterior = false;
    if(new Date(contenedorFecha.value) <= new Date()){
        esAnterior = true;
    }
    return esAnterior;
}

function seleccionarHora(){
    //Selecciono el input de la hora
    const inputHora = document.querySelector("#hora");
    //Evento de cambio de hora
    inputHora.addEventListener('input',(e)=>{
          const horaCita = e.target.value;
          const hora = horaCita.split(":")[0]; //Extraigo solo la hora para validar que el usuario esta sacando turno en horario que esta abierto
          if(hora <= 10 || hora>21){ //Controlo que el turno sea sacado entre las 10am y 22pm

            //Si la hora esta mal, blanqueo el input para que no tenga valor
            inputHora.value = ""
            //Mostrar alerta de error
            mostrarAlerta("El horario debe estar entre las 10am y antes de las 22pm","error",".formulario");
            inputHora.style.background = "white";

          }else{
            //Le almaceno al input la hora de la cita
            inputHora.value = e.target.value;
            cita.hora = horaCita; //Guardo en el objeto de la cita, el valor del input
            inputHora.style.background = "lightgreen"; //Input verde para indicar que esta correcto el horario de la cita
          }
    }) 
 

}

function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');
    //Limpiamos el texto que dice RESUMEN y aca se veran los datos del resumen.
    while(resumen.firstChild){ // Mientras se llame a resumen desaparecera el primer texto y las alertas anteriores
        resumen.removeChild(resumen.firstChild)
    }

    if(Object.values(cita).includes("") || cita.servicios.length===0){ //Si el objeto de cita tiene un valor vacio o no hay ningun servicio seleccionado, que muestre una alerta
        mostrarAlerta("Faltan rellenar datos o servicios","error",".contenido-resumen",false);
        return;
    }
        mostrarAlerta("Todos los datos estan bien","exito",".contenido-resumen",false);

        // Formatear el div de resumen
        const {nombre,fecha,hora,servicios} = cita;
        const nombreCliente = document.createElement("P");
        nombreCliente.innerHTML = `<span>Nombre: </span> ${nombre}`;

        fechaCita = document.createElement("P");
        fechaCita.innerHTML = `<span>Fecha: </span> ${fecha}`;

        const horaCita =document.createElement("P");
        horaCita.innerHTML = `<span>Hora: </span>${hora}`;


        for(i=0; i<servicios.length;i++){
            const contenedorServicio = document.createElement("DIV");
            contenedorServicio.classList.add('contenedor-servicio');

            const textoServicio = document.createElement("P");
            textoServicio.textContent = servicios[i].nombre;

            const precioServicio = document.createElement("P");
            precioServicio.innerHTML = `<span>Precio: </span> $ ${servicios[i].precio}`;

            contenedorServicio.appendChild(textoServicio);
            contenedorServicio.appendChild(precioServicio);
            resumen.appendChild(contenedorServicio);
        }

        resumen.appendChild(nombreCliente);
        resumen.appendChild(fechaCita);
        resumen.appendChild(horaCita);
       
}

function mostrarAlerta(mensaje,tipo,seccion,desaparece = true){
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia){
        alertaPrevia.remove();
    }; // SI hay una alerta previa, que no la coloque y la elimine

    //Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo); 
    const contenedor = document.querySelector(seccion);
    contenedor.appendChild(alerta);

    //Eliminar la alerta
    
    if(desaparece){
        setTimeout(()=>{
            alerta.remove();
        },3000)
    }
}

