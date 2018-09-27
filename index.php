<?php
//$projects_table="projects"; 
//$photos_table="photos"; 

function db_connector() { 
	$servername = "localhost"; 
	$username = "root"; 
	$password = "";  
	$dbname = "test1";
	return mysqli_connect($servername,$username,$password,$dbname); 	
}

class project
{
	public function display_projects(){
		//вывести список всех проектов из бд
		$conn = db_connector();
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "select * from projects";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<div align=center>№: " . $row["id"]. " - name: " . $row["name"]. "   
				<form align=center method='POST' action='delete_project.php'>
					<input type='hidden' value='".$row["id"]."' name='id'>
					<input type='submit' value='DELETE' name='name'>
				</form>
				<form align=center method='POST' action='add_photo.php'>
					<input type='hidden' value='".$row["id"]."' name='id'>
					<input type='submit' value='add photo' name='name'>
				</form>
				<form align=center method='POST' action='display_photo.php'>
					<input type='hidden' value='".$row["id"]."' name='id'>
					<input type='submit' value='display photo' name='name'>
				</form>
				</div>
				<br>";
				
			}
		} else {
			echo "0 results";
		}
		$conn->close();
	}
	public function add_project($name){
		$conn = db_connector();
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "INSERT INTO projects (name)
				VALUES ('$name')";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
	
	public function del_project($id){
		//удалить проект из бд
		$conn = db_connector();
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "DELETE FROM projects WHERE id='$id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record deleted successfully";
		} else {
			echo "Error deleting record: " . $conn->error;
		}
		
	
		//удалить фото из этого проекта
		$sql = "DELETE FROM photos WHERE project_id='$id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record deleted successfully";
		} else {
			echo "Error deleting record: " . $conn->error;
		}
		
	}
	
	
	
}

class photo
{
	public function display_photos($project_id){
		//вывод всех фото из текущего проекта
		$conn = db_connector();
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "select * from photos
				where project_id = '$project_id'";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<div align=center>№: " . $row["id"]. " - name: " . $row["name"]. "   
				<form align=center method='POST' action='delete_photo.php'>
					<input type='hidden' value='".$row["id"]."' name='id'>
					<input type='submit' value='DELETE' name='name'>
				</form>
				";
				
			}
		} else {
			echo "0 results";
		}
		$conn->close();
	}
	
	public function add_photo($name, $src, $project_id){
		
		
		//открывается диалог для выбора фото из компа и добавляется в бд
		$conn = db_connector();
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "INSERT INTO photos (name, src, project_id)
				VALUES ('$name', '$src', '$project_id')";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
	
	//проверка уникальности имени фото в проекте.
	public function uniq_check_name_photo($name){
		$conn = db_connector();
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "select * from photos where name = '$name'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "change name of photo!";
				return false;
			}
		} else {
			return true;
		}
		$conn->close();
		
	}
	
	public function del_photo($id){
		//вывести все фото и добавить кнопкы delete напротив фотки
		
		$conn = db_connector();
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "DELETE FROM photos WHERE id='$id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record deleted successfully";
		} else {
			echo "Error deleting record: " . $conn->error;
		}
	}
	
	
}


$p = new project();
$ph = new photo();
?>

<html>
<head><title></title></head>
<body>
<h1>choose action</h1>
	<form method="POST" align=center action="display_projects.php">
	<input type="submit"  value="display projects" name="9" style="margin:0 0 0 10px"><br>
	</form>

	<form method="POST" align=center action="add_project.php">
    <input type="submit" value="add project" name="1" style="margin:0 0 0 10px"><br>
	</form>
	

	
</body>
</html>