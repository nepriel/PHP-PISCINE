<?PHP
require_once("db.php");
require_once("session.php");
session_start();

if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["mail"]) && isset($_POST["passwd"]))
{
    $mymail = $_POST['mail'];
    $myfname = $_POST['firstname']; 
    $mylname = $_POST['lastname'];
    $mypasswd = hash('whirlpool', $_POST['passwd'] . 'salt');
		$res = mysqli_query($db, "SELECT * FROM `users` WHERE mail = '$mymail'");
    $tab = mysqli_fetch_all($res);
    if (empty($tab))
    {
        $res = mysqli_query($db, "INSERT INTO `users` (`first_name`, `last_name`, `mail`, `password`, `admin`) VALUES ('{$myfname}', '$mylname', '$mymail', '$mypasswd', '0')");
        var_dump($res);
        $res = mysqli_query($db, "SELECT id, admin FROM `users` WHERE mail='{$mymail}'");
        $tab = mysqli_fetch_assoc($res);
        var_dump($tab);
        session_log_user($tab['id'], $myfname, $mylname, $mymail, $tab['admin']);
        header('Location: index.php');
    }
    else
    echo "error1\n";
}
else
echo "error2\n";

?>