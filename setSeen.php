<?php
  require_once __DIR__ .'/config.php';
  $sql = new mysqli(HOST_NAME, DB_NAME, DB_PW, "ruches");
  if($sql->connect_error)
  {
    die("Connection échouée:".$sql->connect_error);
  }

  $sql->query("UPDATE alertes set seen = 1 where id_record = ".$_GET["aId"]." AND identifier = '".$_GET["id"]."' AND nom_ruche = '".$_GET["rId"]."'");
  header("Location: ruche.php?rId=".$_GET["rId"]);
?>