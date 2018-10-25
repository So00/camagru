function init() {
    navigator.mediaDevices.getUserMedia({ audio: false, video: { width: 800, height: 600 } }).then(function(mediaStream) {

        var video = document.getElementById('sourcevid');
        video.height = document.body.clientHeight / 1.5
        video.width = video.height * 1.34
        video.srcObject = mediaStream
        var vidContainer = document.querySelector("#vidContainer")
        vidContainer.width = video.width
        vidContainer.height = video.height
        video.onloadedmetadata = function(e) {
            video.play();
        };
    }).catch(function(err) { console.log(err.name + ": " + err.message); });
}

function add_answer(xhr)
{
    if (xhr.readyState === 4)
    {
        var canvas = document.getElementById('picTaken')
        if (xhr.responseText === "KO") {
            alert("Oups, looks like there is a mistake")
        } else {
            var newImg = document.createElement('img')
            newImg.src = xhr.responseText
            newImg.className = 'newImg'
            newImg.width = document.body.clientWidth / 4.5
            canvas.appendChild(newImg)
        }
    }
}

{
var filter = document.getElementsByClassName("filter")
for (var i = 0; i < filter.length; i++)
{
    filter[i].addEventListener('click', function (e){
            act = e.target.cloneNode();
            video = document.body.querySelector("#vidContainer");
            act.style.position = absolute;
            video.appendChild(act);
        }
    )
}
}

function clone(){
    var vivi = document.getElementById('sourcevid')
    var canvas = document.getElementById('picTaken')
    var toAdd = document.createElement('canvas')
    var newEl = toAdd.getContext('2d')
    toAdd.className = 'cvs'
    toAdd.width = 700
    toAdd.height = 500
    newEl.drawImage(vivi, 0,0, 700, 500)
    var base64 = toAdd.toDataURL("image/png")
    var xhr=null;
 
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = function() {add_answer(xhr);}
 
    xhr.open("POST", "http://localhost/controler/add_picture_ajax.php", true)
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
    xhr.send("picture="+base64)
}

document.getElementById('upload_pic').addEventListener('submit', function (e){
    e.preventDefault()
    var data = document.getElementById('picData').files[0]
    var xhr=null
    var formData = new FormData()

    formData.append("picture", data)
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest()
        }
        else if (window.ActiveXObject)
        {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xhr.onreadystatechange = function() {add_answer(xhr);}

        xhr.open("POST", "http://localhost/controler/add_picture_ajax.php", true)
        xhr.send(formData)
})

window.onload = init()