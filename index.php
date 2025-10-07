<!DOCTYPE html>
<html>

<head>
  <title>Line Chart Example</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <h1 id="top">Ruche 1</h1>
  <canvas id="myLineChart" width="200px" height="200px"></canvas>
  <div>
    <button class="roundButton" onclick="showMass()">Masse</button>
    <button class="roundButton" onclick="showHumid()">Humidité</button>
    <button class="roundButton" onclick="showIntTemp()">Température interne</button>
    <button class="roundButton" onclick="showExtTemp()">Température externe</button>
  </div>
  <button class="roundButton" id="addObservation" onclick="toggleForm()">Ajouter Observation</button>
  <div id="form" class="hidden">
  <form action="message.php" method="post" >
    <button type="button" style="right: 10px; position: absolute;" onclick="toggleForm()">x</button>
    <ul>
      <li>
        <label for="date"> Date&nbsp;:</label>
        <input type="text" id="date" name="form_date" />
      </li>
      <li>
        <label for="msg">Message&nbsp;:</label>
        <textarea id="msg" name="form_message"></textarea>
      </li>
      <li>
        <label for="force"> Force&nbsp;:</label>
        <input type="text" id="force" name="form_force" />
      </li>
      <li>
        <label for="masse"> Masse&nbsp;:</label>
        <input type="text" id="masse" name="form_masse" />
      </li>
      <li>
        <label for="reine"> Reine&nbsp;:</label>
        <input type="text" id="reine" name="form_reine" />
      </li>
      <li>
        <label for="nourissement"> Nourit&nbsp;:</label>
        <input type="text" id="nourissement" name="form_nourit" />
      </li>
      <li>
        <label for="traitement"> Traitement&nbsp;:</label>
        <input type="text" id="traitement" name="form_traitement" />
      </li>
      <center><button>Envoyer</button></center>
    </ul>
  </form>
  </div>
  <?PHP
  $sql = new mysqli("localhost", "root", "", "ruches");
  if ($sql->connect_error) {
    die("Connection échouée:" . $sql->connect_error);
  }
  $requete = "SELECT id_record, date, temp_int, temp_ext, humidite, masse FROM ruche1";
  $result = $sql->query($requete);
  if ($result->num_rows > 0) {

    // tant qu'il y a des lignes
  
    while ($row = $result->fetch_assoc()) {

      echo "<div class='hidden'>";
      echo "<p class='date'>" . htmlspecialchars($row["date"]) . "</p>";

      echo "<p class='temp_int'>" . htmlspecialchars($row["temp_int"]) . "</p>";

      echo "<p class='temp_ext'>" . htmlspecialchars($row["temp_ext"]) . "</p>";

      echo "<p class='humidite'>" . htmlspecialchars($row["humidite"]) . "</p>";

      echo "<p class='masse'>" . htmlspecialchars($row["masse"]) . "</p>";
      echo "</div>";
    }
  }
  ?>
  <center>
    <table>
      <caption>
        Observations
      </caption>
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Observation</th>
          <th scope="col">Force</th>
          <th scope="col">Masse</th>
          <th scope="col">Reine</th>
          <th scope="col">Nourriture</th>
          <th scope="col">Traitement</th>
        </tr>
      </thead>
      <tbody>
        <?php

        if ($sql->connect_error) {
          die("Connection échouée:" . $sql->connect_error);
        }
        $requete = "SELECT * FROM News";
        $result = $sql->query($requete);
        if ($result->num_rows > 0) {

          // tant qu'il y a des lignes
        
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th scope = 'row'>" . htmlspecialchars($row["date"]) . "</th>";
            echo "<td>" . htmlspecialchars($row["message"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["force"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["masse"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["reine"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["nourit"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["traitement"]) . "</td>";
            echo "<td>" . "<button onclick=Delete" . htmlspecialchars($row["msg_id"]) . "()>
            🗑️</button></td>";
            echo "</tr>";
            echo "<script> function Delete" . htmlspecialchars($row["msg_id"]) . "(){window.location.replace('delete.php?id=" . htmlspecialchars($row["msg_id"]) . "&scroll='+scrollY);}</script>";
          }
        }
        ?>
      </tbody>
    </table>
  </center>
  <link rel="stylesheet" href="style.css">
  <script src="index.js"></script>
</body>

</html>