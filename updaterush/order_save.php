<?php
require_once('db.php');
session_start();
$errormessage = "ORDER";

?>

<?php
if (isset($_GET['checkout']) && $_GET['checkout'] == "send")
{
if (is_connect())
{
//query + update panier
if (isset($_COOKIE['basket']))
{
$basket_content = unserialize($_COOKIE['basket']);
print_r($basket_content);
}
else
header('Location: error_empty_checkout.php');
//query
}
else
header('Location: error_connect_checkout.php');
}
?>

<html>

<Head>
  <style>
    .logo {
      display: block;
      width: 200px;
      margin-left: auto;
      margin-right: auto;
    }

    .milieu {
      display: block;
      width: 920px;
      height: 200vh;
      margin-top: 0px;
      margin-left: auto;
      margin-right: auto;
      background-color: #AFAFAF;
      padding-top: 1vh;

    }

    h1{
      color: white;
      text-align: center;
      font-size: 100px;
    }

    body {
      padding: 0px;
      background-color: #616161;
      font-family: Tahoma, Geneva, Kalimati, sans-serif;
    }

.input{
                position: absolute;
                width: 920px;
                margin-top: 50px;
                text-align: center;
                display: flex;
                align-items: center;
            }

    .connection{
                position: relative;
                display: block;
                margin: auto;
                width: 600px;
                height: 600px;
                display: inline-block;
                background-color: #D3D3D3;
            }
  </style>
</Head>

<body>
  <div class=milieu>
    <img src="ressources/chaussures-running.png" alt="logo" class="logo" />
    <div class="input">
    <div class=connection>
    <h1>
      ORDER
    </h1>
      <?PHP
    echo "<p>".$errormessage."</p>"."\n";
    ?>
      <form action="index.php">
        <input type="submit" name="BACK" value="BACK">
      </form>
    </div>
          </div>
  </div>
</body>

</html>