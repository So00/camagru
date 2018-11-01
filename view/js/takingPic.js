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

function Filter(actFilter)
{
        this.img = actFilter.src.substring(actFilter.src.lastIndexOf("/") + 1);
        this.xPos = actFilter.style.left;
        this.yPos = actFilter.style.top;
        this.width = actFilter.style.width;
}

function clone(){
    /*
    ** Creating the image
    */

    var vivi = document.getElementById('sourcevid');
    var canvas = document.getElementById('picTaken');
    var toAdd = document.createElement('canvas');
    var newEl = toAdd.getContext('2d');
    toAdd.className = 'cvs';
    toAdd.width = 700;
    toAdd.height = 500;
    newEl.scale(-1, 1);
    newEl.drawImage(vivi, 0,0, 700 * -1, 500);
    var base64 = toAdd.toDataURL("image/png");

    /*
    ** Get all the filter
    */
   var formData = new FormData();

    var allFilters = document.body.querySelectorAll(".activeFilter");
    filters = Array();
    for (var i = 0; allFilters[i]; i++)
        filters.push(new Filter(allFilters[i]));

    /*
    ** Sending to the ajax
    */

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
    xhr.send("picture="+base64+"&filters="+JSON.stringify(filters));
}

document.getElementById('upload_pic').addEventListener('submit', function (e){
    e.preventDefault();
    var data = document.getElementById('picData').files[0];
    var xhr=null;
    var formData = new FormData();

    var allFilters = document.body.querySelectorAll(".activeFilter");
    filters = Array();
    for (var i = 0; allFilters[i]; i++)
        filters.push(new Filter(allFilters[i]));

    formData.append("picture", data);
    formData.append("filters", filters);
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

window.onresize = init;
window.onload = init();