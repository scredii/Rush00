<?php
    session_start();
    include("auth.php");
    $login = trim($_POST['login']);
    $pwd = hash('whirlpool', $_POST['password']);
    if (auth($login, $pwd))
    {
        $_SESSION['panier']['logged_on_user'] = array('login' => $login, 'pwd' =>$pwd);
        header("Location: index.php");
    }
    else
    {
        $_SESSION['panier']['logged_on_user'] = "";
        echo "ERROR"."\n";
    }
?>