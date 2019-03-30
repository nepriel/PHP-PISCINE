<?php
require_once('db.php');
session_start();

function session_log_user($id, $first_name, $last_name, $mail, $admin)
{
	$_SESSION['id'] = $id;
	$_SESSION['first_name'] = $first_name;
	$_SESSION['last_name'] = $last_name;
	$_SESSION['mail'] = $mail;
	$_SESSION['admin'] = $admin;
}

if (isset($_POST['mail']) && isset($_POST['passwd']))
{
	$res = mysqli_query($db, "SELECT * FROM users WHERE mail = '{$_POST['mail']}';");
	$user = mysqli_fetch_assoc($res);
	echo "<pre>", print_r($user), "</pre>";
	session_log_user($user['id'], $user['first_name'], $user['last_name'], $user['mail'], $user['admin']);
	header("Location: http://{$_SERVER['HTTP_HOST']}/rush00/index.php");
}
else exit("ERROR par\n");
?>