<?php
include('database.php');
if ($db = mysqli_connect('localhost', $DB_USER, $DB_PASSWORD))
{
    $sql = "CREATE DATABASE rush";
    if (mysqli_query($db, $sql)) 
    {
        echo "Database created successfully\n";
    }
    else
    {
        echo "Error creating database: " . mysqli_error($db);
    }
}
else
{
    echo "Error\n";
}
if ($db = mysqli_connect('localhost', $DB_USER, $DB_PASSWORD, 'rush'))
{
    $sql = "CREATE TABLE users (id INT(16) PRIMARY KEY NOT NULL AUTO_INCREMENT, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, isadmin int(1) DEFAULT 0);" ;
    $sql2 = "CREATE TABLE article (id INT(16) PRIMARY KEY NOT NULL AUTO_INCREMENT, name VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL);" ;
    $sql3 = "CREATE TABLE commandes (id INT(16) PRIMARY KEY NOT NULL AUTO_INCREMENT, username VARCHAR(255) NOT NULL, id_produit VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL);" ;
    if (mysqli_query($db, $sql) && mysqli_query($db, $sql2) && mysqli_query($db, $sql3))
    {
        echo "Table users created successfully";
    } 
    else 
    {
        echo "Error creating table: " . mysqli_error($db);
    }
    $query_user = mysqli_query($db, "SELECT username FROM `users` WHERE username = '$DB_USER'");
    $query_user = mysqli_fetch_assoc($query_user);
    if ($query_user['username'] == $DB_USER)
    {
        echo ("Admin already created\n");
    }
    else
    {   
         $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO users (username, email, password, isadmin) VALUE (?, ?, ?, ?)')) 
    {
        mysqli_stmt_bind_param($stmt, "sssd", $DB_USER, $email, $pwd, $isadmin);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "Admin Created\n";
    }
    else
        echo "Ajout a la DB impossible\n";
    }
    $query_art = mysqli_query($db, "SELECT * FROM `article`");
    $query_art = mysqli_fetch_assoc($query_art);
    if (!empty($query_art))
    {
        exit ("Table already created\n");
    }
    else
        {
        $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO article (name, categorie, prix) VALUE (?, ?, ?)')) 
        {
            mysqli_stmt_bind_param($stmt, "ssd", $name1, $ts, $prix3);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "article Created\n";
        }
        else
            echo "Error connecting database: " . mysqli_error($db);
        $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO article (name, categorie, prix) VALUE (?, ?, ?)')) 
        {
            mysqli_stmt_bind_param($stmt, "ssd", $name2, $other, $prix1);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "Article Created\n";
        }
        $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO article (name, categorie, prix) VALUE (?, ?, ?)')) 
        {
            mysqli_stmt_bind_param($stmt, "ssd", $name3, $other, $prix4);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "Article Created\n";
        }
        $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO article (name, categorie, prix) VALUE (?, ?, ?)')) 
        {
            mysqli_stmt_bind_param($stmt, "ssd", $name4, $other, $prix5);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "Article Created\n";
        }
        $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO article (name, categorie, prix) VALUE (?, ?, ?)')) 
        {
            mysqli_stmt_bind_param($stmt, "ssd", $name5, $other, $prix5);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "Article Created\n";
        }
        $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO article (name, categorie, prix) VALUE (?, ?, ?)')) 
        {
            mysqli_stmt_bind_param($stmt, "ssd", $name6, $ts, $prix3);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "Article Created\n";
        }
        $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO article (name, categorie, prix) VALUE (?, ?, ?)')) 
        {
            mysqli_stmt_bind_param($stmt, "ssd", $name7, $ts, $prix3);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "Article Created\n";
        }
        $stmt = mysqli_stmt_init($db);
        if (mysqli_stmt_prepare($stmt, 'INSERT INTO article (name, categorie, prix) VALUE (?, ?, ?)')) 
        {
            mysqli_stmt_bind_param($stmt, "ssd", $name8, $ts, $prix4);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($db);
            echo "Article Created\n";
        }
    }
}
else
{
    echo "Error connecting database: " . mysqli_error($db);
}
?>