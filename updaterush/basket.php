<?php
require_once('db.php');
session_start();

function print_basket()
{
if (isset($_COOKIE['basket']))
{
  $content = unserialize($_COOKIE['basket']);
  echo "<p>";
  foreach ($content as $index=>$elem)
  {
    if (!empty($index) && !empty($elem) && $elem != "true")
    {
    echo "$index -----> $elem <br/>";
    }
  }
  echo "</p>";
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