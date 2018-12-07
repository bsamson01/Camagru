var index = 0;
slideshow();
function slideshow()
{
    var elem = document.getElementsByClassName("slide");
    for (var i = 0; i < elem.length; i++)
        elem[i].style.display = "none";
    index++;
    if (index > elem.length)
        index = 1;
    elem[index - 1].style.display = "block";
    setTimeout(slideshow, 4000);
}