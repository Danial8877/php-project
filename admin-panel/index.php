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

    .situation {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0px;
        margin: 0px;
        margin-top: 0;
        margin-bottom: 1rem;
    }

    .situation span {
        width: 17px;
        height: 17px;


        border-radius: 20px;
    }

    .situation p {
        margin-top: 0px;
        margin-bottom: 0rem;
        padding-left: 5px;
    }
</style>
<div id="before_load">
    <div class="spinner-border"></div>
    <br>
    <p style="color: white;" dir="rtl"> در حال بارگذاری ... </p>
</div>
<div id="after_load">
    <?php
    include "./include/layout/header.php";

    if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
        $entity = $_GET['entity'];
        $action = $_GET['action'];
        $id = $_GET['id'];

        if ($action == "delete") {
            switch ($entity) {
                case "post":
                    $query = $db->prepare('DELETE FROM posts WHERE id = :id');
                    break;
                case "comment":
                    $query = $db->prepare('DELETE FROM comments WHERE id = :id');
                    break;
                case "category":
                    $query = $db->prepare('DELETE FROM categories WHERE id = :id');
                    break;
                case "registers":
                    $query = $db->prepare('DELETE FROM registers WHERE id = :id');
                    break;
                case "users":
                    $query = $db->prepare('DELETE FROM users WHERE id = :id');
                    break;
                case "logs":
                    $query = $db->prepare('DELETE FROM logs WHERE id = :id');
                    break;
            }
        } elseif ($action == "approve") {
            $query = $db->prepare("UPDATE comments SET status = '1' WHERE id = :id");
        }

        $query->execute(['id' => $id]);
    }

    $posts = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 5");
    $comments = $db->query("SELECT * FROM comments ORDER BY id DESC LIMIT 5");
    $categories = $db->query("SELECT * FROM categories ORDER BY id DESC");
    $registers = $db->query("SELECT * FROM registers ORDER BY id DESC");
    $users = $db->query("SELECT * FROM users ORDER BY id DESC");
    $logs = $db->query("SELECT * FROM logs ORDER BY id DESC");


    ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Section -->
            <?php
            include "./include/layout/sidebar.php"
            ?>

            <!-- Main Section -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fs-3 fw-bold">داشبورد</h1>
                    <?php
                    $die = $db->prepare("SELECT situation FROM die");
                    $die->execute();
                    foreach ($die as $cls) {
                        if ($cls["situation"] === 1) {
                    ?>
                            <div class="situation">
                                <p class="fs-5 fw-bold"> فعال </p><span style="background: green;"></span>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="situation">
                                <p class="fs-5 fw-bold"> غیر فعال </p><span style="background: red;"></span>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>
                <form action="pages/excel/cetegories.php" method="post">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h3 class="fs-5 fw-bold"> خروجی : <a onclick="window.print();" class="btn btn-outline-danger <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>"> PDF </a> </h3>
                    </div>
                </form>
                <!-- Recently Posts -->
                <div class="mt-4">
                    <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> مقالات </h4>
                    <?php if ($posts->rowCount() > 0) : ?>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>عنوان</th>
                                        <th>نویسنده</th>
                                        <th> تاریخ </th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($posts as $post) : ?>
                                        <tr>
                                            <th><?= $post['id'] ?></th>
                                            <td><?= $post['title'] ?></td>
                                            <td><?= $post['author'] ?></td>
                                            <td><?= $post['time'] ?></td>
                                            <td>
                                                <a href="./pages/posts" class="btn btn-sm <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>"> مقالات </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="col">
                            <div class="alert alert-danger">
                                مقاله ای یافت نشد ....
                            </div>
                        </div>
                    <?php endif ?>
                </div>

                <!-- Categories -->
                <div class="mt-4">
                    <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold">دسته بندی</h4>
                    <?php if ($categories->rowCount() > 0) : ?>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>عنوان</th>
                                        <th> تاریخ </th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category) : ?>
                                        <tr>
                                            <th><?= $category['id'] ?></th>
                                            <td><?= $category['title'] ?></td>
                                            <td><?= $category['time'] ?></td>
                                            <td>
                                                <a href="./pages/categories" class="btn btn-sm <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>"> دسته بندی </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="col">
                            <div class="alert alert-danger">
                                دسته بندی یافت نشد ....
                            </div>
                        </div>
                    <?php endif ?>
                </div>

                <!-- Recently registers -->
                <div class="mt-4">
                    <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> کاربران </h4>
                    <?php if ($registers->rowCount() > 0) : ?>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>نام</th>
                                        <th> نام خانوادگی </th>
                                        <th> نام کاربری </th>
                                        <th> ایمیل </th>
                                        <th> رمز عبور </th>
                                        <th> تاریخ </th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($registers as $register) : ?>
                                        <tr>
                                            <th><?= $register['id'] ?></th>
                                            <td><?= $register['fname'] ?></td>
                                            <td><?= $register['lname'] ?></td>
                                            <td><?= $register['username'] ?></td>
                                            <td><?= $register['email'] ?></td>
                                            <td><?= $register['password'] ?></td>
                                            <td><?= $register['time'] ?></td>
                                            <td>
                                                <a href="./pages/registers" class="btn btn-sm <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>"> کاربران </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="col">
                            <div class="alert alert-danger">
                                کاربری یافت نشد ....
                            </div>
                        </div>
                    <?php endif ?>
                </div>

                <!-- Recently users -->
                <div class="mt-4">
                    <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> مدیران </h4>
                    <?php if ($users->rowCount() > 0) : ?>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th> ایمیل </th>
                                        <th> رمز عبور </th>
                                        <th> تاریخ </th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <th><?= $user['id'] ?></th>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['password'] ?></td>
                                            <td><?= $user['time'] ?></td>
                                            <td>
                                                <a href="./pages/users" class="btn btn-sm <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>"> مدیران </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="col">
                            <div class="alert alert-danger">
                                مدیری یافت نشد ....
                            </div>
                        </div>
                    <?php endif ?>
                </div>

                <!-- Recently Comments -->
                <div class="mt-4">
                    <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold">کامنت های اخیر</h4>
                    <?php if ($comments->rowCount() > 0) : ?>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>نام</th>
                                        <th>متن کامنت</th>
                                        <th> تاریخ </th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($comments as $comment) : ?>
                                        <tr>
                                            <th><?= $comment['id'] ?></th>
                                            <td><?= $comment['name'] ?></td>
                                            <td><?= $comment['comment'] ?></td>
                                            <td><?= $comment['time'] ?></td>
                                            <td>
                                                <a href="./pages/comments" class="btn btn-sm <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>"> نظرات </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="col">
                            <div class="alert alert-danger">
                                کامنتی یافت نشد ....
                            </div>
                        </div>
                    <?php endif ?>
                </div>

                <!-- Recently logs -->
                <div class="mt-4">
                    <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> تلاش ها برای ورود </h4>
                    <?php if ($logs->rowCount() > 0) : ?>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>IP</th>
                                        <th>ایمیل</th>
                                        <th>رمز عبور</th>
                                        <th> تاریخ </th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $log) : ?>
                                        <tr>
                                            <th><?= $log['id'] ?></th>
                                            <td><?= $log['IP'] ?></td>
                                            <td><?= $log['email'] ?></td>
                                            <td><?= $log['password'] ?></td>
                                            <td><?= $log['login_time'] ?></td>
                                            <th><a class="<?= $log['situation'] == "موفق" ? "btn btn-sm btn-success" : "btn btn-sm btn-danger" ?>"><?= $log['situation'] ?></a></th>
                                            <td>
                                                <a href="./pages/logs" class="btn btn-sm <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>"> تلاش ها </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="col">
                            <div class="alert alert-danger">
                                تلاشی یافت نشد ....
                            </div>
                        </div>
                    <?php endif ?>
                </div>

            </main>
        </div>
    </div>

    <?php
    include "./include/layout/footer.php"
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