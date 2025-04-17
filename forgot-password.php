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
    $empty_fname = "";
    $empty_lname = "";
    $empty_username = "";
    $empty_email = "";
    $equal_fname_lname_username_password = "";
    $msg = "";

    if (isset($_POST["forgot_password"])) {
        if (empty(trim($_POST["fname"]))) {
            $empty_fname = " فیلد نام الزامیست ";
        } else if (empty(trim($_POST["lname"]))) {
            $empty_lname = " فیلد نام خانوادگی الزامیست ";
        } else if (empty(trim($_POST["username"]))) {
            $empty_username = " فیلد نام کاربری الزامیست ";
        } else if (empty(trim($_POST["email"]))) {
            $empty_email = " فیلد ایمیل الزامیست ";
        } else {

            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $username = $_POST["username"];
            $email = $_POST["email"];

            $query = $db->prepare("SELECT fname,lname,username,email FROM registers WHERE fname = :fname AND lname = :lname AND username = :username AND email = :email");

            $query->bindParam(":fname", $fname);
            $query->bindParam(":lname", $lname);
            $query->bindParam(":username", $username);
            $query->bindParam(":email", $email);
            $query->execute();

            if ($query->fetch()) {
                $msg = " تائید شما با موفقیت انجام شد ";
                $_SESSION["eml"] = $email;
                header("location:./change-password.php");
            } else {
                $equal_fname_lname_username_password = " اطلاعات وارد شده صحیح نمی باشد ";
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

            <div class="fs-5 fw-bold text-center mb-1"> رمز عبور خود را فراموش کرده اید ؟ </div>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_fname; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_lname; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_username; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_email; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $equal_fname_lname_username_password; ?> </p>
            <p class=" mt-3 mb-0 text-center fs-6 text text-success"> <?= $msg; ?> </p>

            <div class="mb-3">
                <label class="form-label"> نام </label>
                <input type="text" name="fname" class="form-control" />
            </div>

            <div class="mb-3">
                <label class="form-label"> نام خانوادگی </label>
                <input type="text" name="lname" class="form-control" />
            </div>

            <div class="mb-3">
                <label class="form-label"> نام کاربری </label>
                <input type="text" name="username" class="form-control" />
            </div>

            <div class="mb-3">
                <label class="form-label"> ایمیل </label>
                <input type="text" name="email" class="form-control" />
            </div>

            <button name="forgot_password" class="w-100 btn btn-dark mt-4" type="submit">
                تائید
            </button>

            <a class="w-100 btn btn-outline-dark dark mt-4" href="./login.php">
                بازگشت
            </a>
        </form>
    </main>

    <script src="<?= URL ?>/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>