<?php
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
    include("checkpassword.php");
    $username = test_input($_POST['userid']);
    $fullname = ucwords(test_input($_POST['fullname']));
    $email = test_input($_POST['email']);
    $passwd = test_input($_POST['passwd']);
    $cnpwd = test_input($_POST['cmpswd']);
    if (!ctype_alnum($username))
    {
        echo "Username can only contain Letters and digits.<br/>You will be redirected in 3seconds...";
        header('refresh:3; url="../index.phtml"');
    }
    else if (!test_full($fullname))
    {
        echo "Fullname can only contain letters and digits.<br/>You will be redirected in 3seconds...";
        header('refresh:3; url="../index.phtml"');
    }
    else if ($passwd != $cnpwd)
    {
        echo "Passwords do not match.<br/>You will be redirected in 3seconds...";
        header('refresh:3; url="../index.phtml"');
    }
    else if (!check_pass($passwd))
    {
        echo "You will be redirected in 3seconds...";
        header('refresh:3; url="../index.phtml"');
    }
    else
    {
        $passwd = hash('whirlpool', test_input($_POST['passwd']));
        $cnpwd = hash('whirlpool', test_input($_POST['cmpswd']));
        try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->query('SELECT * FROM users');
            while ($row = $stmt->fetch())
            {
                if ($row['userid'] === $username || $row['email'] === $email || $row['userid'] === "guest")
                {
                    echo "Username or Email already exist.<br/>You will be redirected in 5seconds...";
                    header('refresh:5; url="../index.phtml"');
                    $u = 1;
                    break ;
                }
            }
            if ($u == 0)
            {
                $code = rand(100000, 999999);
                $sql = ("INSERT INTO users (userid,fullname,email,pwd,noti,conf,code) VALUES ('$username', '$fullname' , '$email' ,'$passwd', true , false , '$code')");
                $na = $pdo->prepare($sql);
                $na->execute();
                $link = "http://localhost:8080/Camagru/php/verify.php?user=".$username."&code=".$code;
                $body = "Your verification link is ".$link;
                mail($email,"CAMAGRU_ : Account Confimation mail", $body);
                echo "Confimation link has been sent to ".htmlspecialchars($email);
            }
        }
        catch(PDOException $e)
        {
            echo $pdo . "<br>" . $e->getMessage();
        }
    }
?>