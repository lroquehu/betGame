let saldo = 0;
let equipoSeleccionado = "";
let montoSeleccionado = "";

const local = document.getElementById("local");
const visitante = document.getElementById("visitante");
const contador = document.getElementById("contador");
const ColorInput = document.getElementById("colorInput");
const resultado = document.getElementById("resultado");
const contenedor = document.getElementById("contenedor");
const maxBotones = 24;

function seleccionarEquipo(equipo) {
  equipoSeleccionado = equipo;
  showRandomColor();
}

function recargar() {
  const recargaInput = document.getElementById('recargaInput');
  const montoRecarga = parseFloat(recargaInput.value);

  if (!isNaN(montoRecarga) && montoRecarga > 0) {
    saldo += montoRecarga;
    actualizarSaldo();
    actualizarBotones();
  } else {
    alert('Ingrese un monto válido mayor que S/. 0.');
  }
  document.getElementById('recargaInput').value = 0;
}

function recargarMonto(monto) {
  montoSeleccionado = monto;
  document.getElementById("local").disabled = false;
  document.getElementById("visitante").disabled = false;
  resultado.innerText = "";
  ColorInput.hidden = true;
  saldo -= montoSeleccionado;
  actualizarSaldo();
  actualizarBotones();
}

function actualizarSaldo() {
  const saldoInput = document.getElementById('saldoInput');
  saldoInput.value = saldo.toFixed(2);
}

function actualizarBotones() {
  const botones = document.querySelectorAll('button[id^="btn"]');
  botones.forEach((boton) => {
    const montoBoton = parseFloat(boton.textContent);
    boton.disabled = saldo < montoBoton;
  });
}

function resetearAcciones() {
  equipoSeleccionado = "";
  document.getElementById("local").disabled = true;
  document.getElementById("visitante").disabled = true;
  document.getElementById("empate").disabled = true;
  document.getElementById("negativo").disabled = true;
  document.getElementById("afirmativo").disabled = true;
}

function showRandomColor(){
  var m = 3, n = 0;
  let montoApostado = 0;
  ColorInput.hidden = true;
  const cuentaRegresiva = setInterval(() => {
    contador.hidden = false;
    contador.innerHTML = m;
    if(m === n){
      clearInterval(cuentaRegresiva);
      ColorInput.hidden = false;
      contador.hidden = true;
        switch (randomColor) {
            case "red": 
                resultado.innerText = "LOCAL GANA";
                resultado.value = "LOCAL";
            break;
            case "blue": 
                resultado.innerText = "VISITANTE GANA";
                resultado.value = "VISITANTE";
            break;
            case "orange": 
                resultado.innerText = "EMPATE";
                resultado.value = "EMPATE";
            break;
        }
        if(resultado.value === equipoSeleccionado){
            montoApostado = parseFloat(document.getElementById("btn" + montoSeleccionado).textContent) * 2;
        }else if (resultado.value == "EMPATE"){
            montoApostado = parseFloat(document.getElementById("btn" + montoSeleccionado).textContent) / 2;
        }

        saldo += montoApostado;
        actualizarSaldo();
        actualizarBotones();
        resetearAcciones();
    }else{ m--;}
  }, 1000);
  const randomColor = getRandomColor();
  ColorInput.style.backgroundColor = randomColor;
  agregarBoton(randomColor, m);
}

function getRandomColor(){
  const colores = ["red", "blue", "orange","red","blue"];
  const randomIndex = Math.floor(Math.random()*colores.length);
  return colores[randomIndex];
}

function agregarBoton(randomColor, time){
  setTimeout(function(){
    const boton = document.createElement('button');
    boton.style.border = "none";
    boton.style.backgroundColor = randomColor;
    if(contenedor.children.length >= maxBotones){
      contenedor.removeChild(contenedor.lastElementChild);
    }
    contenedor.insertBefore(boton, contenedor.firstChild);
  }, (time + 1)*1000);
}