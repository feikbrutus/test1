<?
include ('index.php');
$id=$_POST["id"];
echo "id=".$id;
echo "<br>";
$ph -> display_photos($id);


?>