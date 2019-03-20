function init()
{
    /**
     * Like function
     */

    function change_like(xhr)
    {
        if (xhr.readyState == 4)
        {
            var p_like = document.querySelector(".like p");
            if (xhr.responseText === "KO")
                alert("An error has occured");
            else
            {
                var answer = JSON.parse(xhr.responseText);
                var heart = document.querySelector(".likes");
                p_like.innerHTML = answer.nb_like;
                heart.classList.toggle("iLike");
            }
        }
    }

    var like = document.querySelector("a.likes");

    if (like)
        like.addEventListener('click', (e) => {
            var xhr = null;
            var img = document.querySelector(".mainPic");
            var img_id = img.id;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            }
            else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }

            e.preventDefault();
            xhr.onreadystatechange = function () {change_like(xhr);};
            xhr.open("POST", "../../controler/like_ajax.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");    
            xhr.send("img_id=" + img_id);
        });
}

window.onload = init();