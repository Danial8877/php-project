<?php
include "../../include/layout/header.php";
try {
    $comments = $db->query("SELECT * FROM comments ORDER BY id DESC");

    if (isset($_GET['action']) && isset($_GET['id'])) {

        $action = $_GET['action'];
        $id = $_GET['id'];

        if ($action == "delete") {
            $query = $db->prepare('DELETE FROM comments WHERE id = :id');
        } else {
            $query = $db->prepare("UPDATE comments SET status='1' WHERE id = :id");
        }

        $query->execute(['id' => $id]);

        header("Location:index.php");
        exit();
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
                <h1 class="fs-3 fw-bold <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>">کامنت ها</h1>
            </div>
            <form action="../excel/comments.php" method="post">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="fw-bold"> خروجی : <a href="../word/comments.php" class="btn btn-outline-primary"> WORD </a> &nbsp; <button name="ex_comments" class="btn btn-outline-success"> EXCEL </button> &nbsp; <a onclick="window.print();" class="btn btn-outline-danger"> PDF </a> </h4>
                </div>
            </form>
            <!-- Comments -->
            <div class="mt-4">
                <?php if ($comments->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>نام</th>
                                    <th>متن کامنت</th>
                                    <th>تاریخ</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $comment) : ?>
                                    <tr>
                                        <th style="font-size: 14px;"><?= $comment['id'] ?></th>
                                        <td style="font-size: 14px;"><?= $comment['name'] ?></td>
                                        <td style="font-size: 14px;"><?= $comment['comment'] ?></td>
                                        <td style="font-size: 14px;"><?= $comment['time'] ?></td>
                                        <td style="font-size: 14px;">
                                            <?php if ($comment['status']) : ?>
                                                <button class="btn btn-sm btn-outline-dark disabled" style="font-size: 10px;">تایید شده</button>
                                                
                                            <?php else : ?>
                                                <a href="index.php?action=approve&id=<?= $comment['id'] ?>" style="font-size: 10px;" class="btn btn-sm btn-outline-info">در انتظار تایید</a>
                                            <?php endif ?>
                                            
                                            <a href="index.php?action=delete&id=<?= $comment['id'] ?>" style="font-size: 10px;" class="btn btn-sm btn-outline-danger">حذف</a>
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
        </main>
    </div>
</div>

<?php
include "../../include/layout/footer.php"
?>