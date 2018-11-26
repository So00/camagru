<?php
require_once "head.php";
require_once "menu.php";
require_once __DIR__."/../../controler/form_account.php";

if (!empty($_SESSION["ID"]))
{
    if (empty($_POST))
    {
        /**
         * Form sending to change mail etc ..
         */
        $user = Select_user($_SESSION["login"]);
        $user = $user->fetch();
?>
    <form method="post" action="./account.php">
        <div>
            <label for="currentPassword">Type your current password for any change</label>
            <input type="password" id="currentPassword" name="currentPassword" placeholder="Type your actualPassword here">
        </div>
        <div>
            <label for="mail">Change your mail</label>
            <input type="text" id="mail" placeholder="Type your new email adress" name="newMail">
        </div>
        <div>
            <label for="login">Change your username</label>
            <input type="text" id="login" placeholder="Type your new username" name="newLogin">
        </div>
        <div>
            <label for="notification">Receive a mail when someone comments one of your picture</label>
            <input type="checkbox" id="notification" name="notification" <?= (intval($user["notif"]) === 1 ? "checked" : ""); ?>>
        </div>
        <div>
            <label for="password">Change your password</label>
            <input type="password" id="password" placeholder="Type your new password" name="newPassword">
            <input type="password" id="password2" placeholder="Type it a second time" name="newPassword2">
        </div>
        <div>
            <label for="submit">Send your change</label>
            <input type="submit" id="submit" value="Submit" name="submit">
        </div>
    </form>
<?php
    }
    else
    {   
        $answer = form_answer($_POST);
        foreach ($answer as $actAnswer)
        {?>
            <div class="answer"><?= $actAnswer; ?></div>
<?php   }
    }
}
require_once "footer.php";
?>