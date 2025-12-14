//TODO make ui for limites and alerte managing
let params = new URLSearchParams(document.location.search);

const settings = document.getElementById("settings");
const alert = document.getElementById("alerts");

let minMass = document.getElementById("minMasse").innerHTML;
let maxMass = document.getElementById("maxMasse").innerHTML;
let minHumid = document.getElementById("minHumidité").innerHTML;
let maxHumid = document.getElementById("maxHumidité").innerHTML;
let minInner = document.getElementById("minTempérature interne").innerHTML;
let maxInner = document.getElementById("maxTempérature interne").innerHTML;
let minOuter = document.getElementById("minTempérature externe").innerHTML;
let maxOuter = document.getElementById("maxTempérature externe").innerHTML;

document.getElementById("title").innerHTML += params.get("rId")[params.get("rId").length-1];

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
const canvas = document.getElementById('myLineChart');
const ctx = canvas.getContext('2d');
let chart = new Chart(ctx, {});

function drawGraph(data, label, col_for, col_back, minLim, maxLim) {
    chart.destroy();

    minData = [];
    maxData = [];

    for(let i = 0; i < data.length; i++)
    {
        minData.push(minLim);
        maxData.push(maxLim);
    }

    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [
                {
                    label: "Valeur Max Autorisée",
                    data: maxData,
                    borderColor: "rgb(255, 0, 0)",
                    backgroundColor: "rgba(0, 0, 0, 0)",
                    borderWidth: 3,
                    fill: false,
                    tension: 0.4,
                    z:2
                },
                {
                    label: "Valeur Min Autorisée",
                    data: minData,
                    borderColor: "rgba(0, 132, 255, 1)",
                    backgroundColor: "rgba(0, 0, 0, 0)",
                    borderWidth: 3,
                    fill: false,
                    tension: 0.4,
                    z:2
                },
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
                y: { beginAtZero: true }
            },
        
        }

    });
}

function max(data)
{
    currMax = eval(data[0]);
    for(let i = 1; i < data.length; i++)
        currMax = Math.max(currMax, eval(data[i]));
    return Math.ceil(currMax/5.0)*5;
}

function showMass() {
    drawGraph(masses, "Masse (kg)", "rgb(100, 170, 100)", "rgb(120, 170, 120)", minMass, maxMass);
}

function showHumid() {
    drawGraph(humidites, "Humiditée (%)", "rgb(170, 100, 100)", "rgb(170, 120, 120)", minHumid, maxHumid);
}

function showIntTemp() {
    drawGraph(temps_int, "Température Interne (°C)", "rgb(170, 100, 170)", "rgb(170, 120, 170)", minInner, maxInner);
}

function showExtTemp() {
    drawGraph(temps_ext, "Température Externe (°C)", "rgb(170, 170, 120)", "rgb(170, 170, 120)", minOuter, maxOuter);
}

let form = document.getElementById("form");
let closeFormButton = document.getElementById("closeForm");

function toggleForm(){
    if(form.hasAttribute("class") && form.getAttribute("class") == "hidden")
    {
        form.setAttribute("class", "showForm");
    }
    else 
    {
        form.setAttribute("class", "hidden");
    }
}

function onAlertClick()
{
    if(alert.hasAttribute("class"))
        alert.removeAttribute("class");
    else 
        alert.setAttribute("class", "hidden");
}

function onSettingsClick()
{
    if(settings.hasAttribute("class"))
        settings.removeAttribute("class");
    else 
        settings.setAttribute("class", "hidden");
}

function onMassModify()
{
    modify("Masse");
}

function onHumidityModify()
{
    modify("Humidité");
}

function onInnerTempModify()
{
    modify("Température interne");
}

function onOuterTempModify()
{
    modify("Température externe");
}

function modify(name)
{
    let minv = "";
    let maxv = "";
    minv = window.prompt(name + " Mininmale:");
    maxv = window.prompt(name + " Maximale:");
    window.location.replace("modify.php?rId="+document.getElementById("rId").innerHTML+"&id=" + name + "&min=" + minv + "&max=" + maxv); 
}