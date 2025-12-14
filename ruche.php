<!DOCTYPE html>
<html>

<head>
  <title>Suivi de ruche</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <h1 id="title">Ruche </h1>
  <button id="alertButton" onclick="onAlertClick()">⚠️</button>
  <button id="settingsButton" onclick="onSettingsClick()">⚙️</button>
  <center><canvas id="myLineChart" width="200px" height="200px"></canvas></center>

  <?php
      //génération d'alertes ce fait ici
      require_once __DIR__ .'/config.php';
      $sql = new mysqli(HOST_NAME, DB_NAME, DB_PW, "ruches");
      if ($sql->connect_error) {
        die("Connection échouée:" . $sql->connect_error);
      }

      $rId = $_GET["rId"];

      //TODO MAKE THIS FUNCTION WORK
      function checkForAlerts(&$sql, $rId, )
      {
        $requete = '
          SELECT * FROM '. $rId .' WHERE 
          (('.$rId.'.masse > (SELECT maxLim FROM limites WHERE alias = "Masse")) OR
          ('.$rId.'.masse < (SELECT minLim FROM limites WHERE alias = "Masse")))';
        $result = $sql->query($requete);
        while($row = $result->fetch_assoc())
        {
          $insert = "INSERT INTO alertes VALUE('Masse',".$row["masse"].",false,".$row["id_record"].",'".$rId."');";
          $exists = $sql->query("SELECT * FROM alertes WHERE alias = 'Masse' AND id_record=".$row["id_record"])->fetch_assoc();
          if($exists == null)
            $sql->query($insert);
        }
      }

      checkForAlerts(); 

      /*$requete = '
        SELECT * FROM '. $rId .' WHERE 
        ('.$rId.'.temp_int > (SELECT maxLim FROM limites WHERE alias = "Température interne")) OR
        ('.$rId.'.temp_int < (SELECT minLim FROM limites WHERE alias = "Température interne"))';
      $result = $sql->query($requete);
      while($row = $result->fetch_assoc())
      {
        $
      }

      $requete = '
        SELECT * FROM '. $rId .' WHERE 
        ('.$rId.'.temp_ext > (SELECT maxLim FROM limites WHERE alias = "Température externe")) OR
        ('.$rId.'.temp_ext < (SELECT minLim FROM limites WHERE alias = "Température externe"))';
      $result = $sql->query($requete);
      while($row = $result->fetch_assoc())
      {
        $
      }
      $requete = '
        SELECT * FROM '. $rId .' WHERE 
        ('.$rId.'.humidite > (SELECT maxLim FROM limites WHERE alias = "Humidité")) OR 
        ('.$rId.'.humidite < (SELECT minLim FROM limites WHERE alias = "Humidité"));
        ';
      $result = $sql->query($requete);
      while($row = $result->fetch_assoc())
      {
        $
      }*/
  ?>


  <div id="settings" class="hidden">
    <ul>
      <li>Modifications de seuils</li>
      <li><button class="settingsButton" onclick="onMassModify()">Masse</button></li>
      <li><button class="settingsButton" onclick="onHumidityModify()">Humidité </button></li>
      <li><button class="settingsButton" onclick="onOuterTempModify()">Température externe</button></li>
      <li><button class="settingsButton" onclick="onInnerTempModify()">Température interne</button></li>
    </ul> 
  </div>

  <div id="alerts" class="hidden">
    <ul>
    <?php
      //$requete = "SELECT"
    ?>
    <ul>

    </ul>
  </div>

  <div>
    <button onclick="showMass()">Masse</button>
    <button onclick="showHumid()">Humidité</button>
    <button onclick="showIntTemp()">Température interne</button>
    <button onclick="showExtTemp()">Température externe</button>
  </div>
  <button id="addObservation" onclick="toggleForm()">Ajouter Observation</button>
  <div id="form" class="hidden">
  <?php
    echo "<form action='message.php?rId=".$_GET["rId"]."' method='post'>";
  ?>
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
      <center><button id="formButton">Envoyer</button></center>
    </ul>
  </form>
  </div>
  <?PHP


  echo "<div class='hidden' id='rId'>".$_GET["rId"]."</div>";

  $requete = "SELECT id_record, date, temp_int, temp_ext, humidite, masse FROM " . $_GET['rId'];
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

  $requete = "SELECT minLim, maxLim, alias FROM limites";
  $result = $sql->query($requete);
  while ($row = $result->fetch_assoc()) {
    echo "<p class='hidden' id='min".$row["alias"]."'>".$row["minLim"]."</p>";
    echo "<p class='hidden' id='max".$row["alias"]."'>".$row["maxLim"]."</p>";
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
            echo "<script> function Delete" . htmlspecialchars($row["msg_id"]) . "(){window.location.replace('delete.php?id=" . htmlspecialchars($row["msg_id"]) . "&rId=".$_GET["rId"]."');}</script>";
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