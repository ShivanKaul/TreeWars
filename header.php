<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="" />
<meta name="keywords" content="tree, trees, environment, green" />
<title>Tree wars</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<h1></h1>
<div id="wrapper">
<div id="menu">
<a class="item" href="index.php">Home</a>

<div id="userbar">

<?php

include 'connect.php';

session_start();

if(!isset($_SESSION['signed_in']))
{
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo '<form method="post" action="">
			Username: <input type="text" name="user_name" />
			Password: <input type="password" name="user_pass">
			<input type="submit" value="Sign in" />
		</form> or <a href="signup.php">sign up</a>';
		}
		else
		{
			$errors = array(); /* declare the array for later use */
			
			if(!isset($_POST['user_name']))
			{
				$errors[] = 'The username field must not be empty.';
			}
			
			if(!isset($_POST['user_pass']))
			{
				$errors[] = 'The password field must not be empty.';
			}
			
			if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
			{
				echo 'Uh-oh.. a couple of fields are not filled in correctly..';
				echo '<ul>';
				foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
				{
					echo '<li>' . $value . '</li>'; /* this generates a nice error list */
				}
				echo '</ul>';	
			}
			else
			{
				$sql = $connection->prepare("
					SELECT
						user_id,
						user_name,
						is_admin
					FROM
						users
					WHERE
						user_name = :user_name
					AND
						user_pass = :user_pass");
				
				$sql->bindParam(':user_name', $_POST['user_name']);
				$sql->bindParam(':user_pass', sha1($_POST['user_pass']));
				
				$sql->execute();
				
				if(!$sql->execute())
				{
					echo 'Something went wrong while signing in. Please try again later! :(';
				}
				else
				{
					
						$_SESSION['signed_in'] = true;
						
						while($row = $sql->fetch(PDO::FETCH_ASSOC))
						{
							$_SESSION['user_id']	= $row['user_id'];
							$_SESSION['user_name']	= $row['user_name'];
							$_SESSION['is_admin']	= $row['is_admin'];
						}
						
						echo 'Welcome, ' . $_SESSION['user_name'] . '. <a href="index.php">Proceed to the forum overview</a>?.';
				}
			}
		}
	}
}
else
{
	
	echo 'Hello ' . $_SESSION['user_name'] . '. Not you? <a href="signout.php">Sign out</a>.';
	echo '<br> <a href="plant.php">Plant a tree</a>?';
	echo '<br> <a href="team.php">Create a team</a>?';	
	
}
?></div>
<div id="content">
