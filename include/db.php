<?php

try {

    $db = new PDO(DNS, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $die = $db->prepare("SELECT situation FROM die");
    $die->execute();

    foreach ($die as $cls) {
        if ($cls["situation"] === 0) {
            die;
        }
    }

    session_start();
} catch (PDOException $e) {
    $e->getMessage();
    die;
}
