<?php
    include("checkpassword.php");
    $usrname = test_input($_POST['userid']);
    $password = hash('whirlpool', test_input($_POST['passwd']));
    try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->query('SELECT * FROM users');
            while ($row = $stmt->fetch())
            {
                if ($row['userid'] === $usrname || $row['email'] === $usrname)
                {
                    if ($row['conf'] == false)
                    {
                        echo "Account not verified. Please check the verification link in your email";
                        header('refresh:3; url="../index.phtml"');
                    }
                    else if ($row['pwd'] === $password)
                    {
                        session_unset();
                        session_destroy();
                        session_start();
                        $_SESSION['login'] = $row['userid'];
                        header('Location: ../html/home.phtml');
                    }
                    else
                    {
                        echo "Incorect password. Your will be redirected in 3seconds";
                        header('refresh:3; url="../index.phtml"');
                    }
                }
            }
            echo "User does not exist. Try signing up as a new user";
            header('refresh:3; url="../index.phtml"');
        }
    catch(PDOException $e)
        {
            echo $pdo . "<br>" . $e->getMessage();
        }
?>