<?php
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function check_pass($password)
    {
        $e = 1;
        if(strlen($password) < 8)
        {
            echo "Your Password Must Contain At Least 8 Characters!<br/>";
            $e = 0;
        }
        if (!preg_match("#[0-9]+#",$password))
        {
            echo "Your Password Must Contain At Least 1 Number!<br/>";
            $e = 0;
        }
        if (!preg_match("#[a-z]+#",$password))
        {
            echo "Your Password Must Contain At Least 1 LowerCase Letter!<br/>";
            $e = 0;
        }
        if (!preg_match("#[A-Z]+#",$password))
        {
            echo "Your Password Must Contain At Least 1 UpperCase Letter!<br/>";
            $e = 0;
        }
        if ($e == 1)
            return (true);
        else
            return (false);
    }
?>