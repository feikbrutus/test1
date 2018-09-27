<?
include ('index.php');
/*
$uploaddir = '/pictures/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

echo 'Некоторая отладочная информация:';
print_r($_FILES);

print "</pre>";
*/
$userfile = $_FILES['userfile']['name'];
$temp_name = $_FILES['userfile']['tmp_name'];

$id = $_POST["id"];

//echo $temp_name;

$src = "/pictures/";

if($ph -> uniq_check_name_photo($userfile) == true){
	
	$ph -> add_photo($userfile, $src, $id);
}
?>