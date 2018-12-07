<?php
    include("checkpassword.php");
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login'] === "guest")
        header('Location: ../index.phtml');
    else
    {
        $reg = $_GET['reg_date'];
        $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $usr = $_SESSION['login'];
        $stmt = $pdo->query('SELECT * FROM images');
        $str ="<!DOCTYPE html>
                    <html>
                    <head>
                        <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/comment.css\">
                        <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/navigation.css\">
                    </head>
                    <body>";
        echo $str;
        include("../php/navigation.php");
        navi("q");
        while ($row = $stmt->fetch())
        {
            if ($row['reg_date'] == $reg)
            {
                $gal = "<a href=\"../html/gallery.phtml\"><button>Back to gallery</button></a>";
                $newd = date_format(date_create($row['reg_date']), 'D d M Y');
                $fig = "<figure>";
                $capt = "<figcation> <h3>".$newd." by ".$row['userid']."</h3><p>".$row['img_title']."</p></figcaption>";
                $img = "<img class=\"images\" name=\"".$row['img_title']."\" id=\"".$row['reg_date']." \"src=\"".$row['img_base64']."\" width=\"50%\">";
                $form = "<form name=\"".$row['reg_date']."\" action=\"../php/like.php\" method=\"POST\"><input type=\"hidden\" name=\"page\" value=\"comment\"><input type=\"hidden\" name=\"hidden_info\" value=\"".$row['reg_date']."\"><input type=\"submit\" name=\"btn\" value=\"likes : ".$row['likes']."\"></form>";
                $fig2 = "</figure>";
                echo $gal.$fig.$capt.$img.$form.$fig2;
                echo "<div class=\"comme\">";
                if (isset($row['comments']))
                {
                    $com = array();
                    $com = unserialize($row['comments']);
                    foreach($com as $key=>$val)
                    {
                        echo htmlspecialchars($val)."<br/>";
                    }
                }
                echo "</div>";
            }
        }
        echo "<form id=\"comi\" action=\"add_comment.php\" method=\"POST\">
                <input id=\"tt\" type=\"text\" name=\"com\" value=\"\" required/>
                <input type=\"hidden\" name=\"hidden_txt\" value=\"".$reg."\">
                    <input type=\"hidden\" name=\"usr\" value=\"".$usr."\">
                        <input type=\"submit\" value=\"Comment\"></form>";
        echo "</body></html>";
    }
?>