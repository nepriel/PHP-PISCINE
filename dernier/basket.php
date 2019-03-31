<?php
require_once('db.php');

function print_basket()
{
  include('db.php');
if (isset($_COOKIE['basket']))
{
  $basket_array = unserialize($_COOKIE['basket']);
  //echo "<pre>";
  //print_r ($basket_array);
  //echo "</pre>";
  $bigtotal = 0;
  echo "<div class='tata first'></div>";
  foreach ($basket_array as $index => $yolo)
  {
    if ($yolo > 0)
    {
      //$tmpid = $yolo[0];
      $test = mysqli_query($db, "SELECT name FROM `products` WHERE id={$index}");
      $name = mysqli_fetch_array($test);
      $test = mysqli_query($db, "SELECT price FROM `products` WHERE id={$index}");
      $price =mysqli_fetch_array($test);
      $one_price = $price['price'];
      $price_total = $one_price * $yolo;
      $bigtotal = $price_total + $bigtotal;
      echo "<div class='tata'>", $yolo," ", $name['name'], " in basket = ", $price_total, "€ (", $one_price, "€ each)</div>";
    }
  }
  echo "<div class='tata'> TOTAL = ", $bigtotal, "€</div><div class='tata first last'><form id='cancel' action='index.php' method='get'><button type='submit' name='cancel' value='cancel'>cancel</button></form><form id='checkout' action='checkout.php' method='get'><button type='submit' name='checkout' value='send'>checkout</button></form></div>";
}
else
echo "<p> empty basket </p>";
}

function checkout()
{
  if (is_connect())
  {
    //query + update panier
    //query
  }
  else
  header('Location: error_connect_checkout.php');
}
?>
