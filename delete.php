<?php
  require_once __DIR__ .'/config.php';
  $sql = new mysqli(HOST_NAME, DB_NAME, DB_PW, "ruches");
  if($sql->connect_error)
  {
    die("Connection échouée:".$sql->connect_error);
  }

  $query =  'DELETE FROM News WHERE msg_id ='. $_GET["id"];

  echo $query;

  if ($sql->query($query) == TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  header("Location: ruche.php?rId=".$_GET["rId"]);
?>