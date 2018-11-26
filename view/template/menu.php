    <body>
        <?php 
            function active_link($actLink)
            {
                $url = $_SERVER["SCRIPT_NAME"];
                $url = substr($url, strrpos($url, "/") + 1);
                $link = "href=\"$actLink\""; 
                if ($actLink === $url)
                    return ($link." class=\"active\"");
                return ($link);
            }
        ?>
        <div class="container">
            <div class="menu">
                <a <?= active_link("accueil.php"); ?>> <span class="fa fa-home" aria-hidden="true"></span><br>Accueil</a>
                <a <?= active_link("gallery.php"); ?>> <span class="fa fa-picture-o" aria-hidden="true"></span><br>Gallery</a>
                <?php require_once "../../controler/choose_menu.php"?>
            </div>