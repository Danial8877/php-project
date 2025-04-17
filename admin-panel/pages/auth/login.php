<?php

include "../../include/config.php";
include "../../include/db.php";

try {

    if (isset($_SESSION["email"])) {
        header("location:" . URL . "");
    }

    if (isset($_SESSION["eml"])) {
?>

        <script>
            alert(" تا شما رمز عبور خود را تعویض نکنید نمی توانید به صفحه دیگری بروید ");
            location.replace("<?= URL ?>/change-password.php");
        </script>

    <?php
        die;
    }

    $invalidInputEmail = '';
    $invalidInputPassword = '';

    if (isset($_POST['login'])) {
        if (empty(trim($_POST['email']))) {
            $invalidInputEmail = "فیلد ایمیل ضروری هست";
        }

        if (empty(trim($_POST['password']))) {
            $invalidInputPassword = "فیلد رمز عبور ضروری هست";
        }

        if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $db->prepare("SELECT * FROM users WHERE email=:email AND password=:password ");
            $user->execute(['email' => $email, 'password' => $password]);

            if ($user->rowCount() == 1) {

                $logs = $db->prepare("SELECT * FROM logs");
                $logs->execute();

                $IP = $_SERVER['REMOTE_ADDR'];
                $log = $db->prepare("INSERT INTO logs (IP,situation,email,password) VALUES (:IP,:situation,:email,:password)");
                $log->execute(['IP' => $IP, "situation" => "موفق", 'email' => $email, 'password' => $password]);

                $_SESSION['email'] = $email;
                header("Location:../../index.php");
                exit();
            } else {
                $logs = $db->prepare("SELECT * FROM logs");
                $logs->execute();

                $IP = $_SERVER['REMOTE_ADDR'];
                $log = $db->prepare("INSERT INTO logs (IP,situation,email,password) VALUES (:IP,:situation,:email,:password)");
                $log->execute(['IP' => $IP, "situation" => "ناموفق", 'email' => $email, 'password' => $password]);
            }

            header("Location:login.php?err_msg=کاربری-با-این-اطلاعات-یافت-نشد");
            exit();
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

    <link rel="stylesheet" href="../../assets/css/style.css" />
</head>

<body class="auth">
    <main class="form-signin w-100 m-auto">
        <form method="post">
            <div class="fs-2 fw-bold text-center mb-4"> مدیریت </div>
            <?php if (isset($_GET['err_msg'])) : ?>
                <div class="alert alert-sm alert-danger">
                    <?= str_replace("-", " ",$_GET['err_msg']); ?>
                </div>
            <?php endif ?>
            <div class="mb-3">
                <label class="form-label">ایمیل</label>
                <input type="text" name="email" class="form-control" />
                <div class="form-text text-danger"><?= $invalidInputEmail ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">رمز عبور</label>
                <input type="password" name="password" class="form-control" />
                <div class="form-text text-danger"><?= $invalidInputPassword ?></div>
            </div>
            <button name="login" class="w-100 btn btn-dark mt-4" type="submit">
                ورود
            </button>
            <a href="<?= URL ?>" class="w-100 btn btn-outline-dark mt-4"> بازگشت </a>
        </form>
    </main>

    <script src="<?= URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>