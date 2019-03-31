<?php
require_once('db.php');
session_start();
include('basket.php');

if (isset($_GET['cancel']) && $_GET['cancel'] == 'cancel')
{
    setcookie("basket", NULL, 10);
}

if (empty($_GET['category']))
    $products = mysqli_fetch_all(mysqli_query($db, "SELECT * FROM products"), MYSQLI_ASSOC);
else  
    $products = mysqli_fetch_all(mysqli_query($db, "SELECT * FROM products WHERE category = '{$_GET['category']}'"), MYSQLI_ASSOC);
?>

<html>
    <head>
        <title>chaussure</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .logo{
                display: block;
                width: 200px;
                margin-left: auto;
                margin-right: auto;
            }

            .milieu{
                display: block;
                width: 920px;
                height: 200vh;
                margin-top: 0px;
                margin-left: auto;
                margin-right: auto;
                background-color: #AFAFAF;
                padding-top: 1vh;

            }
            body{
                padding: 0px;
                background-color: #616161;
                font-family: Tahoma, Geneva, Kalimati, sans-serif;
            }
            .menu{
                position: absolute;
                width: 920px;
                /*display: block;*/
                /*background-color: #778899;*/
                text-align: center;
                display: flex;
                align-items: center;
            }

            .menuelement{
                position: relative;
                display: block;
                margin: auto;
                width: 250px;
                height: 120px;
                display: inline-block;
                background-color: #D3D3D3;
                text-decoration: none;
            }
            
            a {
                text-decoration: none;
            }

            h2{
                clear: both;
                margin-top: 40px;
                color: white;
            }
           .basket{
                margin: 0;
            }
            .littlebr{
                margin:5px 0;
            }
            
            p{
                color: #616161;
            }
            
            .input{
                position: absolute;
                width: 920px;
                margin-top: 170px;
                text-align: center;
                display: flex;
                align-items: center;
            }

            .listitem{
                position: absolute;
                width: 920px;
                margin-top: 170px;
                text-align: center;
                display: flex;
                align-items: center;
                flex-direction: column;
            }

            .images{
                position: relative;
                width: 35vw;
                max-width: 600px;
                margin: auto;
                margin-top: 50px;
                border: solid;
                background-color: #767676;
            }

            .images:hover{
                background-color: #4A4A4A;
                border: solid white;
            }

            .basketcount{
                position: relative;
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

            input[type="number"] {
                width:50px;
            }   

            .tata{
                background-color: white;
                display: inline-block;
                width: 600px;
                margin: auto;
                padding-top: 15px;
                padding-bottom: 15px;
                /*height: 3em;*/
                border-bottom: 4px solid #4A4A4A; 

            }
            .first{
                background-color: #767676; 
                padding-bottom: 40px;
            }
            .last{
                padding-bottom: 5px;
            }
            </style>
 </head>
    <body>
            <div class="milieu">
                    <img src="ressources/chaussures-running.png" alt="logo" class="logo"/>
                    <br>
                    <div class=menu>
                        <div class=menuelement>
                            <form id="catego" action="index.php"><input type="hidden" name="a_recup" value="categories"/></form>
                            <a href="#" onclick='document.getElementById("catego").submit()'><h2>Categories</h2></a>
                        </div>
                        <div class=menuelement>
                            <form id="connection" action="index.php"><input type="hidden" name="a_recup" value="connect"/></form>
                            <a href="#" onclick='document.getElementById("connection").submit()'><h2>Connect</h2></a>
                            <p><?php if (isset($_SESSION['first_name'])) echo $_SESSION['first_name']; ?></p>
                        </div>
                        <div class=menuelement>
                            <form id="panier" action="index.php"><input type="hidden" name="a_recup" value="basket"/></form>
                            <a href="#" onclick='document.getElementById("panier").submit()'><h2 class=basket>Basket</h2></a>
                            <p><?php if (isset($_COOKIE['basket']) && !(isset($_GET['cancel'])))
                            {
                            $basket_array = unserialize($_COOKIE['basket']);
                            //print_r($basket_array);
                            $i = 1;
                            foreach ($basket_array as $index => $yolo)
                            {
                            if ($yolo > 0 && $i++ < 3)
                            {
                              //$tmpid = $yolo[0];
                              $res = mysqli_query($db, "SELECT name FROM `products` WHERE id={$index}");
                              $name = mysqli_fetch_array($res);
                              echo $yolo," ", $name['name'], " in basket <br/>";
                            }
                            else if ($yolo > 0 && $i >= 3)
                                {
                                    echo "...";
                                    break;
                                }
                            }
                            /*foreach ($basket_array as $index => $elem)
                            {
                                if (!empty($index) && !empty($elem) && $elem != "true")
                                {
                                echo "You have $elem $index in basket<br class='littlebr'/>";s
                                $count_check = 1;
                                }
                            }*/
                          }
                            ?></p>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['a_recup']) && $_GET['a_recup'] == "connect")
                    {
                        ?>
                    <div class='input'>
                    <div class='Connection'>
                    <p>
                    <?php
                    if (!(isset($_SESSION['id'])))
                    {
                        ?><?php
                    if (isset($_GET['maman']))
                    {
                    ?>
                    <h2>YOU MUST CONNECT TO ORDER SOMETHING</h2>
                    <?php
                    }
                    else
                    {?>
                    <h2>CONNECT TO WEBSITE</h2>
                    <?php
                    }
                    ?>
                    <form method="post" action="connect.php">
                        Mail<br/>
                        <input type="text" name="mail" value="" /><br/>
                        Password<br/>
                        <input type="password" name="passwd" value ="" /><br/>
                        <input type="submit" name="submit" value="connect">
                    </form>
                    <h2>CREATE ACCOUNT</h2>
                    <form method="post" action="create.php">
                        FIRST NAME<br/>
                        <input type="text" name="firstname" value="" /><br/>
                        LAST NAME<br/>
                        <input type="text" name="lastname" value="" /><br/>
                        MAIL<br/>
                        <input type="text" name="mail" value="" /><br/>
                        PASSWORD<br/>
                        <input type="text" name="passwd" value ="" /><br/>
                        <input type="submit" name="submit" value="connect">
                    </form> 
                    <form id='connection' action='index.php' method='get'>
                    <button type='submit' name='a_recup' value='quit'>return to homepage</button>
                    </p>
                    </div>
                    </div>
                    <?php
										}
										else
										{ ?>
										<a href="logout.php">Se deconnecter</a>
                                        <form id='connection' action='index.php' method='get'>
                                        <button type='submit' name='a_recup' value='quit'>return to homepage</button>
										<?php }
                }
                ?>
                    <?php
                    if (isset($_GET['a_recup']) && $_GET['a_recup'] == "basket")
                    {
                        ?>
                    <div class='input'>
                    <div class='Connection'>
                      <?php
                      print_basket();
                      ?>
                     <!-- <form id="checkout" action="checkout.php" method="get">
                          <button type='submit' name='checkout' value='send'>checkout</button>
                    </form>-->
                    <p>
                    <form id='connection' action='index.php' method='get'>
                    <button type='submit' name='a_recup' value='quit'>return to homepage</button>
                    </p>
                    </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_GET['a_recup']) && $_GET['a_recup'] == "categories")
                    {
                        ?>
                    <div class='input'>
                    <div class='Connection'>
                    <p>
                    <form id='connection' action='index.php' method='get'>
                    <button type='submit' name='a_recup' value='quit'>return to homepage</button>
                    </p>
                    </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?PHP
                    if (isset($_GET['a_recup']) && $_GET['a_recup'] == "quit" || !(isset($_GET['a_recup'])))
                    {
                        ?>
                    <div class="listitem">
                      <?php foreach ($products as $product) { ?> 
                        <div class="basketcount">
                          <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="images" />
                          <br/>
                          <form id="addtobasket_<?= $product['id'] ?>" action='addtobasket.php' method='get'>
                              <?= strtoupper($product['name']); ?>
                              <!-- <input type="hidden" name="product_id" min="0" value="<?= $product['id'] ?>" value="0"> -->
                              <input type="number" name="<?= "product_" . $product['id'] ?>" min="0" value="0">
                              <input type="submit" name="basket_submit" value="Mettre dans le panier">
                        </div>
                      <?php } ?>
                                  </form>
                  </div>
                      <!--
                      <div class="basketcount">
                          <img src="ressources/man.png" alt="manshoe" class="images" />
                          <br/>
                          <form id="addtobasket" action='addtobasket.php' method='get'>
                              PUT MAN SHOE IN BASKET
                              <input id="basketmanshoe" type="number" min="0" name="manshoe" value="0">
                              <button type='submit' name="basketmanshoe" value="true">go</button>
                      </div>
                      <div class="basketcount">
                          <img src="ressources/lady.png" alt="ladyshoe" class="images" />
                          <br/>
                          <form id="addtobasket" action='addtobasket.php' method='get'>
                              PUT LADY SHOE IN BASKET
                              <input id="basketladyshoe" type="number" min="0" name="ladyshoe" value="0">
                              <button type='submit' name="baskeladyshoe" value="true">yes</button>
                      </div>
                      <div class="basketcount">
                          <img src="ressources/kid.png" alt="kidshoe" class="images" />
                          <br/>
                          <form id="addtobasket" action='addtobasket.php' method='get'>
                              PUT KID SHOE IN BASKET
                              <input id="basketkidshoe" type="number" min="0" name="kidshoe" value="0">
                              <button type='submit' name="basketkidshoe" value="true">why not</button>
                          </form>
                      </div>
                      -->
                  <?php
                  }
                  ?>
            </div>
    </body>
</html>