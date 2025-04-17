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

  $empty_message = "";
  $img_jpg = "";
  $msg = "";
  if (isset($_POST["img_profile"])) {

    $tmp_name = $_FILES["img"]["tmp_name"];
    $filename = $_FILES["img"]["name"];
    $type = $_FILES["img"]["type"];
    if ($type == "image/png" || $type == "image/jpg" || $type == "image/jpeg") {
      mkdir("uploads/" . $_SESSION["public"] . "");
      move_uploaded_file($tmp_name, "uploads/" . $_SESSION["public"] . "/" . $_SESSION["public"] . ".jpg");
      $update = $db->prepare("UPDATE registers SET img = :img WHERE username = '" . $_SESSION["public"] . "' ");
      $update->execute(["img" => $_SESSION["public"] . ".jpg"]);
      header("location:./image-profile.php");
    } else {
      $img_jpg = " فایل ثبت شده دارای پسوند [ jpg ] و یا [ png ] و یا [ jpeg ] نمی باشد ";
    }
  }
  $select = $db->prepare("SELECT * FROM registers WHERE username = '" . $_SESSION["public"] . "' ");
  $select->execute();
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

      .form-control::-webkit-file-upload-button {
        border: none;
        background: var(--clr-grey-3);
        border-radius: var(--radius);
        direction: rtl;
      }

      .pro_img {
        height: 230px;
        width: 230px;
        border-radius: 100%;
        outline: var(--clr-primary-1);
        outline-width: 3px;
        outline-style: solid;
        outline-offset: 5px;
        transition: var(--transition);
        margin-top: 8px;
        margin-bottom: 8px;
      }

      .pro_img:hover {
        height: 230px;
        width: 230px;
        border-radius: 100%;
        outline: var(--clr-primary-2);
        outline-width: 3px;
        outline-style: solid;
        outline-offset: 8px;
        margin-top: 8px;
        margin-bottom: 8px;
      }
    </style>
  </head>

  <body style="background-color: var(--clr-grey-3)">
    <?php foreach ($select as $sel) : ?>
      <?php if (empty($sel["img"])) : ?>
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
              <h3> افزودن عکس پروفایل </h3>
              <br />
              <p class="msg-p"> <?= $msg; ?> </p>
              <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <p class="error-p"> <?= $empty_message; ?> </p>
                  <p class="error-p"> <?= $img_jpg; ?> </p>
                  <input type="file" name="img" class="form-control">
                </div>
                <button type="submit" name="img_profile" class="submit-btn"> ثبت </button>
              </form>
            </article>
            <br>
            <a style="color: var(--clr-primary-1);" href="./index.php"> بازگشت </a>
          </div>
        </section>
        <!-- end of contact us -->
      <?php else : ?>
        <?php
        if (isset($_POST["delete_profile"])) {
          $delete_profile = $db->prepare("UPDATE registers SET img = :img WHERE username = '" . $_SESSION["public"] . "'  ");
          $delete_profile->execute(["img" => '']);
          unlink("./uploads/" . $_SESSION["public"] . "/" . $_SESSION["public"] . ".jpg");
          header("location:./image-profile.php");
        }

        ?>
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
              <h3> مشاهده عکس پروفایل </h3>
              <br>
              <p class="error-p" style="color: var(--clr-gray-3);"> شما تصویر خود را ثبت کرده اید و برای ویرایش <br> آن باید تصویر فعلی را حذف کنید </p>
              <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <p style="    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
    align-items: center;">

                    <img class="pro_img" src="./uploads/<?= $_SESSION["public"]; ?>/<?= $_SESSION["public"] . ".jpg"; ?>" alt="<?= $sel["alt"]; ?>">

                  </p>
                </div>
                <button type="submit" name="delete_profile" class="submit-btn bg-dark"> حذف </button>
              </form>
            </article>
            <br>
            <a style="color: var(--clr-primary-1);" href="./index.php"> بازگشت </a>
          </div>
        </section>
        <!-- end of contact us -->
      <?php endif; ?>
    <?php endforeach; ?>
    <!-- end of contact us -->

  </body>

  </html>