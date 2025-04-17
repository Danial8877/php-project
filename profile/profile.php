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

  $query = $db->prepare("SELECT * FROM registers WHERE username = '" . $_SESSION["public"] . "' LIMIT 1 ");
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
    <br>
    <br>
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
          <h3> اطلاعات ثبت شده </h3>
          <form method="post">
            <div class="form-group">

              <?php foreach ($query as $user) : ?>
                <p
                  class="form-control"
                  style="padding: 8px;">
                  نام : <?= $user["fname"]; ?>
                </p>
                <p
                  class="form-control"
                  style="padding: 8px;">
                  نام خانوادگی : <?= $user["lname"]; ?>
                </p>
                <p
                  class="form-control"
                  style="padding: 8px;">
                  نام کاربری : <?= $user["username"]; ?>
                </p>
                <p
                  class="form-control"
                  style="padding: 8px;">
                  ایمیل : <?= $user["email"]; ?>
                </p>
              <?php endforeach; ?>
            </div>
          </form>
        </article>
        <br>
        <a style="color: var(--clr-primary-1);" href="./index.php"> بازگشت </a>
      </div>
    </section>
    <!-- end of contact us -->

  </body>

  </html>