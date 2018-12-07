<?php
    $usr = $_GET['user'];
    $code = $_GET['code'];

    try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->query('SELECT * FROM users');
            while ($row = $stmt->fetch())
            {
                if ($row['userid'] === $usr && $row['code'] == $code && $row['conf'] == false)
                {
                    $sql = "UPDATE users SET conf=true WHERE userid='$usr'";
                    $pdo->exec($sql);
                    echo "Account succesfully verified. You will be redirected to login screen in 3seconds...";
                    header('refresh:3; url="../index.phtml"');
                    break ;
                }
            }
        }
    catch(PDOException $e)
        {
            echo $pdo . "<br>" . $e->getMessage();
        }
?>