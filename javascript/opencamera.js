var video = document.getElementById('video');
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
{
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream)
    {
        video.srcObject = stream;
    });
}


var img_srcs = new Array;
img_srcs[0] = "../css/images/yellowgl.png"; //glasses
img_srcs[1] = "../css/images/ichigo.png"; //hat
img_srcs[2] = "../css/images/strip.png"; //hair and glasses
img_srcs[3] = "../css/images/oculus.png" //vr
img_srcs[4] = "../css/images/music.png"; //frame
img_srcs[5] = "../css/images/ven.png"; // frame
img_srcs[6] = "../css/images/fairy.png"; // frame
img_srcs[7] = "../css/images/spidy.png"; // frame
img_srcs[8] = "../css/images/bleach.png"; //bleach

var con = document.getElementsByTagName("canvas");
var vi = con[2].toDataURL();

var cont = document.getElementById('dropcan').getContext('2d');
function effect(e)
{
    var sx = 0;
    var sy = 0;
    var w = 0;
    var h = 0;
        if (e > 3 && e < 8 && e != 5)
        {
            w = 640;
            h = 480;
            sx = 0;
            sy = 0;
        }
        else if (e == 3)
        {
            w = 300;
            h = 200;
            sx = 160;
            sy = 150;
        }
        else if (e == 8)
        {
            w = 200;
            h = 150;
            sx = 260;
            sy = 300;
        }
        else if (e == 0 || e == 2)
        {
            w = 220;
            h = 90;
            sx = 200;
            sy = 180;
        }
        else if (e == 1)
        {
            w = 290;
            h = 170;
            sx = 180;
            sy = 20;
        }
        else if (e == 5)
        {
            w = 300;
            h = 480;
            sx = 0;
            sy = 0;
        }
    var cont = document.getElementById('dropcan').getContext('2d');
    var img = new Image;
    img.crossOrigin = "Anonymous";
    img.src = img_srcs[e];
    cont.drawImage(img, sx, sy, w, h);
}

function snap()
{
    var con = document.getElementsByTagName("canvas");
    var context = document.getElementById("canvas").getContext('2d');
    var video = document.getElementById('video');
    var uploa = document.getElementById('upload');
    var effect = document.getElementById('dropcan');
    context.drawImage(video, 0, 0, 640, 480);
    context.drawImage(uploa, 0, 0, 640, 480);
    context.drawImage(effect, 0, 0, 640, 480);
    var fin = con[2].toDataURL();
    document.getElementById('hidden_data').value = fin;
}


    document.getElementById('file').onchange = function(e) 
    {
        var img = new Image();
        img.onload = draw;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
        var track = video.srcObject.getTracks()[0];
        track.stop();
    };


  function draw()
  {
    var canvas = document.getElementById('upload');
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0,640,480);
  }

  function failed()
  {
    console.error("The provided file couldn't be loaded as an Image media");
  }
