<?php

include 'header.php';

echo '<h3>Sign up</h3>';

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	echo '<html>
<head>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
  <link href="css/signup.css" rel="stylesheet">
</head>
<body>
  <div class="testbox">
    <h1>Registration</h1>

    <form method="post" action="">
      
      <label id="icon" for="name"><i class="icon-envelope "></i></label>
      <input type="text" name="user_email" id="name" placeholder="Email" required/>
      <label id="icon" for="name"><i class="icon-user"></i></label>
      <input type="text" name="user_name" id="name" placeholder="Name" required/>
      <label id="icon" for="name"><i class="icon-shield"></i></label>
      <input type="password" name="user_pass" id="name" placeholder="Password" required/>
      <input type="password" name="user_pass_check" id="name" placeholder="Password again" required/>
        <input type="submit" class="button" value="Register!" />
      
    </form>
  </div>
</body>
</html>';
} else {
	$errors = array();j
	
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
		echo sha1($_POST['user_pass']);
		
	}
	
}

include 'footer.php';

?>