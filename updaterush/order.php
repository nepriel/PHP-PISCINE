<?php
require_once('db.php');
session_start();
$errormessage = "ORDER";

function is_connect()
{
  if (!empty($_SESSION['id']))
  return (1);
  else
  return (0);
}

if (isset($_GET['checkout']) && $_GET['checkout'] == "send")
{
  if (is_connect())
  {
    //query + update panier
    if (!empty($_COOKIE['basket']))
    {
      $basket_content = unserialize($_COOKIE['basket']);
      /* a supprimer */
      foreach ($basket_content as $index => $elem){
        if ($index == "manshoe")
        {
          $basket_content['Adidas Sport'] = $basket_content[$index];
          unset($basket_content[$index]);
        }
        else if($index == "ladyshoe")
        {
          $basket_content['Ballerines'] = $basket_content[$index];
          unset($basket_content[$index]);
        }
        else if ($index == "kidshoe")
        {
          $basket_content['Adidas lumineuses'] = $basket_content[$index];
          unset($basket_content[$index]); 
        }
      }
      /* END a supprimer */
      echo "in basket: \n";
      print_r($basket_content);
      echo "in stock: \n";
      $res = mysqli_query($db, "SELECT * FROM `products`");
      $stock_content = mysqli_fetch_all($res, MYSQL_ASSOC);
      echo "<pre>", print_r($stock_content), "</pre>";
      //print_r ($stock_content);

    }
    else
    {
      header('Location: error_empty_checkout.php');
    }
      //query
  }
  else
  {
    header('Location: error_connect_checkout.php');
  }
}
?>