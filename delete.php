<?php
session_start();
include("auth.php");

if (auth_admin($_SESSION['panier']['logged_on_user']['login'], $_SESSION['panier']['logged_on_user']['pwd']) == TRUE)
{
        $login = $_POST['login'];
        $db = connect_sql();
        $query_user = mysqli_query($db, "SELECT username FROM `users` WHERE username = '$login'");
        $query_admin = mysqli_query($db, "SELECT isadmin FROM `users` WHERE username = '$login'");    
        $query_user = mysqli_fetch_assoc($query_user);
        $query_admin = mysqli_fetch_assoc($query_admin);
        if ($query_user['username'] == $login && $query_admin['isadmin'] == 0)
        {
            $stmt = $db->prepare("DELETE FROM users WHERE username = ?");
            $stmt->bind_param('s', $login);
            $stmt->execute(); 
            $stmt->close();
            echo "user deleted";
        }
        else
            echo "impossible de supprimer le user";
}
elseif(auth($_SESSION['panier']['logged_on_user']['login'], $_SESSION['panier']['logged_on_user']['pwd']) == TRUE)
{
        $login = $_SESSION['panier']['logged_on_user']['login'];
        $db = connect_sql();
        $stmt = $db->prepare("DELETE FROM users WHERE username = ?");
        $stmt->bind_param('s', $login);
        $stmt->execute(); 
        $stmt->close();
        echo "user deleted";
        delog();
}
else
    echo "ERROR";
?>