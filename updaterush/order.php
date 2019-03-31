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
      foreach ($stock_content as $stock_content_index => $stock_subarray)
      {
        foreach ($stock_subarray as $index => $elem)
        {
          foreach ($basket_content as $key => $value) 
          {
            if (intval($value) > 0 && $key == $elem)
            {
              if (intval($stock_subarray['stock']) >= intval($value))
              {
              /* CONDITIONS D ACHAT RASSEMBLEES -> ON VIDE LE PANIER
                                                -> ON UPDATE LE STOCK
                                                -> ON envoit les infos pour la page de commande
                                                */
              $basket_content[$key] = 0;
              $stock_subarray['stock'] == $stock_subarray['stock']) - intval($value);
              
              }
              else
              header('Location: error.php');
            }
            else
            header('Location: error.php');
          }
        }
      }
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