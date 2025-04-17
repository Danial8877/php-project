<?php
include "../../include/layout/header.php";
try {
    $logs = $db->query("SELECT * FROM logs ORDER BY id DESC");

    if (isset($_GET['action']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = $db->prepare('DELETE FROM logs WHERE id = :id');

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
                <h1 class="fs-3 fw-bold <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"> تلاش ها </h1>

            </div>
            <form action="../excel/logs.php" method="post">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="fw-bold"> خروجی : <a href="../word/logs.php" class="btn btn-outline-primary"> WORD </a> &nbsp; <button name="ex_logs" class="btn btn-outline-success"> EXCEL </button> &nbsp; <a onclick="window.print();" class="btn btn-outline-danger"> PDF </a> </h4>
                </div>
            </form>
            <!-- logs -->
            <div class="mt-4">
                <?php if ($logs->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>IP</th>
                                    <th>ایمیل</th>
                                    <th>رمز عبور</th>
                                    <th>تاریخ</th>
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
                                            <a href="index.php?action=delete&id=<?= $log['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="col">
                        <div class="alert alert-danger">
                            تلاشی بندی یافت نشد ....
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