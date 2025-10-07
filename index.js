//TODO make ui for limites and alerte managing
let params = new URLSearchParams(document.location.search);
window.scrollTo(0, params.get("scroll"));
function getValuesFromClass(className) {
    let values = document.getElementsByClassName(className);
    let arr = [];
    for (let i = 0; i < values.length; i++) {
        const element = values[i];
        arr.push(element.innerHTML);
    }
    return arr;
}
let dates = getValuesFromClass("date");
let temps_int = getValuesFromClass("temp_int");
let temps_ext = getValuesFromClass("temp_ext");
let masses = getValuesFromClass("masse");
let humidites = getValuesFromClass("humidite");
const ctx = document.getElementById('myLineChart').getContext('2d');
let chart = new Chart(ctx, {});

function drawGraph(data, label, col_for, col_back) {
    chart.destroy();
    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [
                {
                    label: label,
                    data: data,
                    borderColor: col_for,
                    backgroundColor: col_back,
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: false }
            }
        }
    });
}
function showMass() {
    drawGraph(masses, "Masse (kg)", "rgb(100, 170, 100)", "rgb(120, 170, 120)");
}

function showHumid() {
    drawGraph(humidites, "Humiditée (%)", "rgb(170, 100, 100)", "rgb(170, 120, 120)");
}

function showIntTemp() {
    drawGraph(temps_int, "Température Interne (°C)", "rgb(170, 100, 170)", "rgb(170, 120, 170)");
}

function showExtTemp() {
    drawGraph(temps_ext, "Température Externe (°C)", "rgb(170, 170, 120)", "rgb(170, 170, 120)");
}

let form = document.getElementById("form");
let closeFormButton = document.getElementById("closeForm");

function toggleForm(){
    if(form.hasAttribute("class"))
    {
        form.removeAttribute("class");
        closeFormButton.removeAttribute("class");
    }
    else 
    {
        form.setAttribute("class", "hidden");
        closeFormButton.setAttribute("class", "hidden");
    }
}