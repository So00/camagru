function escapeHtml(actTest) {
    var map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
};
    return actTest.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function validateEmail(mail) 
{
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
    {
        return (0);
    }
    return (1);
}

function is_str_alpha(_try) {
    for (var i = 0; _try[i]; i++)
    {
        if (!(_try[i] >= 'a' && _try[i] <= 'z') && !(_try[i] >= 'A' && _try[i] <= 'Z'))
            return (1);
    }
    return (0);
}

function is_str_alphanum(_try) {
    for (var i = 0; _try[i]; i++)
    {
        if (!(_try[i] >= 'a' && _try[i] <= 'z') && !(_try[i] >= 'A' && _try[i] <= 'Z') && !(_try[i] >= '0' && _try[i] <= '9'))
            return (1);
    }
    return (0);
}

function desactivate() {
    var help = document.getElementsByClassName('help-block')
    for (var i = 0; help[i]; i++)
        help[i].style.display = 'none';
}

function checkPwdStrengh(value) {
    var err = min = maj = numb = 0
    for (var i = 0; value[i]; i++) {
        if (value[i] >= 'a' && value[i] <= 'z')
            min = 1;
        if (value[i] >= 'A' && value[i] <= 'Z')
            maj = 1;
        if (value[i] >= '0' && value[i] <= '9')
            numb = 1;
    }
    if (!min || !maj || !numb)
        err = 1;
    return (err);
}

function userExist(value) {
    var xhr = null;
    if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("GET", "http://localhost/model/userExist.php?user="+value, false);
    xhr.send(null);
 
    if (xhr.responseText === "KO")
        return (1);
    return (0);
}

function mailExist(value) {
    var xhr = null;
    if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("GET", "http://localhost/model/mailExist.php?mail="+value, false);
    xhr.send(null);
 
    if (xhr.responseText === "KO")
        return (1);
    return (0);
}

var check = {};

check['login'] = function(e){
    var value = e.target.value
    var span = document.getElementById(e.target.id).nextElementSibling
    if (is_str_alphanum(value)){
        span.innerHTML = "Only a-z, A-Z and 0-9 are allowed"
        span.style.display = "inline-block"
        e.target.className = "incorrect"
    } else if (value.length < 3 || value.length > 30){
        span.innerHTML = "Login lenght must be beetween 3 and 30"
        span.style.display = "inline-block"
        e.target.className = "incorrect"
    } else if (userExist(value)){
        span.innerHTML = "User already exist"
        span.style.display = "inline-block"
        e.target.className = "incorrect"
    } else {
        span.style.display = "none"
        e.target.className = "correct"
    }
}

check['pwd'] = function(e){
    var value = e.target.value
    var span = document.getElementById(e.target.id).nextElementSibling
    if (is_str_alphanum(value)){
        span.innerHTML = "Only a-z, A-Z and 0-9 are allowed";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else if (value.length < 8 || value.length > 254){
        span.innerHTML = "Password lenght must be beetween 8 and 254";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else if (checkPwdStrengh(value)) {
        span.innerHTML = "Password must have at least one upper case, one lower case and a number";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else {
        span.style.display = "none";
        e.target.className = "correct";
    }
}

check['pwd2'] = function(e){
    var value = e.target.value;
    var span = document.getElementById(e.target.id).nextElementSibling;
    var valuePwd = document.getElementById('pwd').value;
    if (value !== valuePwd) {
        span.innerHTML = "Password is different";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else {
        span.style.display = "none";
        e.target.className = "correct";
    }
}

check['mail'] = function(e){
    var value = e.target.value;
    var span = document.getElementById(e.target.id).nextElementSibling;
    if (validateEmail(value)) {
        span.innerHTML = "Email is not valid";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else if (mailExist(value)) {
        span.innerHTML = "Email already exists";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else {
        span.style.display = "none";
        e.target.className = "correct";
    }
}

check['name'] = function(e){
    var value = e.target.value;
    var span = document.getElementById(e.target.id).nextElementSibling;
    if (value.length < 3 || value.length > 244) {
        span.innerHTML = "The name must be at least 3 length and at more 244 length";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else if (is_str_alpha(value)) {
        span.innerHTML = "Only a-z and A-Z are allowed";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else {
        span.style.display = "none";
        e.target.className = "correct";
    }
}

check['fname'] = function(e){
    var value = e.target.value;
    var span = document.getElementById(e.target.id).nextElementSibling;
    if (value.length < 3 || value.length > 244) {
        span.innerHTML = "The first name must be at least 3 length and at more 244 length";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else if (is_str_alpha(value)) {
        span.innerHTML = "Only a-z and A-Z are allowed";
        span.style.display = "inline-block";
        e.target.className = "incorrect";
    } else {
        span.style.display = "none";
        e.target.className = "correct";
    }
}

function testValue(actTest)
{
    var needed_func = {
        'login' : 1,
        'pwd' : 1,
        'name' : 2,
        'fname' : 2,
        'mail' : 3
    };

    var value = document.getElementById(actTest).value;
    var escape = escapeHtml(value);
    var ret = 0;
    if (needed_func[actTest] == 1)
        ret = is_str_alphanum(value);
    else if (needed_func[actTest] == 2)
        ret = is_str_alpha(value);
    else
        ret = validateEmail(value);

    if (actTest == 'login' && value.length < 3)
        ret = 1;
    if (value != escape || ret)
    {
        return (1);
    }

    if (actTest == "pwd")
    {
        var value2 = document.getElementById('pwd2').value;
        var escape = escapeHtml(value2);
        var err = 0;
        if (value.length < 8 || value.length > 254)
            err = 1;
        if (value2 == value) {
            err = checkPwdStrengh(value);
        }
        else {
            err = 1;
        }
        if (err) {
            return (1);
        }
    }
    return (0);
}

(function(){
    var inputs = document.querySelectorAll("input[type=text], input[type=password]");

    for (var i = 0; inputs[i]; i++)
        inputs[i].addEventListener('keyup', function(e){
            check[e.target.id](e);
        });

    form.addEventListener('submit', function(e) {
        desactivate();
        if (testValue('login') + testValue('pwd') + testValue('mail') + testValue('name') + testValue('fname'))
            e.preventDefault();
    });
    desactivate();
})();