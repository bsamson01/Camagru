<?php
    session_start();
    $usr = $_SESSION['login'];
    if (trim($_POST['sub'] === "yes") || trim($_POST['sub'] === "no"))
    {
        try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->query('SELECT * FROM users');
            while ($row = $stmt->fetch())
            {
                if ($row['userid'] === $usr)
                {
                    if(trim($_POST['sub']) === "yes")
                    {
                        $sql = "UPDATE users SET noti=true WHERE userid='$usr'";
                        $na = $pdo->prepare($sql);
                        $na->execute();
                    }
                    else
                    {
                        $sql = "UPDATE users SET noti=false WHERE userid='$usr'";
                        $na = $pdo->prepare($sql);
                        $na->execute();
                    }
                }
            }
            echo "Notification configuration succesfully changed";
            header('refresh:3; url="../html/settings.phtml"');
        }
        catch(PDOException $e)
        {
            echo $pdo . "<br>" . $e->getMessage();
        }
    }
    else
    {
        echo "Only type in yes or no for notification configuration settings. You will be redirected in 3seconds";
        header('refresh:3; url="../html/settings.phtml"');
    }
?>