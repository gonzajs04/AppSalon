let paso=1;const pasoInicial=1,pasoMaximo=3;function iniciarApp(){tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior()}function mostrarSeccion(){const o=document.querySelector(".mostrar");o&&o.classList.remove("mostrar");const t="#paso-"+paso;document.querySelector(t).classList.add("mostrar");const e=document.querySelector(".actual");e&&e.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(o=>{o.addEventListener("click",o=>{paso=parseInt(o.target.dataset.paso),mostrarSeccion(),botonesPaginador()})})}function botonesPaginador(){const o=document.querySelector("#siguiente"),t=document.querySelector("#anterior");1===paso?(t.classList.add("ocultar"),o.classList.remove("ocultar")):3===paso?(t.classList.remove("ocultar"),o.classList.add("ocultar")):(t.classList.remove("ocultar"),o.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",()=>{paso<=1||paso--,botonesPaginador()})}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",()=>{paso>=3||paso++,botonesPaginador()})}document.addEventListener("DOMContentLoaded",()=>{iniciarApp()});