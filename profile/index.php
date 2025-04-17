<style>
    @font-face {
        font-family: "Vazir";
        src: url("./assets/fonts/Vazir.eot");
        /* IE9 Compat Modes */
        src: url("./assets/fonts/Vazir.eot?#iefix") format("embedded-opentype"),
            url("./assets/fonts/Vazir.woff2") format("woff2"),
            url("./assets/fonts/Vazir.woff") format("woff"),
            url("./assets/fonts/Vazir.ttf") format("truetype");
        /* Safari, Android, iOS */
    }

    * {
        font-family: "Vazir", sans-serif;
    }

    * {
        padding: 0px;
        margin: 0px;
    }

    @-webkit-keyframes spinner-border {
        to {
            transform: rotate(360deg)
        }
    }

    @keyframes spinner-border {
        to {
            transform: rotate(360deg)
        }
    }

    .spinner-border {
        display: inline-block;
        width: 2rem;
        height: 2rem;
        vertical-align: -.125em;
        border: .25em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        -webkit-animation: .75s linear infinite spinner-border;
        animation: .75s linear infinite spinner-border;
        color: white;
    }

    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: .2em
    }

    #before_load {
        width: 100%;
        height: 100vh;
        background: #1b1b1b;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }
</style>
<div id="before_load">
    <div class="spinner-border"></div>
    <br>
    <p style="color: white;" dir="rtl"> در حال بارگذاری ... </p>
</div>
<div id="after_load">
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

  if (!isset($_SESSION["public"])) {
    header("location:../404.php");
    die;
  }

  if (isset($_POST["logout"])) {
  ?>

    <script>
      location.replace("../index.php");
    </script>

  <?php
    unset($_SESSION["public"]);
    unset($_SESSION["psrwd"]);
  }

  $query = $db->prepare("SELECT * FROM registers WHERE username = '" . $_SESSION["public"] . "' ");
  $query->execute();

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
    </style>
  </head>

  <body>
    <!-- best seller -->

    <div style="margin: 5px;" class="top-article text text-dark">
      <p class="text text-dark"> پروفایل </p>
      <?php foreach ($query as $fullname) : ?>
        <h1 style="display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;"> خوش&zwnj;آمدی <?= $fullname["fname"] . " " . $fullname["lname"]; ?> </h1>
      <?php endforeach; ?>
    </div>
    <section class="section-center" style="padding: 40px">
      <div class="clearfix">
        <article class="article" style="padding: 20px; margin: 10px">
          <div>
            <p class="art-p">مشاهده اطلاعات ثبت شده</p>
          </div>
          <a href="./profile.php" class="btn bg-dark"> مشاهده </a>
        </article>
        <article class="article" style="padding: 20px; margin: 10px">
          <div>
            <p class="art-p"> افزودن عکس پروفایل </p>
          </div>
          <a href="./image-profile.php" class="btn bg-dark"> افزودن </a>
        </article>
        <article class="article" style="padding: 20px; margin: 10px">
          <div>
            <p class="art-p">ویرایش رمز عبور</p>
          </div>
          <a href="./edit-password.php" class="btn bg-dark"> ویرایش </a>
        </article>
        <article class="article" style="padding: 20px; margin: 10px">
          <div>
            <p class="art-p">حذف حساب کاربری</p>
          </div>
          <a href="./delete-account.php" class="btn bg-dark"> حذف </a>
        </article>
        <article class="article" style="padding: 20px; margin: 10px">
          <div>
            <p class="art-p"> بازگشت </p>
          </div>
          <a href="<?= URL ?>" class="btn bg-dark"> تائید </a>
        </article>
        <article class="article" style="padding: 20px; margin: 10px">
          <div>
            <p class="art-p">خروج</p>
          </div>
          <form method="post">
            <button type="submit" class="button bg-dark" name="logout"> خروج </button>
          </form>
        </article>
      </div>
    </section>

    <!-- end of best seller -->

  </body>

  </html>

</div>
<script>
  const before_load = document.getElementById("before_load");
  const after_load = document.getElementById("after_load");
  after_load.style.display = "none";
  before_load.style.display = "";
  window.onload = function() {
    before_load.style.display = "none";
    after_load.style.display = "";
  }
</script>