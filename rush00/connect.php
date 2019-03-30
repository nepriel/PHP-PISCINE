<?php
require_once('db.php');
require_once('session.php');
session_start();

if (isset($_POST['mail']) && isset($_POST['passwd']))
{
	$res = mysqli_query($db, "SELECT * FROM users WHERE mail = '{$_POST['mail']}';");
	$user = mysqli_fetch_assoc($res);
	if (hash('whirlpool', $_POST['passwd'] . 'salt') == $user['password'])
	{
		session_log_user($user['id'], $user['first_name'], $user['last_name'], $user['mail'], $user['admin']);
		header("Location: index.php");
	}
	else exit("ERROR\n");
}
else exit("ERROR\n");

?>