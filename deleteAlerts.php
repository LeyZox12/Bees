<?php
  require_once __DIR__ .'/config.php';
  $sql = new mysqli(HOST_NAME, DB_NAME, DB_PW, "ruches");
  if($sql->connect_error)
  {
    die("Connection échouée:".$sql->connect_error);
  }
  $sql->query('DELETE FROM alertes where nom_ruche = "'.$_GET["rId"].'"');
  header("Location: ruche.php?rId=".$_GET["rId"]);
?>