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
    
    <?php


    try {
        include "./include/layout/header.php";
        if (isset($_SESSION["eml"])) {
    ?>

            <script>
                alert(" تا شما رمز عبور خود را تعویض نکنید نمی توانید به صفحه دیگری بروید ");
                location.replace("./change-password.php");
            </script>

        <?php
            die;
        }
        if (isset($_GET['category'])) {
            $categoryId = $_GET['category'];
            $posts = $db->prepare("SELECT * FROM posts WHERE category_id = :id ORDER BY id DESC");
            $posts->execute(['id' => $categoryId]);
        } else {
            $posts = $db->query("SELECT * FROM posts ");
        }
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        $e->getMessage();
        die;
    }

    ?>

    <main>

        <?php

        if (!isset($_GET["category"])) :
            include "./include/layout/slider.php";
        endif;

        ?>

        <!-- Content Section -->
        <section class="mt-4">
            <div class="row">
                <!-- Posts Content -->
                <div class="col-lg-8">
                    <div class="row g-3">
                        <?php if ($posts->rowCount() > 0) : ?>
                            <?php foreach ($posts as $post) : ?>
                                <?php
                                $categoryId = $post['category_id'];
                                $postCategory = $db->query("SELECT * FROM categories WHERE id = $categoryId")->fetch();
                                ?>

                                <div class="col-sm-6">
                                    <div class="card">
                                        <img src="./uploads/posts/<?= $post['image'] ?>" class="card-img-top" alt="post-image" />
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title fw-bold">
                                                    <?= $post['title'] ?>
                                                </h5>
                                                <div>
                                                    <span class="badge text-bg-secondary"><?= $postCategory['title'] ?></span>
                                                </div>
                                            </div>
                                            <p class="card-text text-secondary pt-3">
                                                <?= substr($post['body'], 0, 500) . "..." ?>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="single.php?post=<?= $post['id'] ?>" class="btn btn-sm btn-dark">مشاهده</a>

                                                <p class="fs-7 mb-0">
                                                    نویسنده : <?= $post['author'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <div class="col">
                                <div class="alert alert-danger">
                                    مقاله ای یافت نشد ....
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>

                <?php
                include "./include/layout/sidebar.php";
                ?>
            </div>
        </section>
    </main>


    <?php
    include "./include/layout/footer.php";
    ?>


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