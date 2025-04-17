<?php

include(__DIR__ . "/../config.php");
include(__DIR__ . "/../db.php");
if (isset($_SESSION["eml"])) {
?>

    <script>
        alert(" تا شما رمز عبور خود را تعویض نکنید نمی توانید به صفحه دیگری بروید ");
        location.replace("<?= URL ?>/change-password.php");
    </script>

<?php
    die;
}
$path = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['email'])) {
    if (str_contains($path, 'pages')) {
        header("location:" . URL . "");
    } else {
        header("Location:./pages/auth/login.php?err_msg=در-ابتدا-باید-وارد-سیستم-شوید");
    }
    exit();
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
    <?php if (str_contains($path, 'pages')) : ?>
        <link rel="stylesheet" href="../../assets/css/style.css" />
    <?php else : ?>
        <link rel="stylesheet" href="./assets/css/style.css" />
    <?php endif ?>

</head>

<body>
    <header class="navbar sticky-top <?= $bg_secondary ?> <?= $bg_warning ?> <?= $bg_danger ?> <?= $bg_primary ?> <?= $bg_success ?> flex-md-nowrap p-0 shadow-sm">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5 text-white" href="index.php">پنل ادمین</a>

        <button class="ms-2 nav-link px-3 text-white d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
            <i class="bi bi-justify-left fs-2"></i>
        </button>
    </header>