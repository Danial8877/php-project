<?php

try {

    $db = new PDO(DNS, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    session_start();

    if (isset($_SESSION["warning"])) {
        $warning = "text-warning";
    } else if (isset($_SESSION["danger"])) {
        $danger = "text-danger";
    } else if (isset($_SESSION["primary"])) {
        $primary = "text-primary";
    } else if (isset($_SESSION["success"])) {
        $success = "text-success";
    } else {
        $secondary = "text-secondary";
    }

    if (isset($_SESSION["warning"])) {
        $bg_warning = "bg-warning";
    } else if (isset($_SESSION["danger"])) {
        $bg_danger = "bg-danger";
    } else if (isset($_SESSION["primary"])) {
        $bg_primary = "bg-primary";
    } else if (isset($_SESSION["success"])) {
        $bg_success = "bg-success";
    } else {
        $bg_secondary = "bg-secondary";
    }

    if (isset($_SESSION["warning"])) {
        $btn_warning = "btn-outline-warning";
    } else if (isset($_SESSION["danger"])) {
        $btn_danger = "btn-outline-danger";
    } else if (isset($_SESSION["primary"])) {
        $btn_primary = "btn-outline-primary";
    } else if (isset($_SESSION["success"])) {
        $btn_success = "btn-outline-success";
    } else {
        $btn_secondary = "btn-outline-secondary";
    }
} catch (PDOException $e) {
    $e->getMessage();
    die;
}
