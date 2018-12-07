<?php
    try
    {
        session_start();
        $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $usr = $_SESSION['login'];
        $stmt = $pdo->query('SELECT * FROM images ORDER BY reg_date DESC');
        if ($_SESSION['login'] === "guest")
        {
            echo "<a href=\"../index.phtml\"><button>LOGIN</button></a>";
        }
        while ($row = $stmt->fetch())
        {
            $newd = date_format(date_create($row['reg_date']), 'D d M Y');
            $fig = "<figure>";
            $capt = "<figcation> <h3>".$row['userid']."</h3><p>".$newd."</p>".htmlspecialchars($row['img_title'])."</figcaption>";
            $img = "<img class=\"images\" name=\"".$row['img_title']."\" id=\"".$row['reg_date']." \"src=\"".$row['img_base64']."\" width=\"50%\">";
            $form = "<form name=\"".$row['reg_date']."\" action=\"../php/like.php\" method=\"POST\"><input type=\"hidden\" name=\"page\" value=\"gallery\"><input type=\"hidden\" name=\"hidden_info\" value=\"".$row['reg_date']."\"><input type=\"submit\" name=\"btn\" value=\"likes : ".$row['likes']."\"></form>";
            $com = "<a href=\"http://localhost:8080/Camagru/php/comment.php?reg_date=".$row['reg_date']."\"><button>Comment</button></a>";
            $fig2 = "</figure>";
            echo $fig.$capt.$img.$form.$com.$fig2;
        }
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
?>
