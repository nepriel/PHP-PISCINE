<?php
require_once('db.php');
session_start();
//$res = mysqli_query($mysqli, "SELECT COUNT(1) FROM categories");
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
                            <p><?php if (isset($_COOKIE['basket']))
                            $basket_array = unserialize($_COOKIE['basket']);
                            foreach ($basket_array as $index => $elem)
                            {
                                if (!empty($index) && !empty($elem) && $elem != "true")
                                {
                                echo "You have $elem $index in basket<br class='littlebr'/>";
                                $count_check = 1;
                                }
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
                        ?>
                    <h2>CONNECT TO WEBSITE</h2>
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
                    <img src="ressources/man.png" alt="manshoe" class="images"/>
                    <div class="basketcount">
                    <br/>
                    <form id="addtobasket" action='addtobasket.php' method='get'>
                    PUT MAN SHOE IN BASKET
                    <input id="basketmanshoe" type="number" name="manshoe" value="0">
                    <button type='submit' name="basketmanshoe" value="true">go</button>
                    </div>
                    <img src="ressources/lady.png" alt="ladyshoe" class="images"/>
                    <div class="basketcount">
                    <br/>
                    <form id="addtobasket" action='addtobasket.php' method='get'>
                    PUT LADY SHOE IN BASKET
                    <input id="basketladyshoe" type="number" name="ladyshoe" value="0">
                    <button type='submit' name="baskeladyshoe" value="true">yes</button>
                    </div>
                    <img src="ressources/kid.png" alt="kidshoe" class="images"/>
                    <div class="basketcount">
                    <br/>
                    <form id="addtobasket" action='addtobasket.php' method='get'>
                    PUT KID SHOE IN BASKET
                    <input id="basketkidshoe" type="number" name="kidshoe" value="0">
                    <button type='submit' name="basketkidshoe" value="true">why not</button>
                    </form>
                    </div>
                    </div>
                    <?php
                    }
                    ?>
            </div>
    </body>
</html>