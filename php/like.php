<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] === "guest")
    header('Location: ../index.phtml');
else
{
    try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=Camagru","root", "123456");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->query('SELECT * FROM images');
            $dte = $_POST['hidden_info'];
            while ($row = $stmt->fetch())
            {
                if ($row['reg_date'] === $_POST['hidden_info'])
                {
                    $likes = $row['likes'] + 1;
                    $sql = "UPDATE images SET likes='$likes' WHERE reg_date='$dte'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    if ($_POST['page'] === 'gallery')
                        header('Location: ../html/gallery.phtml');
                    else if ($_POST['page'] === 'home')
                        header('Location: ../html/home.phtml');
                    else if ($_POST['page'] === 'comment')
                    {
                        $li = "http://localhost:8080/Camagru/php/comment.php?reg_date=".$row['reg_date'];
                        header('Location: '.$li);
                    }
                }
            }
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    ?>