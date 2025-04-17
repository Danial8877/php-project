<?php
include "./include/config.php";
include "./include/db.php";
try {

    if (!isset($_SESSION["eml"])) {
?>

        <script>
            location.replace("./index.php");
        </script>

        <?php
        die;
    }

    $empty_new_password = "";
    $empty_new_repassword = "";
    $equal_new_password = "";
    $password_six = "";
    $msg = "";

    if (isset($_POST["change_password"])) {
        if (empty(trim($_POST["new_password"]))) {
            $empty_new_password = " فیلد رمز عبور جدید الزامیست ";
        } else if (empty(trim($_POST["new_repassword"]))) {
            $empty_new_repassword = " فیلد رمز عبور جدید الزامیست ";
        } else {

            $new_password = $_POST["new_password"];
            $new_repassword = $_POST["new_repassword"];

            if ($new_password !== $new_repassword) {
                $equal_new_password = " رمز عبور جدید و تکرار آن برابر نمی باشد";
            } else if (strlen($new_password) < 6) {
                $password_six = " رمز عبور جدید شما باید حداقل 6 کاراکتر داشته باشد ";
            } else {

                $update_password = $db->prepare("UPDATE registers SET password = :password WHERE email = '" . $_SESSION["eml"] . "' ");
                $update_password->execute(["password" => $new_password]);

                $msg = " تعویض رمز عبور شما با موفقیت انجام شد ";
        ?>

                <script>
                    alert(" ذخیره شد ! لطفا وارد شوید تا اطلاعات بروزرسانی شود . ");
                    location.replace("./login.php");
                </script>

    <?php

                unset($_SESSION["eml"]);

                die;
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

            <div class="fs-2 fw-bold text-center mb-1"> تعویض رمز عبور </div>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $password_six; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_new_password; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $equal_new_password; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_new_repassword; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-success"> <?= $msg; ?> </p>

            <div class="mb-3">
                <label class="form-label"> رمز عبور جدید </label>
                <input type="password" name="new_password" class="form-control" />
            </div>

            <div class="mb-3">
                <label class="form-label"> تکرار رمز عبور جدید </label>
                <input type="password" name="new_repassword" class="form-control" />
            </div>

            <button name="change_password" class="w-100 btn btn-dark mt-4" type="submit">
                تعویض
            </button>

        </form>
    </main>

    <script src="<?= URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>