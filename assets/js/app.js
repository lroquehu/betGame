// roquebet/assets/js/app.js - Dashboard Funcionalidad Completa

let montoSeleccionado = 0;
let equipoSeleccionado = null;
let girando = false;
let saldoOriginal = 0;

// Seleccionar monto
function recargarMonto(monto) {
    // Obtener saldo actual
    const saldoActual = parseFloat(document.getElementById("user-saldo").innerText);

    // Validar que el monto no sea mayor que el saldo
    if (monto > saldoActual) {
        alert("Saldo insuficiente. Tu saldo actual es S/ " + saldoActual.toFixed(2));
        document.getElementById("resultado").innerText = "Saldo insuficiente";
        document.getElementById("resultado").style.color = "#ff0000";
        return;
    }

    // Si ya había un monto seleccionado, restaurar el saldo
    if (montoSeleccionado > 0) {
        const nuevoSaldo = saldoActual + montoSeleccionado;
        document.getElementById("user-saldo").innerText = nuevoSaldo.toFixed(2);
    }

    // Resetear la ruleta a su posición original cuando se selecciona un nuevo monto
    const wheel = document.getElementById('roulette-wheel');
    wheel.style.transition = 'none';
    wheel.style.transform = 'rotate(0deg)';

    montoSeleccionado = monto;
    console.log("Monto seleccionado: S/ " + monto);

    // Guardar saldo original si es la primera vez
    if (saldoOriginal === 0) {
        saldoOriginal = parseFloat(document.getElementById("user-saldo").innerText);
    }

    // Descontar el monto del saldo mostrado
    const saldoFinal = parseFloat(document.getElementById("user-saldo").innerText);
    const nuevoSaldo = saldoFinal - monto;
    document.getElementById("user-saldo").innerText = nuevoSaldo.toFixed(2);

    // Habilitar botones de equipos
    document.getElementById("local").disabled = false;
    document.getElementById("empate").disabled = false;
    document.getElementById("visitante").disabled = false;

    // Mostrar monto seleccionado
    document.getElementById("resultado").innerText = "Monto: S/ " + monto;
    document.getElementById("resultado").style.color = "#ffc107";
}

// Seleccionar equipo y realizar apuesta
function seleccionarEquipo(equipo) {
    if (montoSeleccionado <= 0) {
        alert("Por favor selecciona un monto primero");
        return;
    }

    if (girando) {
        alert("Espera a que termine la ruleta");
        return;
    }

    equipoSeleccionado = equipo;
    deshabilitarBotones(true);

    // Enviar apuesta al servidor
    realizarApuesta(equipo);
}

// Realizar apuesta a la API
async function realizarApuesta(equipo) {
    try {
        const response = await fetch('/api/apostar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                equipo: equipo,
                monto: montoSeleccionado
            })
        });

        const data = await response.json();

        if (data.success) {
            // Iniciar la ruleta
            girando = true;
            iniciarAnimacionRuleta(data.resultado, () => {
                // Actualizar saldo
                document.getElementById("user-saldo").innerText = data.nuevoSaldo.toFixed(2);

                // Mostrar resultado
                const resH3 = document.getElementById("resultado");

                if (data.resultado === 'EMPATE') {
                    resH3.innerText = "¡EMPATE!";
                    resH3.style.color = "#ffc107";
                } else if (data.resultado === 'LOCAL') {
                    resH3.innerText = "¡LOCAL GANA!";
                    resH3.style.color = "#ff3131";
                } else if (data.resultado === 'VISITANTE') {
                    resH3.innerText = "¡VISITANTE GANA!";
                    resH3.style.color = "#008cff";
                }

                // Agregar resultado a frecuencia
                agregarResultado(data.resultado);

                girando = false;
                deshabilitarBotones(false);
                montoSeleccionado = 0;
                equipoSeleccionado = null;
            });
        } else {
            alert(data.message || "Error al realizar la apuesta");
            deshabilitarBotones(false);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Error en la conexión");
        deshabilitarBotones(false);
    }
}

// Animar la ruleta
function iniciarAnimacionRuleta(resultado, callback) {
    const wheel = document.getElementById('roulette-wheel');

    // Mapeo de resultados a rotación exacta
    // ROJO (LOCAL): 0-120 grados, centro 60
    // AZUL (VISITANTE): 120-240 grados, centro 180
    // AMARILLO (EMPATE): 240-360 grados, centro 300

    const rotacionesPorOpcion = {
        'LOCAL': 0,      // Apunta a ROJO
        'VISITANTE': 120, // Apunta a AZUL
        'EMPATE': 240     // Apunta a AMARILLO
    };

    const rotacionBase = rotacionesPorOpcion[resultado];
    const variacion = Math.random() * 20 - 10; // Variación menor para más precisión
    const rotacionFinal = rotacionBase + variacion;
    const rotacionesExtra = 360 * 3; // 3 vueltas completas
    const rotacionTotal = rotacionesExtra + rotacionFinal;

    // Aplicar animación
    wheel.style.transition = 'transform 3s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    wheel.style.transform = 'rotate(' + rotacionTotal + 'deg)';

    // Después de 3 segundos, llamar al callback SIN resetear la ruleta
    setTimeout(() => {
        callback();
    }, 3000);
}

// Deshabilitar/Habilitar botones
function deshabilitarBotones(deshabilitar) {
    document.getElementById("local").disabled = deshabilitar;
    document.getElementById("empate").disabled = deshabilitar;
    document.getElementById("visitante").disabled = deshabilitar;

    // Deshabilitar botones de monto también
    const botonesMonto = document.querySelectorAll('.btn-amount-outline');
    botonesMonto.forEach(btn => {
        btn.disabled = deshabilitar;
    });
}

// Inicializar la página
document.addEventListener('DOMContentLoaded', function() {
    console.log("Dashboard cargado");

    // Los botones de monto y equipo están deshabilitados por defecto
    // Se habilitarán cuando se seleccione un monto

    // Cargar historial de frecuencia
    cargarFrecuencia();
});

// Agregar resultado a frecuencia
function agregarResultado(resultado) {
    let frecuencia = JSON.parse(localStorage.getItem('frecuencia')) || [];

    // Mantener solo los últimos 30 resultados
    if (frecuencia.length >= 30) {
        frecuencia.shift();
    }

    frecuencia.push({
        resultado: resultado,
        timestamp: new Date().getTime()
    });

    localStorage.setItem('frecuencia', JSON.stringify(frecuencia));
    actualizarVistaFrecuencia(frecuencia);
}

// Cargar frecuencia desde localStorage
function cargarFrecuencia() {
    let frecuencia = JSON.parse(localStorage.getItem('frecuencia')) || [];
    actualizarVistaFrecuencia(frecuencia);
}

// Actualizar la vista de frecuencia
function actualizarVistaFrecuencia(frecuencia) {
    const container = document.getElementById('frequency-container');

    if (frecuencia.length === 0) {
        container.innerHTML = '<span style="color: #999; text-align: center; width: 100%; padding: 2rem;">Esperando resultados...</span>';
        return;
    }

    let html = '';
    frecuencia.forEach((item, index) => {
        let clase = '';
        let letra = '';

        if (item.resultado === 'LOCAL') {
            clase = 'frequency-local';
            letra = 'L';
        } else if (item.resultado === 'VISITANTE') {
            clase = 'frequency-visitante';
            letra = 'V';
        } else if (item.resultado === 'EMPATE') {
            clase = 'frequency-empate';
            letra = 'E';
        }

        html += `<div class="frequency-item ${clase}" title="${item.resultado}">${letra}</div>`;
    });

    container.innerHTML = html;
}
