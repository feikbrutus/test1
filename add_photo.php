<?
$id=$_POST["id"];
?>
<html>
<head><title></title></head>
<body>
<h1>add photo to project id: <? echo $id;?></h1>

<form enctype="multipart/form-data" method="post" action="add_ph.php" align=center>
	<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
	<input type="file" name='userfile' accept="image/*,image/jpeg">
	<input type='hidden' value='<? echo $_POST["id"]; ?>' name='id'>
	<input type="submit" value="upload">
</form> 

<form method="post" align=center action="index.php">
    <input type="submit" value="back to menu" name="1" style="margin:10 0 0 10px"><br>
</form>
</body>
</html>