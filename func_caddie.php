<?php 
include ("auth.php");

function ajout($select) 
{ 
            $ajout = false;  
            $db = connect_sql();
            $id = $select['id'];
            $db = mysqli_query($db, "SELECT * FROM article WHERE id = '$id'");
            $data = mysqli_fetch_array($db, MYSQLI_ASSOC);
            array_push($_SESSION['panier'], $data);
            $ajout = true;
} 