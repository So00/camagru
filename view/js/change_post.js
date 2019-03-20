/**
 * Function for the post
 */

function init() {
    const background = document.querySelector('.background');
    const toggleBody = document.querySelector('.toggle-body');
    const toggleBtn = document.querySelector('.toggle-btn');

    function change_post(xhr) {
        if (xhr.readyState == 4) {
            if (xhr.responseText === "OK") {
                background.classList.toggle('background--on');
                toggleBody.classList.toggle('toggle-body--on');
                toggleBtn.classList.toggle('toggle-btn--on');
                toggleBtn.classList.toggle('toggle-btn--scale');
            }
            else
                alert("An error has occured");
        }
    }

    if (toggleBtn)
        toggleBtn.addEventListener('click', () => {
            var xhr = null;
            var formdata = new FormData();

            formdata.append("img_id", document.body.querySelector(".mainPic").id);
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            }
            else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xhr.onreadystatechange = function () { change_post(xhr); };
            xhr.open("POST", "../../controler/post_picture_ajax.php", true);
            xhr.send(formdata);
        });
}

window.onload = init();