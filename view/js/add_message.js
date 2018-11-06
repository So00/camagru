function send_message(xhr)
{
    if (xhr.readyState == 4)
    {
        if (xhr.responseText == "KO")
            alert("Oups, looks like there was a mistake");
        else
        {
            var message_container = document.body.querySelector(".message_container");
            var new_message = document.createElement("div");
            var new_par = document.createElement("p");
            var new_hour = document.createElement("p");
            var titleId = document.createElement("h2");
            var response = JSON.parse(xhr.responseText);
            titleId.className = "user_id";
            titleId.innerHTML = response.login;
            new_hour.className = "post_hour";
            new_hour.innerHTML = response.date;
            new_message.className = "message";
            new_par.innerHTML = response.message;
            new_message.appendChild(titleId);
            new_message.appendChild(new_hour);
            new_message.appendChild(new_par);
            if (message_container.childNodes.length == 0)
                message_container.appendChild(new_message);
            else
                message_container.insertBefore(new_message , message_container.firstChild);
        }
    }
}

function add_message()
{
    var xhr = null;
    var formdata = new FormData();

    formdata.append("message", document.body.querySelector("textarea").value);
    formdata.append("img_id", document.body.querySelector(".mainPic").id);
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = function () {send_message(xhr);};
    xhr.open("POST", "../controler/add_message_ajax.php", true);
    xhr.send(formdata);
}