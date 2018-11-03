<?php
    require_once "head.php";
    require_once "menu.php";
    require_once "../controler/get_picture.php";

    if ($_SESSION['login']){
        $allPicture = get_all_picture($_SESSION['login']);
        foreach ($allPicture as $actPic) {
?>
            <div class="pictureContainer">
                <img class="mainPic" src="<?= $actPic["img_path"]; ?>">
                <?php
                    $filters = json_decode($actPic["filter"], true);
                    foreach ($filters as $actFilter)
                    { ?>
                        <img class="imgFilter" src="../filters/<?= $actFilter["img"] ?>" style="width : <?= $actFilter["width"]; ?>; top : <?= $actFilter["yPos"]; ?>; left : <?= $actFilter["xPos"]; ?>;">
                    <?php } ?>
            </div>
    <?php }} else {?>
        <p> You need to be logged in to access this page</p>
    <?php } ?>
    <br>
<?php
    require_once "footer.php";
?>