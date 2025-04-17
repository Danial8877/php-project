<?php

include "./include/config.php";
include "./include/db.php";

try {
    if (isset($_SESSION["eml"])) {
?>

        <script>
            alert(" تا شما رمز عبور خود را تعویض نکنید نمی توانید به صفحه دیگری بروید ");
            location.replace("./change-password.php");
        </script>

    <?php
        die;
    }
    $empty_username = "";
    $empty_password = "";
    $equal_username_password = "";
    $password_six = "";
    $msg = "";

    if (isset($_SESSION["public"])) {
        header("location:./404.php");
    } else if (isset($_SESSION["email"])) {
        header("location:./404.php");
    } else if (isset($_POST["sign_in"])) {
        if (empty(trim($_POST["username"]))) {
            $empty_username = " فیلد نام کاربری الزامیست ";
        } else if (empty(trim($_POST["password"]))) {
            $empty_password = " فیلد رمز عبور الزامیست ";
        } else {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $query = $db->prepare("SELECT username,password FROM registers WHERE username = :username AND password = :password");
            $query->bindParam(":username", $username);
            $query->bindParam(":password", $password);
            $query->execute();
            if ($query->fetch()) {
                $msg = " ورود شما با موفقیت انجام شد ";
                $_SESSION["public"] = $username;
                $_SESSION["psrwd"] = $password;
                header("location:./profile/index.php");
            } else {
                $equal_username_password = " نام کاربری یا رمز عبور صحیح نمی باشد ";
            }
        }
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
    <link rel="stylesheet" href="<?= URL ?>/assets/css/bootstrap.min.css">

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
    </style>

</head>

<body class="auth">
    <main class="form-signin w-100 m-auto">
        <form method="post">
            <div class="fs-2 fw-bold text-center mb-4"> ورود </div>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_username; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_password; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $equal_username_password; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-success"> <?= $msg; ?> </p>

            <div class="mb-3">
                <label class="form-label"> نام کاربری </label>
                <input type="text" name="username" class="form-control" />
            </div>

            <div class="mb-3">
                <label class="form-label">رمز عبور</label>
                <input type="password" name="password" class="form-control" />
            </div>
            <button name="sign_in" class="w-100 btn btn-dark mt-4" type="submit">
                ورود
            </button>

            <a class="w-100 btn btn-outline-dark dark mt-4" href="./forgot-password.php">
                رمز عبور خود را فراموش کرده اید ؟
            </a>

            <a class="w-100 btn btn-outline-dark dark mt-4" href="./register.php">
                حساب کاربری نداری ؟ یکی بساز
            </a>

            <a class="w-100 btn btn-outline-dark dark mt-4" href="./index.php">
                بازگشت
            </a>
        </form>
    </main>

    <script src="<?= URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>