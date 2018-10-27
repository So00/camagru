function init() {
    navigator.mediaDevices.getUserMedia({ audio: false, video: { width: 800, height: 600 } }).then(function(mediaStream) {

        var video = document.getElementById('sourcevid');
        video.height = document.body.clientHeight / 1.5;
        video.width = video.height * 1.34;
        video.srcObject = mediaStream;
        var vidContainer = document.body.querySelector("#vidContainer");
        vidContainer.style.width = video.width+"px";
        vidContainer.style.height = video.height+"px";
        video.onloadedmetadata = function(e) {
            video.play();
        };
    }).catch(function(err) { console.log(err.name + ": " + err.message); });
}

function add_answer(xhr)
{
    if (xhr.readyState === 4)
    {
        var AllTakenPic = document.getElementById('picTaken');
        if (xhr.responseText === "KO") {
            alert("Oups, looks like there is a mistake");
        } else {
            var newImg = document.createElement('img');
            newImg.src = xhr.responseText;
            newImg.className = 'newImg';
            newImg.width = document.body.clientWidth / 4.5;
            AllTakenPic.appendChild(newImg);
        }
    }
}

{
var filter = document.getElementsByClassName("filter");
for (var i = 0; i < filter.length; i++)
{
    filter[i].addEventListener('click', function (e){
            var act = e.target.cloneNode();
            video = document.body.querySelector("#vidContainer");
            var nb_filter = document.getElementsByClassName("activeFilter").length;
            var timer;
            act.style.position = "absolute";
            act.style.top = "0";
            act.style.left = "0";
            act.className = "activeFilter filter_" + nb_filter;
            video.appendChild(act);

            var dragItem = document.querySelector(".activeFilter");
            var container = document.querySelector("#vidContainer");

    var active = false;
    var currentX;
    var currentY;
    var initialX;
    var initialY;
    var xOffset = 0;
    var yOffset = 0;

    container.addEventListener("touchstart", dragStart, false);
    container.addEventListener("touchend", dragEnd, false);
    container.addEventListener("touchmove", drag, false);

    container.addEventListener("mousedown", dragStart, false);
    container.addEventListener("mouseup", dragEnd, false);
    container.addEventListener("mousemove", drag, false);

    function dragStart(e) {
      if (e.type === "touchstart") {
        initialX = e.touches[0].clientX - xOffset;
        initialY = e.touches[0].clientY - yOffset;
      } else {
        initialX = e.clientX - xOffset;
        initialY = e.clientY - yOffset;
      }

      if (e.target === dragItem) {
        active = true;
      }
    }

    function dragEnd(e) {
      initialX = currentX;
      initialY = currentY;

      active = false;
    }

    function drag(e) {
      if (active) {
      
        e.preventDefault();
      
        if (e.type === "touchmove") {
          currentX = e.touches[0].clientX - initialX;
          currentY = e.touches[0].clientY - initialY;
        } else {
          currentX = e.clientX - initialX;
          currentY = e.clientY - initialY;
        }

        xOffset = currentX;
        yOffset = currentY;

        setTranslate(currentX, currentY, dragItem);
      }
    }

    function setTranslate(xPos, yPos, el) {
      el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
    }
        }
    )
}
}

function clone(){
    var vivi = document.getElementById('sourcevid');
    var canvas = document.getElementById('picTaken');
    var toAdd = document.createElement('canvas');
    var newEl = toAdd.getContext('2d');
    toAdd.className = 'cvs';
    toAdd.width = 700;
    toAdd.height = 500;
    newEl.drawImage(vivi, 0,0, 700, 500);
    var base64 = toAdd.toDataURL("image/png");
    var xhr=null;
 
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = function() {add_answer(xhr);}
 
    xhr.open("POST", "http://localhost/controler/add_picture_ajax.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("picture="+base64);
}

document.getElementById('upload_pic').addEventListener('submit', function (e){
    e.preventDefault();
    var data = document.getElementById('picData').files[0];
    var xhr=null;
    var formData = new FormData();

    formData.append("picture", data)
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        }
        else if (window.ActiveXObject);
        {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xhr.onreadystatechange = function() {add_answer(xhr);}

        xhr.open("POST", "http://localhost/controler/add_picture_ajax.php", true);
        xhr.send(formData);
});

window.onload = init();