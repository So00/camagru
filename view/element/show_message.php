<?php

function show_message($actCom)
{ ?>
    <div class="message">
                    <h2 class="user_id"> <?= $actCom["login"]; ?></h2>
                    <p class="post_hour"> <?= $actCom["date"]; ?></p>
                    <div class="comment" id="<?= $actCom["ID"]; ?>"><?= htmlspecialchars($actCom["message"]); ?></div>
    </div>
    <?php

}

function show_all_message($all_com)
{
    foreach ($all_com as $act_com)
        show_message($act_com);
}

?>