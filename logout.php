<?php
    session_start();
    header("Location: index.php");
    $_SESSION['panier']['logged_on_user'] = "";
    session_destroy();
?>