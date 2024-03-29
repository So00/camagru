<?php
    require __DIR__."/head.php";
    require __DIR__."/menu.php";
?>
<form id="form" action="register_answer.php" method="post">


<!-- Text input-->
<div>
  <label for="login">Login</label>
    <input id="login" name="login" type="text" class="">
    <span class="help-block">Only a-z, A-Z, 0-9. minimum length is 3</span>
</div>

<!-- Password input-->
<div>
  <label for="pwd">Password</label>
    <input id="pwd" name="pwd" type="password" class="" minlength="8" required>
    <span class="help-block">Only a-z, A-Z, 0-9. Must have at least one lowercase, one uppercase, a number and 8 length</span>
</div>

<!-- Password input-->
<div>
  <label for="pwd2">Same password again</label>
    <input id="pwd2" name="pwd2" type="password" class="" minlength="8" required>
    <span class="help-block">Password different</span>
</div>

<!-- Text input-->
<div>
  <label for="name">Name</label>
    <input id="name" name="name" type="text" class="">
    <span class="help-block">Only a-z and A-Z</span>
</div>

<!-- Text input-->
<div>
  <label for="fname">First-name</label>  
    <input id="fname" name="fname" type="text" class="">
    <span class="help-block">Only a-z and A-Z</span>  
</div>

<!-- Text input-->
<div>
  <label for="mail">Mail adress</label>  
    <input id="mail" name="mail" type="text" class="">
    <span class="help-block">This is not a valid mail</span>
</div>

<!-- Submit input -->
<div>
    <input type="submit" value="send" class="btn btn-primary">
    <span class="help-block">You need to validate all the field before sending</span>
</div>

</form>
        <script type="text/javascript" src="../js/creation.js"></script>
<?php
require __DIR__."/footer.php";
?>