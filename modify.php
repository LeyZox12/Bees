<?php
  require_once __DIR__ .'/config.php';
$name = $_GET["id"];
$minv = $_GET["min"];
$maxv = $_GET["max"];
if($minv == null || $maxv == null)
  header("Location: ruche.php?rId=".$_GET["rId"]);
$sql = new mysqli("localhost", "root", "", "ruches");
  if ($sql->connect_error) {
    die("Connection échouée:" . $sql->connect_error);
  }
  $requete = "UPDATE limites SET `minLim`=". $minv .", `maxLim`=".$maxv." where `alias` ="."'".$name."' AND nom_ruche = '".$_GET["rId"]."'";
  echo $requete;
  $result = $sql->query($requete);
  header("Location: deleteAlerts.php?rId=".$_GET["rId"]);

?>