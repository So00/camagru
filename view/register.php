<?php
    require_once "head.php";
    require_once "menu.php";
?>
<form id="form" action="register_answer.php" method="post">
<fieldset>

<!-- Form Name -->
<legend>Register</legend>

<!-- Text input-->
<div>
  <label for="Login">Login</label>
  <input id="login" name="login" type="text" class="">
  <span class="help-block">Only a-z, A-Z, 0-9. minimum length is 3</span>
</div>

<!-- Password input-->
<div>
  <label for="Pwd">Password</label>
    <input id="pwd" name="pwd" type="password" class="">
    <span class="help-block">Only a-z, A-Z, 0-9. Must have at least one lowercase, one uppercase, a number and 8 length</span>
</div>

<!-- Password input-->
<div>
  <label for="pwd2">Same password again</label>
  <div>
    <input id="pwd2" name="pwd2" type="password" class="">
    <span class="help-block">Password different</span>
  </div>
</div>

<!-- Text input-->
<div>
  <label for="Name">Name</label>  
  <div>
  <input id="name" name="name" type="text" class="">
  <span class="help-block">Only a-z and A-Z</span>
  </div>
</div>

<!-- Text input-->
<div>
  <label for="fname">First-name</label>  
  <div>
  <input id="fname" name="fname" type="text" class="">
  <span class="help-block">Only a-z and A-Z</span>  
  </div>
</div>

<!-- Text input-->
<div>
  <label for="mail">Mail adress</label>  
  <div>
  <input id="mail" name="mail" type="text" class="">
  <span class="help-block">This is not a valid mail</span>
  </div>
</div>

<!-- Submit input -->
<div>
  <div>
  <input type="submit" value="send" class="btn btn-primary">
  <span class="help-block">You need to validate all the field before sending</span>
  </div>
</div>

</fieldset>
</form>
        <script type="text/javascript" src="./js/creation.js"></script>
<?php
require_once "footer.php";
?>