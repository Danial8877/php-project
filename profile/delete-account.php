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

  if (isset($_POST["delete_user"])) {

    $delete_user = $db->prepare("DELETE FROM registers WHERE username = '" . $_SESSION["public"] . "' ");
    $delete_user->execute();

  ?>

    <script>
      alert(" اکنون شما حساب کاربری خود را حذف کردید و دیگر به آن دسترسی ندارید ! ");
      location.replace("../sign-up.php");
    </script>

  <?php

    unset($_SESSION["public"]);
    unset($_SESSION["psrwd"]);
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
    </style>
  </head>

  <body>
    <!-- best seller -->
    <div style="width: 100%; height: 100vh; text-align: center;">
      <div style="margin: 5px ; text-align: center;" class="top-article">
        <p class="text text-dark">ایا می خواهید حساب کاربری خود را حذف کنید ؟</p>
        <h1 class="text text-danger">
          نکته : اگر حساب کاربری خود را حذف کنید
          دیگر به آن دسترسی ندارید !
        </h1>
      </div>
      <section
        class="section-center"
        style="
          display: flex;
          flex-direction: column;
          flex-wrap: nowrap;
          align-content: center;
          justify-content: center;
          align-items: center;
          margin-top: 70px;
        ">
        <div class="clearfix">
          <article class="article" style="padding: 17px; margin: 13px">
            <div>
              <p class="art-p">حذف حساب کاربری</p>
            </div>
            <form method="post">
              <button type="submit" class="button bg-dark" name="delete_user"> حذف </button>
            </form>
          </article>
        </div>
        <br>
        <a style="color: var(--clr-primary-1);" href="./index.php"> بازگشت </a>
      </section>
    </div>
    <!-- end of best seller -->

  </body>

  </html>