document.addEventListener('DOMContentLoaded',()=>{
    iniciarApp();
})
function iniciarApp(){
    buscarPorFecha();
}
function buscarPorFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', (e)=>{
        const fechaSeleccionada = e.target.value;
        //Redirijo sobre la misma URL pero con el value de fecha para leerlo en el controlador
        window.location = `/admin?fecha=${fechaSeleccionada}`;
    });
}
