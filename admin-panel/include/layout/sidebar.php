<?php
$path = $_SERVER['REQUEST_URI'];

if (isset($_POST["logout"])) {
    unset($_SESSION["email"]);
    header("location:" . URL . "");
}

if (isset($_POST["delete_clr"])) {
    unset($_SESSION["warning"]);
    unset($_SESSION["danger"]);
    unset($_SESSION["primary"]);
    unset($_SESSION["success"]);
    header("location:./index.php");
}

?>
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
        </div>

        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column pe-3">
                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'pages') ? '' : 'text-secondary' ?>" href="<?= URL ?>/admin-panel/index.php">
                        <i class="bi bi-house-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>
                        <span class="fw-bold ">داشبورد</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'posts') ? 'text-secondary' : '' ?>" href="<?= URL ?>/admin-panel/pages/posts/index.php">
                        <i class="bi bi-file-earmark-image-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>
                        <span class="fw-bold">مقالات</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'categories') ? 'text-secondary' : '' ?>" href="<?= URL ?>/admin-panel/pages/categories/index.php">
                        <i class="bi bi-folder-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold">دسته بندی</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'registers') ? 'text-secondary' : '' ?>" href="<?= URL ?>/admin-panel/pages/registers/index.php">
                        <i class="bi bi-file-earmark-person-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold"> کاربران </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'users') ? 'text-secondary' : '' ?>" href="<?= URL ?>/admin-panel/pages/users/index.php">
                        <i class="bi bi-file-person-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold"> مدیران </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'comments') ? 'text-secondary' : '' ?>"" href=" <?= URL ?>/admin-panel/pages/comments/index.php">
                        <i class="bi bi-chat-left-text-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold">کامنت ها</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'logs') ? 'text-secondary' : '' ?>"" href=" <?= URL ?>/admin-panel/pages/logs/index.php">
                        <i class="bi bi-repeat fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold"> تلاش ها </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'reports') ? 'text-secondary' : '' ?>"" href=" <?= URL ?>/admin-panel/pages/reports/index.php">
                        <i class="bi bi-envelope-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold"> گزارشات </span>
                    </a>
                </li>

                <?php if (isset($_SESSION["warning"]) || isset($_SESSION["danger"]) || isset($_SESSION["primary"]) || isset($_SESSION["success"])) : ?>

                    <li class="nav-item">
                        <form method="post">
                            <button class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'colors') ? 'text-secondary' : '' ?>"" type=" submit" name="delete_clr">
                                <i class="bi bi-palette-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                                <span class="fw-bold"> حذف رنگ </span>
                            </button>
                        </form>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'colors') ? 'text-secondary' : '' ?>"" href=" <?= URL ?>/admin-panel/pages/colors/index.php">
                            <i class="bi bi-palette-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                            <span class="fw-bold"> رنگ ها </span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a onclick="window.print();" class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'print') ? 'text-secondary' : '' ?>"" href="">
                        <i class=" bi bi-printer-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold"> پرینت </span>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'die') ? 'text-secondary' : '' ?>"" href=" <?= URL ?>/admin-panel/die.php">
                        <i class="bi bi-x-octagon-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold"> بستن سایت </span>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'drop') ? 'text-secondary' : '' ?>"" href=" <?= URL ?>/admin-panel/drop-db.php">
                        <i class="bi bi-trash3-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold"> حذف اطلاعات </span>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'die') ? 'text-secondary' : '' ?>"" href=" <?= URL ?>/admin-panel/pages/settings/index.php">
                        <i class="bi bi-gear-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold"> تنظیمات </span>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2" href="<?= URL ?>/index.php">
                        <i class="bi bi-door-open-fill fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                        <span class="fw-bold"> بازگشت به فروشگاه </span>
                    </a>
                </li>

                <li class="nav-item">
                    <form method="post">
                        <button name="logout" class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2">
                            <i class="bi bi-box-arrow-right fs-4 <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"></i>

                            <span class="fw-bold">خروج</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>