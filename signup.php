<?php

include 'header.php';

echo '<h3>Sign up</h3>';

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	echo '<form method="post" action="">
        Username: <input type="text" name="user_name" />
        Password: <input type="password" name="user_pass">
        Password again: <input type="password" name="user_pass_check">
        E-mail: <input type="email" name="user_email">
        <input type="submit" value="Register!" />
     </form>';
} else {
	$errors = array();
	
	if(isset($_POST['user_name']))
	{
		if(!ctype_alpha($_POST['user_name']))
		{
			$errors[] = 'Username may only contain letters! :(';
		}
		if(strlen($_POST['user_name']) > 20)
		{
			$errors[] = 'Username may not be longer than 20 characters! :(';
		}
	}else{
		$errors[] = 'You forgot to choose a nickname! :]';
	}
	
	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors[] = 'The two passwords didn\'t match! :O';
		}
	} else {
		$errors[] = 'You forgot to type a password! :]';
	}
	
	if(!empty($errors))
	{
		echo 'Yikes! Some fields aren\'t filled in properly. :/';
		echo '<ul>';
		foreach($errors as $key => $value)
		{
			echo '<li>' . $value . '</li>';
		}
		echo '</ul>';
	} else {
		
			
		$sql = $connection->prepare
		("
			INSERT INTO
				users(user_name, user_pass, user_email, user_date, is_admin)
			VALUES
				(:user_name, :user_pass, :user_email, NOW(), 0)
		");
				
		$sql->bindParam(':user_name', $_POST['user_name']);
		$sql->bindParam(':user_pass', sha1($_POST['user_pass']));
		$sql->bindParam(':user_email', $_POST['user_email']);
		
		$sql->execute();
		
		echo 'Registration successful! :D';
		
	}
	
}

include 'footer.php';

?>