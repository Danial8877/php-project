<?php
include "../../include/layout/header.php";
try {
    if (isset($_GET['id'])) {
        $usersid = $_GET['id'];

        $users = $db->prepare('SELECT * FROM users WHERE id = :id');
        $users->execute(['id' => $usersid]);
        $users = $users->fetch();
    }

    $empty_fname = "";
    $empty_lname = "";
    $empty_username = "";
    $empty_email = "";
    $empty_password = "";
    $equal_password = "";
    $equal_username_email = "";
    $equal_password_fname_lname = "";
    $email_ok = "";
    $password_six = "";
    $int_fname = "";
    $int_lname = "";
    $number = "";
    $msg = "";

    if (isset($_POST["editusers"])) {
        if (empty(trim($_POST["email"]))) {
            $empty_email = " فیلد ایمیل الزامیست ";
        } else if (empty(trim($_POST["password"]))) {
            $empty_password = " فیلد رمز عبور الزامیست ";
        } else {

            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            $sign_up = $db->prepare("UPDATE users SET email = :email , password = :password WHERE id = :id");
            $sign_up->execute(["email" => $email, "password" => $password, "id" => $usersid]);
            $msg = " ثبت نام شما با موفقیت انجام شد ";
            header("Location:index.php");
            exit();
        }
    }
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    $e->getMessage();
    die;
}


?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Section -->
        <?php
        include "../../include/layout/sidebar.php"
        ?>

        <!-- Main Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">ویرایش کاربران </h1>
            </div>

            <!-- Posts -->
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
            <p class=" mt-3 mb-0 text-center fs-6 text text-success"> <?= $msg; ?> </p>
            <div class="mt-4">
                <form method="post" class="row g-4">

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label"> ایمیل </label>
                        <input type="text" name="email" value="<?= $users["email"]; ?>" class="form-control" />
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label"> رمز عبور </label>
                        <input type="text" name="password" value="<?= $users["password"]; ?>" class="form-control" />
                    </div>

                    <div class="col-12">
                        <button name="editusers" type="submit" class="btn <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>">
                            ویرایش
                        </button>
                        <a href="./index.php" class="btn <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>">
                            بازگشت
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<?php
include "../../include/layout/footer.php"
?>