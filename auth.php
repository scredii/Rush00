<?php
function connect_sql()
{
    if ($db = mysqli_connect('localhost', $DB_USER, $DB_PASSWORD, 'rush'))
    {
        return ($db);
    }
    else
    {
        echo "Error connecting database: " . mysqli_error($db);
    }
}

function auth($login, $pwd)
{
    $db = connect_sql();
    $query_user = mysqli_query($db, "SELECT username FROM `users` WHERE username = '$login'");
    $query_pwd = mysqli_query($db, "SELECT password FROM `users` WHERE password = '$pwd'");
    $query_user = mysqli_fetch_assoc($query_user);
    $query_pwd = mysqli_fetch_assoc($query_pwd);
    if ($query_user['username'] == $login && $query_pwd['password'] == $pwd)
       return (TRUE);
    else
        return (FALSE);
}

function auth_admin($login, $pwd)
{
    $db = connect_sql();
    $query_user = mysqli_query($db, "SELECT username FROM `users` WHERE username = '$login'");
    $query_pwd = mysqli_query($db, "SELECT password FROM `users` WHERE password = '$pwd'");
    $query_admin = mysqli_query($db, "SELECT isadmin FROM `users` WHERE username = '$login'");    
    $query_admin = mysqli_fetch_assoc($query_admin);
    $query_user = mysqli_fetch_assoc($query_user);
    $query_pwd = mysqli_fetch_assoc($query_pwd);
    if ($query_user['username'] == $login && $query_pwd['password'] == $pwd && $query_admin['isadmin'] == 1)
       return (TRUE);
    else
        return (FALSE);
}

function delog()
{
    session_start();
    $_SESSION['panier']['logged_on_user'] = "";
    session_destroy();
}
?>