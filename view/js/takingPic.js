function init() {
    navigator.mediaDevices.getUserMedia({ audio: false, video: { width: 800, height: 600 } }).then(function (mediaStream) {

        var video = document.getElementById('sourcevid');
        video.height = window.innerHeight / 1.5;
        video.width = video.height * 1.34;
        video.srcObject = mediaStream;
        var vidContainer = document.body.querySelector("#vidContainer");
        vidContainer.style.width = video.width + "px";
        vidContainer.style.height = video.height + "px";
        video.onloadedmetadata = function (e) {
            video.play();
        };
    }).catch(function (err) { console.log(err.name + ": " + err.message); });
}

var saveFile = null;

function add_answer(xhr) {
    if (xhr.readyState === 4) {
        var AllTakenPic = document.getElementById('picTaken');
        if (xhr.responseText === "KO") {
            alert("Oups, looks like there is a mistake");
        } else {
            /**
             * Add the picture to the done pictures
             */
            var response = xhr.responseText;
            var path = response.substring(0, response.indexOf("&"));
            var filters = JSON.parse(response.substring(response.lastIndexOf("&") + 1));
            var id = response.substring(response.indexOf("&") + 1, response.lastIndexOf("&"));
            var newLink = document.createElement('a');
            var newDiv = document.createElement('div');
            var newImg = document.createElement('img');
            newLink.appendChild(newImg);
            newLink.href = "my_picture.php?img_id="+id;
            newDiv.className = "imgContainer";
            newDiv.appendChild(newLink);
            newImg.src = "../"+path;
            newImg.className = "newImg";
            for (var i = 0; filters[i]; i++) {
                var newFilter = document.createElement("img");
                newFilter.style.position = "absolute";
                newFilter.src = "../../filters/" + filters[i].img;
                newFilter.style.width = filters[i].width;
                newFilter.style.top = filters[i].yPos;
                newFilter.style.left = filters[i].xPos;
                newLink.appendChild(newFilter);
            }
            AllTakenPic.appendChild(newDiv);
        }
    }
}

function Filter(actFilter) {
    this.img = actFilter.src.substring(actFilter.src.lastIndexOf("/") + 1);
    this.xPos = actFilter.style.left;
    this.yPos = actFilter.style.top;
    this.width = actFilter.style.width;
}

function clone() {
    /*
    ** Get all the filter
    */
    var allFilters = document.body.querySelectorAll(".activeFilter");
    filters = Array();
    for (var i = 0; allFilters[i]; i++)
        filters.push(new Filter(allFilters[i]));

    /*
    ** Creating the image
    */
    var vivi = document.getElementById('sourcevid');
    if (vivi != null) {
        var canvas = document.getElementById('picTaken');
        var toAdd = document.createElement('canvas');
        var newEl = toAdd.getContext('2d');
        toAdd.className = 'cvs';
        toAdd.width = 700;
        toAdd.height = 500;
        newEl.scale(-1, 1);
        newEl.drawImage(vivi, 0, 0, 700 * -1, 500);
        var base64 = toAdd.toDataURL("image/png");
    }
    else {
        var formData = new FormData();
        formData.append("picture", saveFile);
        formData.append("filters", JSON.stringify(filters));
    }

    /*
    ** Sending to the ajax
    */

    if (filters.length !== 0) {
        var xhr = null;

        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        }
        else if (window.ActiveXObject) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xhr.onreadystatechange = function () { add_answer(xhr); };

        xhr.open("POST", "../../controler/add_picture_ajax.php", true);
        if (vivi != null)
        {
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("picture=" + base64 + "&filters=" + JSON.stringify(filters));
        }
        else
            xhr.send(formData);
    }
}

document.getElementById('upload_pic').addEventListener('submit', function (e) {
    e.preventDefault();
    /**
     * Get the image to the container
     */
    var file = document.getElementById('picData').files[0];
    saveFile = file;
    var reader = new FileReader();
    reader.addEventListener("load", function () {
        var newImg = document.createElement('img');
        newImg.src = reader.result;
        newImg.className = "upload_img";
        document.getElementById('vidContainer').appendChild(newImg);
        var sourcevid = document.getElementById('sourcevid');
        sourcevid.parentNode.removeChild(sourcevid);
    });
    reader.readAsDataURL(file);
});

window.onresize = init;
window.onload = init();