<?php

require __DIR__ . "/../../controler/common_function.php";

function is_post($img, $class)
{
    if ($img["posted"] === NULL)
        return ("");
    if ($class === "background")
        return ("background--on");
    if ($class === "toggle-body")
        return ("toggle-body--on");
    return ("toggle-btn--on toggle-btn--scale");
}

function show_picture($img, $path, $post)
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
        else if ($path === null && $post)
        {
            ?>
            <div class="background <?= is_post($img, "background"); ?>">
                <div class="toggle-body <?= is_post($img, "toggle-body"); ?>">
                    <div class="toggle-btn <?= is_post($img, "toggle-btn"); ?>"></div>
                </div>
            </div>
        <?php
        }
        if ($path === null)
        {
            $decode_like = json_decode($img["likes"], true);
            $count = array_count_values($decode_like);
            echo "<div class=\"like\"><p>".
            ((empty($count["1"])) ? 0 : $count["1"])
            ."</p><a class=\"likes ".
            (empty($decode_like[$_SESSION["ID"]]) || $decode_like[$_SESSION["ID"]] == 0 ? "" : "iLike")
            ."\" href=\"#\"><img src=\"../../website-picture/heart.png\"></a></div>";
        }
        ?>
    </div>
    <?php
    }
}

function show_all_picture($allPicture, $path, $post)
{
    foreach ($allPicture as $actPicture)
        show_picture($actPicture, $path, $post);
}

?>