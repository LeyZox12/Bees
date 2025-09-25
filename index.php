

<!DOCTYPE html>
<html>
<head>
  <title>Line Chart Example</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <canvas id="myLineChart" width="400" height="200"></canvas>
  <div>
    <button onclick="showMass()">Masse</button>
    <button onclick="showHumid()">Humidité</button>
    <button onclick="showIntTemp()">Température interne</button>
    <button onclick="showExtTemp()">Température externe</button>
  </div>
<p class='date'>05-05-25 10:19:25</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>44</p><p class='date'>05-05-25 10:20:19</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>45</p><p class='date'>05-05-25 10:21:31</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>46</p><p class='date'>05-05-25 10:23:40</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>44</p><p class='date'>05-05-25 10:25:14</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>48</p>  <script>
    function getValuesFromClass(className)
    {
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
    
    function drawGraph(data, label, col_for, col_back)
    {
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
      function showMass()
      {
        drawGraph(masses, "Masse (kg)", "rgb(100, 170, 100)", "rgb(120, 170, 120)");
      }

      function showHumid()
      {
        drawGraph(humidites, "Humiditée (%)", "rgb(170, 100, 100)", "rgb(170, 120, 120)");
      }

      function showIntTemp()
      {
          drawGraph(temps_int, "Température Interne (°C)", "rgb(170, 100, 170)", "rgb(170, 120, 170)");
      }

      function showExtTemp()
      {
          drawGraph(temps_ext, "Température Externe (°C)", "rgb(170, 170, 120)", "rgb(170, 170, 120)");
      }
    
  </script>
</body>
</html>



<!DOCTYPE html>
<html>
<head>
  <title>Line Chart Example</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <canvas id="myLineChart" width="400" height="200"></canvas>
  <div>
    <button onclick="showMass()">Masse</button>
    <button onclick="showHumid()">Humidité</button>
    <button onclick="showIntTemp()">Température interne</button>
    <button onclick="showExtTemp()">Température externe</button>
  </div>
<p class='date'>05-05-25 10:19:25</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>44</p><p class='date'>05-05-25 10:20:19</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>45</p><p class='date'>05-05-25 10:21:31</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>46</p><p class='date'>05-05-25 10:23:40</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>44</p><p class='date'>05-05-25 10:25:14</p><p class='temp_int'>22</p><p class='temp_ext'>19</p><p class='humidite'>80</p><p class='masse'>48</p>  <script>
    function getValuesFromClass(className)
    {
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
    
    function drawGraph(data, label, col_for, col_back)
    {
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
      function showMass()
      {
        drawGraph(masses, "Masse (kg)", "rgb(100, 170, 100)", "rgb(120, 170, 120)");
      }

      function showHumid()
      {
        drawGraph(humidites, "Humiditée (%)", "rgb(170, 100, 100)", "rgb(170, 120, 120)");
      }

      function showIntTemp()
      {
          drawGraph(temps_int, "Température Interne (°C)", "rgb(170, 100, 170)", "rgb(170, 120, 170)");
      }

      function showExtTemp()
      {
          drawGraph(temps_ext, "Température Externe (°C)", "rgb(170, 170, 120)", "rgb(170, 170, 120)");
      }
    
  </script>
</body>
</html>

