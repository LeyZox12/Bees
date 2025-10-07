<?php
$sql = new mysqli("localhost", "root", "", "ruches");
if($sql->connect_error)
{
  die("Connection échouée:".$sql->connect_error);
}

$query =  'INSERT INTO News VALUE ("'.$_POST["form_date"].'","'.$_POST["form_message"].'",'. $_POST["form_force"].','. $_POST["form_masse"].',"'. $_POST["form_reine"].'","'. $_POST["form_nourit"].'","' .$_POST["form_traitement"].'",0, 0);';
echo $_POST["form_date"]."<br>";
echo $_POST["form_message"]."<br>";
echo $_POST["form_force"]."<br>";
echo $_POST["form_masse"]."<br>";
echo $_POST["form_reine"]."<br>";
echo $_POST["form_nourit"]."<br>";
echo $_POST["form_traitement"]."<br>";
echo $query."<br>";

if ($sql->query($query) == TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
header("Location: /index.php?scroll=".$_GET["scroll"]);
?>