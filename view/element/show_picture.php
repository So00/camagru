<?php

require __DIR__ . "/../../controler/common_function.php";

function show_picture($img, $path)
{
    if ($path === "my_picture" || $img["posted"] !== null || ($path === null && get_id_user($_SESSION["login"]) === $img["user_id"])) {
        ?>
    <div class="pictureContainer">
        <?php
        if ($path) { ?>
            <a href="<?= $path; ?>.php?img_id=<?= $img["ID"]; ?>">
            <?php
        } ?>
        <img class="mainPic" src="<?= "../" . $img["img_path"]; ?>" id="<?= $img["ID"]; ?>">
        <?php
        $filters = json_decode($img["filter"], true);
        foreach ($filters as $actFilter) { ?>
                <img class="imgFilter" src="../../filters/<?= $actFilter["img"]; ?>" style="width : <?= $actFilter["width"]; ?>; top : <?= $actFilter["yPos"]; ?>; left : <?= $actFilter["xPos"]; ?>;">
        <?php
        }
        if ($path) { ?>
            </a>
        <?php
        }
        if ($path === "my_picture")
            echo "<a href=\"#\" class=\"delete-link\" id=\"act_del\"><span class=\"delete\"><img id=\"".$img["ID"]."\" src=\"../../website-picture/cross.png\"\></span></a>";
        ?>
    </div>
    <?php
    }
}

function show_all_picture($allPicture, $path)
{
    foreach ($allPicture as $actPicture)
        show_picture($actPicture, $path);
}

?>