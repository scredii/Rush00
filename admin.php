<?php
session_start();
include("auth.php");
 if (isset($_POST['login']) && isset($_POST['password']) && $_POST['submit'] == "OK")
 {
    $login = $_POST['login'];
    $pwd = hash('whirlpool', $_POST['password']);
    $db = connect_sql();
    $query_user = mysqli_query($db, "SELECT username FROM `users` WHERE username = '$login'");
    $query_pwd = mysqli_query($db, "SELECT password FROM `users` WHERE password = '$pwd'");
    $query_admin = mysqli_query($db, "SELECT isadmin FROM `users` WHERE username = '$login'");    
    $query_user = mysqli_fetch_assoc($query_user);
    $query_pwd = mysqli_fetch_assoc($query_pwd);
    $query_admin = mysqli_fetch_assoc($query_admin);
    if ($query_user['username'] == $login && $query_pwd['password'] == $pwd && $query_admin['isadmin'] == 1)
    {
        $_SESSION['panier']['logged_on_user'] = array('login' => $login, 'pwd' =>$pwd);
        ?>
        <html>
            <head>
                <link rel="stylesheet" href="index.css">

            <head>
        <body>
            <p>supprimer un user:</p>
             <form action="delete.php" method="POST">
                login: <input type="text" name="login">
                <input type="submit" name="submit" value="OK">
            </form>
            <p>ajouter un user:</p>
             <form action="create_account.php" method="POST">
                E-mail: <input type="mail" name="email"/>
                login: <input type="text" name="login">
                password: <input type="password" name="password">
                <input type="submit" name="submit" value="OK">
            </form>
        <br>
        <br>
            <p>Derniere commandes: </p>
<?php
    $db = mysqli_query($db, "SELECT * FROM `commandes` ");
    while ($query_cmd  = mysqli_fetch_array($db, MYSQLI_ASSOC))
    {
        echo "Login :".$query_cmd['username']."\n";
                ?>
        <br>
        <?php
        echo "article id: " .$query_cmd['id_produit']." ";
        echo "total commande: ".$query_cmd['prix']." $";
        ?>
        <br>
        <br>
        <?php
    }
?>
        </body>
        </html>
<?php
    }
    else
        echo "Vous n'etes pas autorise a acceder a cette page\n";
 }
else
    echo "Vous n'etes pas autorise a acceder a cette page\n";
?>