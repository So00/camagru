<?php

/**
 * Connect to db
 */
function data()
{
    try {
        $bdd = new PDO(
            'mysql:host=db;dbname=database',
            'root',
            'test'
        );
        return ($bdd);
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>