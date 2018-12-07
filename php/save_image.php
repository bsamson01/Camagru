<?php
    session_start();
    $pic = $_POST['hidden_data'];
    $caption = $_POST['caption'];
    if (ctype_alnum($caption))
    {
        try
        {
                $con = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $usr = $_SESSION['login'];
                $tmp = $con->query("SELECT * FROM users");
                while ($row = $tmp->fetch())
                {
                    if ($row['userid'] === $usr)
                    {
                        $email = $row['email'];
                        break ;
                    }
                }
                $sql = "INSERT INTO images (userid,email,img_title,img_base64,likes) VALUES ('$usr','$email','$caption','$pic','0')";
                $con->exec($sql);
                echo "Image succesfully uploaded. You will be redirected in 3seconds";
                header('refresh:3; url="../html/camera.phtml"');
        }
        catch(PDOException $e)
        {
            echo $con . "<br>" . $e->getMessage();
        }
    }
    else
    {
        echo "Image caption can only contain alphanumeric characters. You will be redirected in 3seconds";
        header('refresh:3; url="../html/camera.phtml"');
    }
?>