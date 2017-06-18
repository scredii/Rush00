<?php
session_start();
include("auth.php");
if ($_POST['submit'] == "OK" && $_SESSION['panier']['logged_on_user'] != "")
{
    $i = 0;
    $total = 0;
    while($_SESSION['panier'][$i])
    {
        $id_art .= $_SESSION['panier'][$i]['id'];
        $total += $_SESSION['panier'][$i]['prix'];
        $i++;
    }
    $username = $_SESSION['panier']['logged_on_user']['login'];
    if (empty($_SESSION['panier'][0]))
        exit("Votre panier est vide");
    if (auth($_SESSION['panier']['logged_on_user']['login'], $_SESSION['panier']['logged_on_user']['pwd']) == TRUE)
    {
        $db = connect_sql();
        $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO commandes (username, id_produit, prix) VALUE (?, ?, ?)')) 
        {
            mysqli_stmt_bind_param($stmt, "ssd", $username, $id_art, $total);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "Commande validee ;) \n";
        }
        else
            echo "Error connecting database: " . mysqli_error($db);
    }
}
else
    echo "Veuillez vous connecter pour commander\n";
?>