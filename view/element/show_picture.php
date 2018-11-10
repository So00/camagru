<?php

function show_picture($img, $path)
{
    if ($path) { ?>
    <a href="<?= $path; ?>.php?img_id=<?= $img["ID"]; ?>">
    <?php } ?>
    <div class="pictureContainer">
        <img class="mainPic" src="<?= "../".$img["img_path"]; ?>" id="<?= $img["ID"]; ?>">
        <?php
        $filters = json_decode($img["filter"], true);
        foreach ($filters as $actFilter)
        { ?>
                <img class="imgFilter" src="../../filters/<?= $actFilter["img"]; ?>" style="width : <?= $actFilter["width"]; ?>; top : <?= $actFilter["yPos"]; ?>; left : <?= $actFilter["xPos"]; ?>;">
        <?php } ?>
    </div>
    <?php if ($path) { ?>
    </a>
    <?php }
}

function show_all_picture($allPicture, $path)
{
    foreach ($allPicture as $actPicture)
        show_picture($actPicture, $path);
}

?>