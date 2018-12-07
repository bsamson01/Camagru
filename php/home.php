<?php
    try
    {
        session_start();
        $usr = $_SESSION['login'];
        $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->query("SELECT * FROM images WHERE userid='$usr' ORDER BY reg_date DESC");
        while ($row = $stmt->fetch())
        {
            $newd = date_format(date_create($row['reg_date']), 'D d M Y');
            $fig = "<figure>";
            $capt = "<figcation> <h3>".$row['userid']."</h3><p>".$newd."</p>".$row['img_title']."</figcaption>";
            $img = "<img class=\"images\" name=\"".$row['img_title']."\" id=\"".$row['reg_date']." \"src=\"".$row['img_base64']."\" width=\"50%\">";
            $form = "<form name=\"".$row['reg_date']."\" action=\"../php/like.php\" method=\"POST\"><input type=\"hidden\" name=\"page\" value=\"home\"><input type=\"hidden\" name=\"hidden_info\" value=\"".$row['reg_date']."\"><input type=\"submit\" name=\"btn\" value=\"likes : ".$row['likes']."\"/></form>";
            $com = "<a href=\"http://localhost:8080/Camagru/php/delete.php?reg_date=".$row['reg_date']."\"><button>DELETE</button></a>";
            $fig2 = "</figure>";
            echo $fig.$capt.$img.$form.$com.$fig2;
        }
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
?>