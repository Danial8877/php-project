<?php

include "./include/config.php";
include "./include/db.php";

try {
    if (!isset($_SESSION["email"])) {
        header("location:" . URL . "");
    }

    if (isset($_POST["deletedb"])) {
        $deleteDB = $db->query("DROP DATABASE `php_course_blog`;");
        session_unset();
        session_destroy();
    }
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    $e->getMessage();
    die;
}



?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> WEB </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

    <style>
        .auth {
            margin-top: 70px;
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .alert-sm {
            font-size: 0.85rem;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        a {
            text-decoration: none;
        }
    </style>

</head>

<body class="auth">
    <main class="form-signin w-100 m-auto text-center">
        <form method="post">
            <div class="fs-4 fw-bold text-center mb-4"> ایا می خواهید کل دیتابیس را حذف کنید ؟ </div>
            <button class="w-30 btn btn-dark mt-4 p-3" name="deletedb">
                بله
            </button>
            <br>
            <br>
            <a class="w-20 text text-dark mt-4" href="./index.php">
                بازگشت
            </a>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>