<?php
include "../../include/layout/header.php";
try {
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

    $posts = $db->query("SELECT * FROM posts ORDER BY id DESC");
    $comments = $db->query("SELECT * FROM comments ORDER BY id DESC");
    $categories = $db->query("SELECT * FROM categories ORDER BY id DESC");
    $registers = $db->query("SELECT * FROM registers ORDER BY id DESC");
    $users = $db->query("SELECT * FROM users ORDER BY id DESC");
    $logs = $db->query("SELECT * FROM logs ORDER BY id DESC");


    $count_posts = $db->query("SELECT count(`count`) FROM posts");
    $count_comments = $db->query("SELECT count(`count`) FROM comments");
    $count_categories = $db->query("SELECT count(`count`) FROM categories");
    $count_registers = $db->query("SELECT count(`count`) FROM registers");
    $count_users = $db->query("SELECT count(`count`) FROM users");
    $count_logs = $db->query("SELECT count(`count`) FROM logs");

    $count_status_0 = $db->query("SELECT count(`status`) FROM comments WHERE status = 0");
    $count_status_1 = $db->query("SELECT count(`status`) FROM comments WHERE status = 1");

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
                <h1 class="fs-3 fw-bold"> گزارشات </h1>
            </div>

            <!-- Recently Posts -->
            <div class="mt-4">
                <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> گزارش مقالات </h4>
                <?php if ($posts->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-hover align-middle">
                            <tfoot>
                                <?php foreach ($count_posts as $count_post) : ?>
                                    <tr>
                                        <td> جمع کل : <?= $count_post['count(`count`)'] ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tfoot>
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
                <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> گزارش دسته بندی ها </h4>
                <?php if ($categories->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-hover align-middle">
                            <tfoot>
                                <?php foreach ($count_categories as $count_categorie) : ?>
                                    <tr>
                                        <td> جمع کل : <?= $count_categorie['count(`count`)'] ?></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tfoot>
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
                <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> گزارش کاربران </h4>
                <?php if ($registers->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-hover align-middle">
                            <tfoot>
                                <?php foreach ($count_registers as $count_register) : ?>
                                    <tr>
                                        <td> جمع کل : <?= $count_register['count(`count`)'] ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tfoot>
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
                <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> گزارش مدیران </h4>
                <?php if ($users->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-hover align-middle">
                            <tfoot>
                                <?php foreach ($count_users as $count_user) : ?>
                                    <tr>
                                        <td> جمع کل : <?= $count_user['count(`count`)'] ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tfoot>
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

            <!-- Recently logs -->
            <div class="mt-4">
                <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> گزارش تلاش ها </h4>
                <?php if ($logs->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-hover align-middle">
                            <tfoot>
                                <?php foreach ($count_logs as $count_log) : ?>
                                    <tr>
                                        <td> جمع کل : <?= $count_log['count(`count`)'] ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tfoot>
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

            <!-- Recently Comments -->
            <div class="mt-4">
                <h4 class="<?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> گزارش کامنت ها </h4>
                <?php if ($comments->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-hover align-middle">
                            <tfoot>
                                <tr>
                                    <?php foreach ($count_comments as $count_comment) : ?>

                                        <td> جمع کل : <?= $count_comment['count(`count`)'] ?></td>
                                        <td></td>
                                        <td></td>

                                    <?php endforeach; ?>
                                </tr>
                            </tfoot>
                            <tfoot>
                                <tr>
                                    <?php foreach ($count_status_0 as $count_0) : ?>

                                        <td> جمع نظرات درانتظار تائید : <?= $count_0['count(`status`)'] ?></td>
                                        <td></td>
                                        <td></td>

                                    <?php endforeach; ?>
                                </tr>
                            </tfoot>
                            <tfoot>
                                <tr>
                                    <?php foreach ($count_status_1 as $count_1) : ?>

                                        <td> جمع نظرات تائید شده : <?= $count_1['count(`status`)'] ?></td>
                                        <td></td>
                                        <td></td>

                                    <?php endforeach; ?>
                                </tr>
                            </tfoot>


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

        </main>
    </div>
</div>

<?php
include "../../include/layout/footer.php";
?>