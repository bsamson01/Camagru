<?php
    $reg = $_GET['reg_date'];
    try
    {
        session_start();
        $usr = $_SESSION['login'];
        $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = "DELETE FROM images WHERE reg_date='$reg'";
        $pdo->exec($stmt);
        echo "Image successfully deleted";
        header('refresh:3; url="../html/home.phtml"');
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
?>