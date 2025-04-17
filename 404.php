<?php

include "./include/config.php";
include "./include/db.php";

if (isset($_SESSION["eml"])) {
?>

    <script>
        alert(" تا شما رمز عبور خود را تعویض نکنید نمی توانید به صفحه دیگری بروید ");
        location.replace("./change-password.php");
    </script>

<?php

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
            width: 100%;
            height: 100vh;
            display: flex;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
            flex-direction: column;
            flex-wrap: nowrap;
            align-content: center;
            align-items: center;
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

        a {
            text-decoration: none;
        }
    </style>

</head>

<body class="auth">
    <main class="form-signin w-100 m-auto text-center">
        <form method="post">
            <div class="fs-4 fw-bold text-center mb-4"> چنین صفحه ای وجود ندارد ! </div>
            <button class="w-30 btn btn-dark mt-4 p-3">
                404
            </button>
            <br>
            <br>
            <a class="w-20 text text-dark mt-4" href="./index.php">
                بازگشت
            </a>
        </form>
    </main>

    <script src="<?= URL ?>/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>