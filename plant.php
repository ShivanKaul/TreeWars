<link rel="stylesheet" href="style.css" type="text/css">

<?php

include 'connect.php';
include 'header.php';

if($_SESSION['signed_in'] == true)
{
	
	if(!isset($_POST['tiles']) && !isset($_POST['tree_name']) ){
		
		echo	'What would you like to call your tree? :D';
		echo	'<form method="POST" action="">
			<input type="text" name="tree_name" value=""><br>';
		echo 	'Where would you like to plant your tree? <br>';

		$count0 = 0;
		$count1 = 1;
		
		$sql = $connection->prepare
		("
			SELECT
				coordinates
			FROM
				trees
		");
		$sql->execute();
		
		while($array = $sql->fetch(PDO::FETCH_NUM))
		{
			$trees_array[] = $array[0];
		}
		
		if(empty($trees_array))
		{
			$trees_array = array("Nothing"=>"to see here");
		}
		
					$sql2 = $connection->prepare
					("
					SELECT
						trees.coordinates, users.user_id, teams.team_id
					FROM
						trees
					LEFT JOIN
						users
					ON
						trees.tree_owner=users.user_id
					LEFT JOIN
						teams
					ON
						users.user_team=teams.team_id
					");
					$sql2->execute();
					
					$team_array = array();
										
					while($array = $sql2->fetch(PDO::FETCH_ASSOC))
					{
						$team_array[] = $array;
					}
					
					$user_ids = array_column($team_array, 'user_id', 'coordinates');					
					$team_ids = array_column($team_array, 'team_id', 'coordinates');
				
		while($count1 < 11){
			
			$count2 = 1;
			
			while($count2 <11){
				
				if(in_array($count1 .''. $count2, $trees_array) ){
										
					if($_SESSION['user_id'] == $user_ids[$count1 . $count2] 
					|| $_SESSION['user_team'] == $team_ids[$count1 . $count2])
					{
						echo '<div id="'. $count1 .''. $count2 .'" class="friend"></div>';
						$count2++;	
					}
					else
					{
						echo '<div id="'. $count1 .''. $count2 .'" class="foe"></div>';
						$count2++;
					}
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
		if(!isset($_POST['tiles']) || !isset($_POST['tree_name']) )
		{
			echo 'You forgot to name your tree or select a tile! :(';
		}
		else
		{
			$sql = $connection->prepare
		("
			INSERT INTO
				trees(coordinates, tree_name, tree_date, tree_owner, tree_level)
			VALUES
				(:coordinates, :tree_name, NOW(), :tree_owner, 0)
		");
		$tiles = (int)$_POST['tiles'];
		
		$sql->bindParam(':coordinates', $tiles);
		$sql->bindParam(':tree_name', $_POST['tree_name']);
		$sql->bindParam(':tree_owner', $_SESSION['user_id']);
		
		$sql->execute();
		
		echo 'Tree successfully planted!! :D';
		}
	}
}
else
{
	echo 'You must <a href="index.php">sign in</a> before planting a tree! :)';
}

?>