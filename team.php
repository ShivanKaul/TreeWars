<title>Create your team!</title>

<?php

include 'connect.php';
include 'header.php';

?>

<form method="POST" action="">
Team name:<br>
<input type="text" name="team_name">
<br>
School:<br>
<input type="text" name="team_school">
<br>
Team description:<br>
<input type="description" name="team_description">
<input type="submit" value="Go!">
</form>

<?php

if($_SESSION['signed_in'] == true)
{
	
	if(	isset($_POST['team_name']) && 
		isset($_POST['team_school']) && 
		isset($_POST['team_description']))
	{		
		$sql = $connection->prepare
		("
			INSERT INTO
				teams(team_name, team_date, team_school, team_description)
			VALUES
				(:team_name, NOW(), :team_school, :team_description)
		");
		
		$sql->bindParam(':team_name', $_POST['team_name']);
		$sql->bindParam(':team_school', $_POST['team_school']);
		$sql->bindParam(':team_description', $_POST['team_description']);
		
		$sql->execute();
		
		
	}
	
}
else
{
	echo 'Please <a href="index.php">sign in</a> before creating a team! :)';
}



?>