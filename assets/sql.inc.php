<?
	global $username, $password, $database, $link;

	$username = 'root';
	$password = 'root';
	$database = 'grammys';

	$link = new mysqli('localhost', $username, $password, $database);
?>