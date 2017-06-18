<?php
    session_start();
    include('func_caddie.php');
    if ($_GET['l'])
    {
        array_pop($_SESSION['panier']);
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="index.css">
        <title> Votre Panier </title>
    <body>
        <table style="width: 400px">
            <tr>
                <td colspan="4">Votre Panier</td>
            </tr>
            <tr>
                <td>Produit</td>
                <td>Prix</td>
                <td>action</td>
            </tr>
<?php
    if ($_GET['action'] == 1)
        ajout($_GET);
    $i = 0;
    $total = 0;
    while ($_SESSION['panier'][$i])
    {
        echo "<tr>";
        echo "<td>".$_SESSION['panier'][$i]['name']."</td>";
        echo "<td>".$_SESSION['panier'][$i]['prix']."</td>";
        if (!$_SESSION['panier'][$i + 1])
            echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier'][$i]['id']))."\">Remove</a></td>";
        else
            echo "<td></td>";
        echo "</tr>";
        $total +=  $_SESSION['panier'][$i]['prix'];
        $i++;
    }
?>
    </table>
        <form action="validate.php" method="POST">
            <p> Total de la commande: <?php echo $total."$" ?> </p>
    <input type="submit" name="submit" value="OK">
            </form>
    </body>
</html>