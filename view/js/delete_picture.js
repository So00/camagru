function init()
{
    function add_answer(xhr, img_id) {
        if (xhr.readyState === 4) {
            if (parseInt(xhr.responseText) !== img_id) {
                alert(xhr.responseText + " " + img_id);
            } else {
                /**
                 * Delete the picture to the done pictures
                 */
                var del_picture = document.getElementById(img_id).parentNode.parentNode;
                del_picture.parentNode.removeChild(del_picture);
            }
        }
    }
    
    var all_deletion = document.body.querySelectorAll("#act_del");
    for (var i = 0; all_deletion[i]; i++)
    all_deletion[i].addEventListener('click', function (e) {
    e.preventDefault();
    var img_id = parseInt(e.target.id);

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = function () { add_answer(xhr, img_id); };
    xhr.open("POST", "../../controler/delete_picture_ajax.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");    
    xhr.send("picture=" + img_id);
});

}

window.onload = init();