<?php
     $host = "localhost";
     $user = "root";
     $pass = "123456";
     $db = "Camagru";
     try
     {
        $con = new PDO("mysql:host=$host", $user, $pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         echo "connected to localhost <br/>";
     }
     catch (PDOException $e)
     {
         echo "error ".$e->getMessage();
     }
     try
     {
        $sql = "CREATE DATABASE ".$db;
        $con->exec($sql);
        echo "Camagru Database created <br/>";
     }
     catch (PDOException $e)
     {
         echo "failed to create database ".$e->getMessage();
     }
     
?>