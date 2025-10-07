<?php
$sql = new mysqli("localhost", "root", "", "ruches");
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
header("Location: /index.php?scroll=".$_GET["scroll"]);
?>