<?php
    try
    {
        session_start();
        $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $usr = $_SESSION['login'];
        $stmt = $pdo->query("SELECT * FROM images WHERE userid='$usr' ORDER BY reg_date DESC");
        while ($row = $stmt->fetch())
        {
            $newd = date_format(date_create($row['reg_date']), 'D d M Y');
            $fig = "<figure>";
            $capt = "<figcation><p>".$newd."</p><p>".htmlspecialchars($row['img_title'])."</p></figcaption>";
            $img = "<img class=\"images\" name=\"".$row['img_title']."\" id=\"".$row['reg_date']." \"src=\"".$row['img_base64']."\" width=\"50%\">";
            $fig2 = "</figure>";
            echo $fig.$capt.$img.$fig2;
        }
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
?>