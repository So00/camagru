<?php
    function escape_script($message)
    {
        return (str_replace(array("<", ">", "&", "\"", "'"), array("&lt;", "&gt;", "&amp;", "&quot;", "&apos;"), $message));
    }
?>