<?php
include "../../include/layout/header.php";
try {
    $users = $db->query("SELECT * FROM users ORDER BY id DESC");

    if (isset($_GET['action']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = $db->prepare('DELETE FROM users WHERE id = :id');

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
                <h1 class="fs-3 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?> fw-bold"> مدیران </h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="./create.php" class="btn btn-sm <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>">
                        ایجاد مدیر
                    </a>
                </div>
            </div>
            <form action="../excel/users.php" method="post">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="fw-bold"> خروجی : <a href="../word/users.php" class="btn btn-outline-primary"> WORD </a> &nbsp; <button name="ex_users" class="btn btn-outline-success"> EXCEL </button> &nbsp; <a onclick="window.print();" class="btn btn-outline-danger"> PDF </a> </h4>
                </div>
            </form>
            <!-- users -->
            <div class="mt-4">
                <?php if ($users->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th> ایمیل </th>
                                    <th> رمز عبور </th>
                                    <th>تاریخ</th>
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
                                            <a href="./edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-dark">ویرایش</a>
                                            <a href="index.php?action=delete&id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
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
        </main>
    </div>
</div>

<?php
include "../../include/layout/footer.php"
?>