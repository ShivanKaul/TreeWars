<?php 

$pword = fopen("pword.txt", "r") or die("Unable to open file!");

$server = 'localhost';
$username = 'teamtreewars';
$password = fread($pword,filesize("pword.txt"));
$database = 'treewars';

fclose($pword);

try {
		$connection = new PDO("mysql:host=$server;dbname=$database", $username, $password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
	}
	catch(PDOException $e)
	{
		echo "Error!" . $e->getMessage();
	}
	?>