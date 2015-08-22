<link rel="stylesheet" href="style.css" type="text/css">

<?php

include 'connect.php';

if(isset($_POST['tiles']) ){
	echo	'What would you like to call your tree? :D';
	echo	'<form>
			<input type="text" name="tree_name" value="">';
	echo 	'Where would you like to plant your tree? <br>';

	$count0 = 0;
	$count1 = 0;
	
	$sql = $connection->prepare
	("
			SELECT
				coordinates
			FROM
				trees
		");
	$sql->execute();
	
	$trees_array = $sql->fetch(PDO::FETCH_NUM);
	
	while($count1 < 10){
		
		$count2 = 0;
		
		while($count2 <10){
			
			if(in_array($count1 .''. $count2, $trees_array) ){
				echo '<div id="'. $count1 .''. $count2 .'" class="taken"></div>';
				$count2++;
			}
			else
			{
				echo '<div id="'. $count1 .''. $count2 .'" class="tile">
				<input name="tiles" value="'. $count1 .''. $count2 .'" type="radio"></div>';
				$count2++;
			} 
			
		}
		echo '<br><br><br>';
		$count1++;
	}	

	echo '	<input type="submit" value="Go!">
		<br>
		</form>';
}
else
{
	
}

?>

<script>
function funk() {
	<?php
	
	$sql = $connection->prepare
	("
			INSERT INTO
				trees(coordinates, tree_name, tree_date, tree_owner)
			VALUES
				(:coordinate, :tree_name, NOW(), :tree_owner)
		");
	
	$sql->bindParam(':coordinates', $_POST['']);
	$sql->bindParam(':tree_name', $_POST['']);
	$sql->bindParam(':tree_owner', $_SESSION['user']);
	
	$sql->execute();
	
	?>
}
</script>