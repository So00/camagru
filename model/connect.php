<?php

/**
 * Connect to db
 */

try
{
    $bdd = new PDO(
        'mysql:host=db;dbname=database',
        'root',
        'test'
    );
}
catch (Exception $e)
{
    die("Erreur : ".$e->getMessage());
}
?>