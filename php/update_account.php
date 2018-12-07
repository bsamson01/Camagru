<?php
    $user = 0;
    $pass = 0;
    $mail = 0;
    $full = 0;
    $e = 0;
    include("checkpassword.php");
    function test_full($fuu)
    {
        $tmp = preg_split("/[\s,]+/", $fuu);
        foreach($tmp as $key=>$value)
        {
            if (!ctype_alnum($value))
            {
                return(false);
            }
        }
        return (true);
    }
    $oldpwd = hash('whirlpool', $_POST['oldpwd']);
    if (!empty($_POST['userid']) && ctype_alnum($_POST['userid']))
    {
        $username = test_input($_POST['userid']);
        $user = 1;
    }
    if (!empty($_POST['fullname']) && test_full($_POST['fullname']))
    {
        $fullname = ucwords(test_input($_POST['fullname']));
        $full = 1;
    }
    if (!empty($_POST['email']))
    {
        $email = test_input($_POST['email']);
        $mail = 1;
    }
    if (!empty($_POST['cnpwd']) && !empty($_POST['nwpwd']) && $_POST['cnpwd'] === $_POST['nwpwd'] && ctype_alnum($_POST['nwpwd']))
    {
        $nwpwd = hash('whirlpool', trim($_POST['nwpwd']));
        $cnpwd = hash('whirlpool', trim($_POST['cnpwd']));
        $pass = 1;
    }
        try
        {
            session_start();
            $usr = $_SESSION['login'];
            $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->query("SELECT * FROM users");
            while ($row = $stmt->fetch())
            {
                if ($row['userid'] === $usr && $row['pwd'] === $oldpwd && ($full || $mail || $user || $pass))
                {
                    $e = 1;
                    if ($full == 1)
                    {
                        $sql = "UPDATE users SET fullname='$fullname' WHERE userid='$usr'";
                        $na = $pdo->prepare($sql);
                        $na->execute();
                        echo "Your fullname was succesfully changed</br>";
                    }
                        if ($user == 1 || $pass == 1 || $mail == 1)
                        {
                            $s = $pdo->query("SELECT * FROM users");
                            if ($user == 1)
                            {
                                while($r = $s->fetch())
                                {
                                    if($r['userid'] === $username)
                                    {
                                        echo "Username currently in use";
                                        $user = 0;
                                        break ;
                                    }
                                }
                            }
                            $s = $pdo->query("SELECT * FROM users");
                            if ($mail == 1)
                            {
                                while($r = $s->fetch())
                                {
                                    if ($r['email'] === $email)
                                    {
                                        echo "Email currently in use";
                                        $mail = 0;
                                        break ;
                                    }
                                }
                            }
                            if ($user == 1 || $pass == 1 || $mail == 1)
                            {
                                $code = rand(100000, 999999);
                                if ($mail == 0)
                                {
                                    $email = $row['email'];
                                }
                                $sql = "UPDATE users SET conf=false,code='$code' WHERE userid='$usr'";
                                $na = $pdo->prepare($sql);
                                $na->execute();
                                if ($pass == 1)
                                {
                                    if (ctype_alnum($nwpwd))
                                    {
                                        $sql = "UPDATE users SET pwd='$nwpwd' WHERE userid='$usr'";
                                        $na = $pdo->prepare($sql);
                                        $na->execute();
                                        echo "Password Successfully changed.</br>";
                                    }
                                    else
                                    {
                                        echo "Password can only contain letters and digits";
                                    }
                                }
                                if ($mail == 1)
                                {
                                    $sql = "UPDATE users SET email='$email' WHERE userid='$usr'";
                                    $na = $pdo->prepare($sql);
                                    $na->execute();
                                    echo "Email Successfully changed.</br>";
                                }
                                if ($user == 1)
                                {
                                    $sql = "UPDATE users SET userid='$username' WHERE userid='$usr'";
                                    $na = $pdo->prepare($sql);
                                    $na->execute();
                                    echo "Username Successfully changed.</br>";
                                }
                                if ($user == 0)
                                {
                                    $username = $usr;
                                }
                                $link = "http://localhost:8080/Camagru/php/verify.php?user=".$username."&code=".$code;
                                echo "Check your email for account verification link. You will be redirected in 3seconds";
                                $body = "You changed your credentials.Your verification link is ".$link;
                                mail($email,"CAMAGRU_ : Credentials confimation email", $body);
                                session_unset();
                                session_destroy();
                                header('refresh:3; url="../index.phtml"');
                            }
                            
                            
                        }
                        
                }
            }
            header('refresh:1; url="../html/settings.phtml"');
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
?>