<?php
    function    add_img_to_table($con, $img_src, $imgtitle)
    {
        include("checkpassword.php");
        $curr = $_SESSION['login'];
        $data = base64_encode(file_get_contents($img_src));
        $pic = 'data : '.mime_content_type($img_src).';base64,'.$data;
        if (ctype_alnum($imgtitle))
        {
            $qry = ("INSERT INTO '$curr' (img, img_title) VALUES ('$pic', '$imgtitle')");
            $ret = mysqli_query($con, $qry);
            if ($ret)
                echo "Picture uploaded successfully";
            else
                echo "picture upload error ".mysqli_error($con);
        }
        else
        {
            echo "Image title can only contain alphanumeric characters";
        }
    }
?>