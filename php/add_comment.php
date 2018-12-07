<?php
    include("checkpassword.php");
    $str = test_input(trim($_POST['com']));
    if (!empty($str))
    {
        session_start();
        $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $usr = $_SESSION['login'];
        $reg = $_POST['hidden_txt'];
        $stmt = $pdo->query('SELECT * FROM images');
        while ($row = $stmt->fetch())
        {
            if ($row['reg_date'] == $reg)
            {
                if (!empty($row['comments']))
                {
                    $com = array();
                    $str = $usr." : ".$_POST['com'];
                    $com = unserialize($row['comments']);
                    array_push($com,$str);
                    $arr = serialize($com);
                }
                else
                {
                    
                    $str = $usr." : ".$_POST['com'];
                    $com = array($str);
                    $arr = serialize($com);
                }
                $sql = "UPDATE images SET comments='$arr' WHERE reg_date='$reg'";
                $nw = $pdo->prepare($sql);
                $nw->execute();
                $link = "http://localhost:8080/Camagru/php/comment.php?reg_date=".str_replace(" ", "%20", $row['reg_date']);
                $ny = $pdo->query("SELECT * FROM users WHERE userid='$usr'");
                $r = $ny->fetch();
                if($r['noti'] == true)
                {
                    $sub = "CAMAGRU_ : Comment Notification123";
                    $body = "User ".$usr." commented on your photo ".$link;
                    $email = $row['email'];
                    mail($email,$sub,$body);
                }
                header('Location: '.$link);
            }
        }
    }
?>