<?php
session_start();
include_once("func_caddie.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="index.css">
        <title>World of Wallet</title>
    </head>
    <body>
        <header class="h_main">
                <ul class="menu">
                <?php if ($_SESSION['panier']['logged_on_user'] != ""): ?>
                    <li>
                        <a class="yolo" href="#">Parameters</a>
                        <ul>
                            <li><a href="logout.php">Log Out</a></li>
                            <li><a href="delete.php">Remove account</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION['panier']['logged_on_user'] == ""): ?>
                    <li>
                        <a href="#">Account</a>
                        <ul class="account">
                            <form method="post" action="login.php" >
                                Login: <input type="text" name="login" value="" />
                                <br />
                                Password <input type="password" name="password" value="" />
                                <br />
                                <input type="submit" name="submit" value="OK" />
                            </form>
                        </ul>
                </li>
                <?php endif; ?>
                <?php if ($_SESSION['panier']['logged_on_user'] == ""){
                   echo "<span id='test1'> <li><a class='test' href='create_account.html'>Create account</li></span>";}
                 ?>
                <li><a class="yolo" href="panier.php">panier</a></li>
            </ul>
        </header>
<div class="cat">
<p>Categories</p>
<a href="ts.php">tee-shirt</a>
<a href="other.php">other</a>
<a href="index.php">all</a>
</div>
<?php
    $db = connect_sql();
    $db = mysqli_query($db, 'SELECT * FROM article WHERE categorie = "t-shirt"');
    if (!$db)
    {
        echo "Error";
    }
    $i = 1;
    if ($_SESSION['panier'] == NULL)
        $_SESSION['panier'] = array();
    while ($data = mysqli_fetch_array($db, MYSQLI_ASSOC))
    {
            echo '
        <div class="col33">
        <div = class="article">
        <h1>'.$data['name'].'</h1><br>
        <img src="./img/'.$i.'.jpg" /><br>
        <span>'.$data['prix'].' $</span><br>
        <button>
        <a href="panier.php?action=1&amp;id='.$data['id'].'">Ajouter au panier</a>
        </button>
        </div>
        </div>
        ';
        $i++;
    }
?>        
    </body>
</html>