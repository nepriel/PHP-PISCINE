<?php
require_once('db.php');

if (isset($_GET))
{
    if (!(empty($_GET['manshoe'])) || !(empty($_GET['ladyshoe'])) || !(empty($_GET['kidshoe'])))
    {
        $array = $_GET;
        /*$res = mysqli_query($db, "SELECT * FROM `products` WHERE name='{$index}'");
        $stock = mysqli_fetch_assoc($res);*/
        if (isset($_COOKIE['basket']))
        {
            $newarray = unserialize($_COOKIE['basket']);
            //print_r($newarray);
            print_r($_GET);
            foreach ($_GET as $index=>$elem)
            {
                if (intval($elem) > 0)
                    $newarray[$index] = $newarray[$index] + intval($elem);
            }
            setcookie('basket', serialize($newarray), time() + 86400);
            header("Location: index.php");
        }
        else
        {
            $newarray = serialize($array);
            //echo $newarray;
            setcookie('basket', $newarray, time() + 86400);
            header("Location: index.php");
        }
        //else
        //echo "we are very sorry but our stock of shoes is running low please try a lower amount.\n";
    }
    else
    echo "emptyvalue\n";
}
else
{
    echo "error\n";
}

?>