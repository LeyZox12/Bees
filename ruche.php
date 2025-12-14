<!DOCTYPE html>
<html>

<head>
  <title>Suivi de ruche</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <h1 id="title">Ruche </h1>
    <div id="mainbox">

    <button onclick="window.location = 'index.html'"><-</button>
    <label for="vals">Choisir valeur:</label>
    <select name="vals" id="vals" onchange="changeValue()">
      <option value="mass">Masse</option>
      <option value="humid">Humidité</option>
      <option value="temp_int">Température Interne</option>
      <option value="temp_ext">Température Externe</option>
    </select>
      <canvas id="myLineChart" width="200px" height="200px"></canvas>
    </div>

  <?php

  //TODO date selector, trier observations par date
      //-------------------------génération des alertes---------------------------
      require_once __DIR__ .'/config.php';
      $sql = new mysqli(HOST_NAME, DB_NAME, DB_PW, "ruches");
      if ($sql->connect_error) {
        die("Connection échouée:" . $sql->connect_error);
      }

      $rId = $_GET["rId"];

      function checkForAlerts(&$sql, $rId, $alias, $name)
      {
        $requete = '
          SELECT * FROM '. $rId .' WHERE 
          (
          ('.$rId.'.'.$name.' > (SELECT maxLim FROM limites WHERE alias = "'.$alias.'" AND nom_ruche = "'.$rId.'")) OR
          ('.$rId.'.'.$name.' < (SELECT minLim FROM limites WHERE alias = "'.$alias.'" AND nom_ruche = "'.$rId.'"))
          )';
        $result = $sql->query($requete);
        while($row = $result->fetch_assoc())
        {
          $insert = "INSERT INTO alertes VALUE('".$alias."','".$name."',false,".$row["id_record"].",'".$rId."');";
          $exists = $sql->query("SELECT * FROM alertes WHERE alias = '".$alias."' AND id_record=".$row["id_record"])->fetch_assoc();
          if($exists == null)
            $sql->query($insert);
        }
      }

      checkForAlerts($sql, $rId, "Masse", "masse");
      checkForAlerts($sql, $rId, "humidité", "humidite");
      checkForAlerts($sql, $rId, "Température interne", "temp_int");
      checkForAlerts($sql, $rId, "Température externe", "temp_ext");

  ?>


  <div id="settings">
    <ul>
      <li>Modifications de seuils</li>
      <li><button class="settingsButton" onclick="onMassModify()">Masse</button></li>
      <li><button class="settingsButton" onclick="onHumidityModify()">Humidité </button></li>
      <li><button class="settingsButton" onclick="onOuterTempModify()">Température externe</button></li>
      <li><button class="settingsButton" onclick="onInnerTempModify()">Température interne</button></li>
    </ul> 
  </div>
  <div id="alerts">
    <ul>
    <?php

      $requete = "SELECT ".$rId.".*, alertes.* FROM alertes JOIN ".$rId." ON alertes.id_record = ".$rId.".id_record WHERE nom_ruche='".$rId."' ORDER BY seen;";
      $result = $sql->query($requete);
      while($row = $result->fetch_assoc())
      {
        $class = "alert";
        if($row["seen"] == 1)
          $class = "seenAlert";
        echo "<p class='".$class."'>⚠️".$row["alias"]." trop haute ou trop faible : ".$row[$row["identifier"]]."<br>Le ". $row["date"];
        if($row["seen"] != 1) 
        {
          echo "<br><button onclick="."'window.location = \"setSeen.php?rId=".$rId."&aId=".$row["id_record"]."&id=".$row["identifier"]. "\"'".">✅</button>";
        }
        echo "</p>";
      }
    ?>
    <ul>

    </ul>
  </div>
  <button id="addObservation" onclick="toggleForm()">Ajouter Observation</button>
  <div id="form" class="hidden">
  <?php
    echo "<form style='position:fixed' action='message.php?rId=".$_GET["rId"]."' method='post'>";
  ?>
    <button type="button" style="right: 10px; position: fixed;" onclick="toggleForm()">x</button>
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
      echo "<p class='date'>" . $row["date"] . "</p>";

      echo "<p class='temp_int'>" . $row["temp_int"] . "</p>";

      echo "<p class='temp_ext'>" . $row["temp_ext"] . "</p>";

      echo "<p class='humidite'>" . $row["humidite"] . "</p>";

      echo "<p class='masse'>" . $row["masse"] . "</p>";
      echo "</div>";
    }
  }

  $requete = "SELECT minLim, maxLim, alias FROM limites WHERE nom_ruche = '".$rId."'";
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
        $requete = "SELECT * FROM News WHERE nom_ruche = '".$rId."'";
        $result = $sql->query($requete);
        if ($result->num_rows > 0) {

          // tant qu'il y a des lignes
        
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th scope = 'row'>" . $row["date"] . "</th>";
            echo "<td>" . $row["message"] . "</td>";
            echo "<td>" . $row["force"] . "</td>";
            echo "<td>" . $row["masse"] . "</td>";
            echo "<td>" . $row["reine"] . "</td>";
            echo "<td>" . $row["nourit"] . "</td>";
            echo "<td>" . $row["traitement"] . "</td>";
            echo "<td>" . "<button onclick=Delete" . $row["msg_id"] . "()>
            🗑️</button></td>";
            echo "</tr>";
            echo "<script> function Delete" . $row["msg_id"]. "(){window.location.replace('delete.php?id=" . $row["msg_id"] . "&rId=".$_GET["rId"]."');}</script>";
          }
        }
        ?>
      </tbody>
    </table>
      <div>
      <h1>A propos</h1>
        <p>
          Je n'ai pas assez d'infos sur le projet
        </p>
      </div>
  </center>

  <link rel="stylesheet" href="style.css">
  <script src="index.js"></script>
</body>

</html>