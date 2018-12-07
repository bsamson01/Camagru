<?php
    $host = "localhost";
    $user = "root";
    $pass = "123456";
    $db = "Camagru";
    try
     {
         $con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $user_table = "CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            userid VARCHAR(30) NOT NULL,
            fullname VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            pwd VARCHAR(2000) NOT NULL,
            noti BOOLEAN,
            conf BOOLEAN,
            code INT(6) UNSIGNED NOT NULL,
            reg_date TIMESTAMP
            )";
            $con->exec($user_table);
            echo "users table created successfully";


            $img_table = "CREATE TABLE images (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            userid VARCHAR(30) NOT NULL,
            email VARCHAR(100) NOT NULL,
            img_title TEXT,
            img_base64 LONGTEXT NOT NULL,
            comments TEXT,
            likes INT(6) UNSIGNED,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $con->exec($img_table);
            echo "image table created successfully";
     }
     catch (PDOException $e)
     {
         echo "error creating table".$e->getMessage();
     }
     $con = null;
?>