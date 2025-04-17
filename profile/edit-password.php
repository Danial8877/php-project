  <!-- db -->
  <?php
  include "../include/config.php";
  include "../include/db.php"; ?>
  <!-- end of db -->
  <?php
  if (isset($_SESSION["eml"])) {
  ?>

    <script>
      alert(" تا شما رمز عبور خود را تعویض نکنید نمی توانید به صفحه دیگری بروید ");
      location.replace("../change-password.php");
    </script>

  <?php
    die;
  }
  ?>
  <?php

  if (!isset($_SESSION["public"]) && !isset($_SESSION["psrwd"])) {
    header("location:../404.php");
    die;
  }

  $empty_password = "";
  $empty_new_password = "";
  $empty_new_repassword = "";
  $equal_new_password = "";
  $password_ok = "";
  $password_six = "";
  $msg = "";

  if (isset($_POST["edit_password"])) {
    if (empty(trim($_POST["password"]))) {
      $empty_password = " فیلد رمز عبور فعلی الزامیست ";
    } else if (empty(trim($_POST["new_password"]))) {
      $empty_new_password = " فیلد رمز عبور جدید الزامیست ";
    } else if (empty(trim($_POST["new_repassword"]))) {
      $empty_new_repassword = " فیلد رمز عبور جدید الزامیست ";
    } else {
      $password = $_POST["password"];
      $new_password = $_POST["new_password"];
      $new_repassword = $_POST["new_repassword"];
      if ($password !== $_SESSION["psrwd"]) {
        $password_ok = " رمز عبور فعلی صحیح نمی باشد ";
      } else if ($new_password !== $new_repassword) {
        $equal_new_password = " رمز عبور جدید و تکرار آن برابر نمی باشد";
      } else if (strlen($new_password) < 6) {
        $password_six = " رمز عبور جدید شما باید حداقل 6 کاراکتر داشته باشد ";
      } else {

        $update_password = $db->prepare("UPDATE registers SET password = :password WHERE password = '" . $_SESSION["psrwd"] . "' ");
        $update_password->execute(["password" => $new_password]);
        $msg = " ویرایش رمز عبور شما با موفقیت انجام شد ";
  ?>

        <script>
          alert(" ذخیره شد ! لطفا دوباره وارد شوید تا اطلاعات بروزرسانی شود . ");
          location.replace("../sign-in.php");
        </script>

  <?php
        unset($_SESSION["public"]);
        unset($_SESSION["psrwd"]);
      }
    }
  }

  ?>
  <!DOCTYPE html>
  <html lang="fa" dir="rtl">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> WEB </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

    <link rel="stylesheet" href="./css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <style>
      a {
        text-decoration: none;
      }

      .txt-a:hover {
        color: white;
      }

      .clearfix {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-content: center;
        justify-content: center;
        align-items: center;
      }
    </style>
  </head>

  <body style="background-color: var(--clr-grey-3)">
    <!-- contact us -->

    <section
      class="contact"
      style="
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
      ">
      <div class="section-center clearfix">
        <article class="contact-info"></article>

        <article class="contact-form">
          <h3> ویرایش رمز عبور </h3>
          <br />
          <p class="msg-p"> <?= $msg; ?> </p>
          <form method="post">
            <div class="form-group">
              <p class="error-p"> <?= $empty_password; ?> </p>
              <p class="error-p"> <?= $password_ok; ?> </p>
              <input
                class="form-control"
                type="password"
                placeholder=" رمز عبور فعلی "
                name="password" />
              <p class="error-p"> <?= $empty_new_password; ?> </p>
              <p class="error-p"> <?= $equal_new_password; ?> </p>
              <p class="error-p"> <?= $password_six; ?> </p>
              <input
                class="form-control"
                type="password"
                placeholder=" رمز عبور جدید"
                name="new_password" />
              <p class="error-p"> <?= $empty_new_repassword; ?> </p>
              <p class="error-p"> <?= $equal_new_password; ?> </p>
              <p class="error-p"> <?= $password_six; ?> </p>
              <input
                class="form-control"
                type="password"
                placeholder=" تکرار رمز عبور جدید"
                name="new_repassword" />
              <!-- <textarea
                name="message"
                placeholder="متن پیام"
                class="form-control"
                rows="5"
              ></textarea> -->
            </div>
            <button type="submit" name="edit_password" class="submit-btn bg-dark"> ویرایش </button>
          </form>
        </article>
        <br>
        <a style="color: var(--clr-primary-1);" href="./index.php"> بازگشت </a>
      </div>
    </section>
    <!-- end of contact us -->

  </body>

  </html>