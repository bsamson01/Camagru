<?php
    try
    {
        session_start();
        $usr = $_SESSION['login'];
        $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = ("DELETE FROM images WHERE userid='$usr'");
        $pdo->exec($stmt);
        $stmt = "DELETE FROM users WHERE userid='$usr'";
        $pdo->exec($stmt);
        echo "User Succesfully deleted. You will be redirected in 3seconds";
        session_unset();
        session_destroy();
        header('refresh:3; url="../index.phtml"');
    }
    catch(PDOException $e)
    {
        echo $pdo . "<br>" . $e->getMessage();
    }
?>