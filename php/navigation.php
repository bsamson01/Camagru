<?php
function navi($page)
{
    if ($page == "home")
    echo "<nav> <div id=\"titl\"><img src=\"../css/images/head1.png\" alt=\"CAMAGRU_\"/></div>
                <div id=\"bar\">
                <ul id=\"navig\">
                    <li class=\"active\"> <a href=\"../html/home.phtml\">Home</a></li>
                    <li> <a href=\"../html/camera.phtml\">Capture&nbsp;Image</a></li>
                    <li> <a href=\"../html/gallery.phtml\">Gallery</a></li>
                    <li> <a href=\"../html/settings.phtml\">Settings</a></li>
                    <li> <a href=\"../php/logout.php\" id=\"logout\">Logout</a></li>
                </ul>
                </div>
        </nav>";
    else if ($page == "cam")
        echo "<nav> <div id=\"titl\"><img src=\"../css/images/head1.png\" alt=\"CAMAGRU_\"/></div>
                <div id=\"bar\">
                <ul id=\"navig\">
                    <li> <a href=\"../html/home.phtml\">Home</a></li>
                    <li class=\"active\"> <a href=\"../html/camera.phtml\">Capture&nbsp;Image</a></li>
                    <li> <a href=\"../html/gallery.phtml\">Gallery</a></li>
                    <li> <a href=\"../html/settings.phtml\">Settings</a></li>
                    <li> <a href=\"../php/logout.php\" id=\"logout\">Logout</a></li>
                </ul>
                </div>
        </nav>";
    else if ($page == "gal")
        echo "<nav> <div id=\"titl\"><img src=\"../css/images/head1.png\" alt=\"CAMAGRU_\"/></div>
                <div id=\"bar\">
                <ul id=\"navig\">
                    <li> <a href=\"../html/home.phtml\">Home</a></li>
                    <li> <a href=\"../html/camera.phtml\">Capture&nbsp;Image</a></li>
                    <li class=\"active\"> <a href=\"../html/gallery.phtml\">Gallery</a></li>
                    <li> <a href=\"../html/settings.phtml\">Settings</a></li>
                    <li> <a href=\"../php/logout.php\" id=\"logout\">Logout</a></li>
                </ul>
                </div>
        </nav>";
        else if ($page == "set")
            echo "<nav> <div id=\"titl\"><img src=\"../css/images/head1.png\" alt=\"CAMAGRU_\"/></div>
                <div id=\"bar\">
                <ul id=\"navig\">
                    <li> <a href=\"../html/home.phtml\">Home</a></li>
                    <li> <a href=\"../html/camera.phtml\">Capture&nbsp;Image</a></li>
                    <li> <a href=\"../html/gallery.phtml\">Gallery</a></li>
                    <li class=\"active\"> <a href=\"../html/settings.phtml\">Settings</a></li>
                    <li> <a href=\"../php/logout.php\" id=\"logout\">Logout</a></li>
                </ul>
                </div>
        </nav>";
        else
        echo "<nav> <div id=\"titl\"><img src=\"../css/images/head1.png\" alt=\"CAMAGRU_\"/></div>
                <div id=\"bar\">
                <ul id=\"navig\">
                    <li> <a href=\"../html/home.phtml\">Home</a></li>
                    <li> <a href=\"../html/camera.phtml\">Capture&nbsp;Image</a></li>
                    <li> <a href=\"../html/gallery.phtml\">Gallery</a></li>
                    <li> <a href=\"../html/settings.phtml\">Settings</a></li>
                    <li> <a href=\"../php/logout.php\" id=\"logout\">Logout</a></li>
                </ul>
                </div>
        </nav>";
}
?>