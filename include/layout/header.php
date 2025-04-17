<?php
include "./include/config.php";
include "./include/db.php";

$query = "SELECT * FROM categories";
$categories = $db->query($query);

// echo "<pre>";
// print_r($categories->fetchAll());

if (isset($_SESSION["public"])) {
    $registers = $db->prepare("SELECT * FROM registers WHERE username = '" . $_SESSION["public"] . "' ");
    $registers->execute();
}

if (isset($_POST["logout"])) {
    unset($_SESSION["public"]);
    unset($_SESSION["psrwd"]);
    unset($_SESSION["email"]);
    header("location:" . URL . "");
}

?>

<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> WEB </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?= URL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css" />

    <style>
        a {
            text-decoration: none;
        }

        .txt-a:hover {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container py-3">
        <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom" style="display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: space-around;align-items: center;">
            <div> <a href="index.php" class="fs-4 fw-medium link-body-emphasis text-decoration-none">
                    <?php
                    $settings = $db->prepare('SELECT * FROM settings WHERE id = :id');
                    $settings->execute(["id" => "1"]);
                    foreach ($settings as $setting) :
                    ?>
                        <?= $setting["title_navbar"]; ?>
                    <?php endforeach; ?>
                </a></div>

            <div>
                <nav class="d-inline-flex mt-2 mt-md-0 me-md-auto">
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none <?= (!isset($_GET['category'])) ? 'fw-bold' : '' ?>" href="index.php" href="index.php"> خانه </a>
                    <?php if ($categories->rowCount() > 0) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <a class="me-3 py-2 link-body-emphasis text-decoration-none <?= (isset($_GET['category'])) && $category['id'] == $_GET['category'] ? 'fw-bold' : '' ?>" href="index.php?category=<?= $category['id'] ?>"><?= $category['title'] ?></a>
                        <?php endforeach ?>
                    <?php endif ?>
                </nav>
            </div>
            <?php if (isset($_SESSION["public"])) : ?>
                <?php foreach ($registers as $register) : ?>
                    <form method="post">
                        <a class="btn btn-outline-dark txt-a" href="<?= URL ?>/profile/index.php"> پروفایل </a> &nbsp; | &nbsp; <button class="btn btn-outline-dark" name="logout"> خروج </button>
                    </form>
                <?php endforeach; ?>

            <?php else : ?>
                <?php if (!isset($_SESSION["email"])) : ?>
                    <div>
                        <a class="btn btn-outline-dark txt-a" href="./login.php"> ورود </a> &nbsp; | &nbsp; <a class="btn btn-outline-dark txt-a" href="./register.php"> ثبت&zwnj;نام </a>
                    </div>
                <?php else : ?>
                    <form method="post">
                        <a href="./admin-panel/" class="btn btn-outline-dark"> مدیریت </a> &nbsp; | &nbsp; <button class="btn btn-outline-dark txt-a" name="logout"> خروج </button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>

        </header>