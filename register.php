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
    $empty_password = "";
    $empty_repassword = "";
    $equal_password = "";
    $equal_username_email = "";
    $equal_password_fname_lname = "";
    $email_ok = "";
    $password_six = "";
    $int_fname = "";
    $int_lname = "";
    $number = "";
    $msg = "";

    if (isset($_SESSION["public"])) {
        header("location:./404.php");
    } else if (isset($_SESSION["email"])) {
        header("location:./404.php");
    } else if (isset($_POST["sign_up"])) {
        $checkbox_error = " من رباط نیستم  ";
        if (empty(trim($_POST["fname"]))) {
            $empty_fname = " فیلد نام الزامیست ";
        } else if (empty(trim($_POST["lname"]))) {
            $empty_lname = " فیلد نام خانوادگی الزامیست ";
        } else if (empty(trim($_POST["username"]))) {
            $empty_username = " فیلد نام کاربری الزامیست ";
        } else if (empty(trim($_POST["email"]))) {
            $empty_email = " فیلد ایمیل الزامیست ";
        } else if (empty(trim($_POST["password"]))) {
            $empty_password = " فیلد رمز عبور الزامیست ";
        } else if (empty(trim($_POST["repassword"]))) {
            $empty_repassword = " فیلد تکرار رمز عبور الزامیست ";
        } else {

            $fname = trim($_POST["fname"]);
            $lname = trim($_POST["lname"]);
            $username = trim($_POST["username"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            $repassword = trim($_POST["repassword"]);

            $equal_username = $db->prepare("SELECT username FROM registers WHERE username = :username");
            $equal_username->bindParam(":username", $username);

            $equal_email = $db->prepare("SELECT email FROM registers WHERE email = :email");
            $equal_email->bindParam(":email", $email);

            $equal_email->execute();
            $equal_username->execute();

            if ($fname == intval($fname)) {
                $int_fname = " شما باید فیلد نام را به صورت متن و صحیح وارد نمایید ";
            } else if ($fname == floatval($fname)) {
                $int_fname = " شما باید فیلد نام خانوادگی را به صورت متن و صحیح وارد نمایید ";
            } else if ($lname == intval($lname)) {
                $int_lname = " شما باید فیلد نام خانوادگی را به صورت متن و صحیح وارد نمایید ";
            } else if ($lname == floatval($lname)) {
                $int_lname = " شما باید فیلد نام خانوادگی را به صورت متن و صحیح وارد نمایید ";
            } else if ($password !== $repassword) {
                $equal_password = " رمز عبور و تکرار آن برابر نمی باشد ";
            } else if ($equal_username->fetch()) {
                $equal_username_email = " این نام کاربری یا ایمیل برای شخص دیگری می باشد ";
            } else if ($equal_email->fetch()) {
                $equal_username_email = " این نام کاربری یا ایمیل برای شخص دیگری می باشد ";
            } else if (strlen($fname) <= 2) {
                $number = " فیلد نام صحیح نمی باشد ";
            } else if (strlen($lname) <= 2) {
                $number = " فیلد نام خانوادگی صحیح نمی باشد ";
            } else if (strlen($username) <= 2) {
                $number = " فیلد نام کاربری صحیح نمی باشد ";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_ok = " ایمیل وارد شده نا معتبر می باشد ";
            } else if ($fname == $password) {
                $equal_password_fname_lname = " شما نمی توانید نام و یا نام خانوادگی خود را برای رمز عبور در نظر بگیرید ";
            } else if ($lname == $password) {
                $equal_password_fname_lname = " شما نمی توانید نام و یا نام خانوادگی خود را برای رمز عبور در نظر بگیرید ";
            } else if (strlen($password) < 6) {
                $password_six = " رمز عبور شما باید حداقل 6 کاراکتر داشته باشد ";
            } else {
                $sign_up = $db->prepare("INSERT INTO registers (fname,lname,username,email,password) VALUES (:fname,:lname,:username,:email,:password) ");
                $sign_up->execute(["fname" => $fname, "lname" => $lname, "username" => $username, "email" => $email, "password" => $password]);
                $msg = " ثبت نام شما با موفقیت انجام شد ";
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

            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
            flex-direction: column;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: center;

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

        .dis {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-content: center;
            justify-content: center;
            align-items: center;
        }

        .dis div {
            margin: 30px;
        }

        .form-control::placeholder {
            color: red;
        }

        @media screen and (max-width: 725px) {
            .auth {
                margin-top: 70px;
                display: flex;
                align-items: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
                flex-direction: column;
                flex-wrap: nowrap;
                align-content: center;
                justify-content: center;
                margin-top: -40px;
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

            .dis {
                display: block;
            }

            .dis div {
                margin: 30px;
            }
        }
    </style>

</head>

<body class="auth container">
    <form method="post">
        <div class="fs-2 fw-bold text-center"> ثبت نام </div>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_fname; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $int_fname; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_lname; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $int_lname; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_username; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $equal_username_email; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $number; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_email; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $email_ok; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $equal_password_fname_lname; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_password; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $password_six; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-danger"> <?= $empty_repassword; ?> </p>
        <p class=" mt-3 mb-0 text-center fs-6 text text-success"> <?= $msg; ?> </p>
        <section class="dis">

            <div>
                <div class="mb-3">
                    <label class="form-label"> نام</label>
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
            </div>

            <div>
                <div class="mb-3">
                    <label class="form-label">ایمیل</label>
                    <input type="text" name="email" class="form-control" />

                </div>

                <div class="mb-3">
                    <label class="form-label">رمز عبور</label>
                    <input type="password" name="password" class="form-control" />

                </div>

                <div class="mb-3">
                    <label class="form-label"> تکرار رمز عبور </label>
                    <input type="password" name="repassword" class="form-control" />

                </div>
            </div>

        </section>
        <button name="sign_up" class="w-100 btn btn-dark mt-2" type="submit">
            ثبت نام
        </button>

        <a class="w-100 btn btn-outline-dark dark mt-4" href="./login.php">
            حساب کاربری داری ؟ پس وارد شو
        </a>

        <a class="w-100 btn btn-outline-dark dark mt-4" href="./index.php">
            بازگشت
        </a>
    </form>


    <script src="<?= URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>