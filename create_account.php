<?php
session_start();
include('auth.php');
if ($_POST['submit'] == "OK")
{
    if(empty(trim($_POST['password'])))
		exit("Vous devez rentrer un mot de passe valide\n");
    $pwd = hash('whirlpool', $_POST['password']);
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    if(empty($login) || !preg_match('/^[a-zA-Z0-9_]+$/', $login))
			exit("votre pseudo n'est pas valide (Alphanumérique)");
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
			exit("Votre email n'est pas valide");
    $db = connect_sql();
    $query_user = mysqli_query($db, "SELECT username FROM `users` WHERE username = '$login'");
    $query_user = mysqli_fetch_assoc($query_user);
    if ($query_user['username'] == $login)
    {
        exit ("Pseudo deja utilise\n");

    }
    $query_mail = mysqli_query($db, "SELECT email FROM `users` WHERE email = '$email'");
    $query_mail = mysqli_fetch_assoc($query_mail);
    if ($query_mail['email'] == $email)
    {
        exit ("Votre email est deja enregistre\n");
    }
    $stmt = mysqli_stmt_init($db);
    if (mysqli_stmt_prepare($stmt, 'INSERT INTO users (username, email, password) VALUE (?, ?, ?)')) 
    {
        mysqli_stmt_bind_param($stmt, "sss", $login, $email, $pwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($db);
        echo "Vous etes bien enregistré.\n";
    }
    else
        echo "Ajout a la DB impossible\n";
        echo "    <a href='index.php'>Retour a l'acceuil</a>";
}
?>
