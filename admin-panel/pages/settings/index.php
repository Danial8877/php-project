<?php
include "../../include/layout/header.php";

try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    $e->getMessage();
    die;
}

if (isset($_POST["edit_settings"])) {

    $title_navbar = $_POST['title_navbar'];
    $description_about = $_POST['description_about'];
    $title_footer = $_POST['title_footer'];

    $setting = $db->prepare("UPDATE settings SET title_navbar = :title_navbar,description_about = :description_about, title_footer = :title_footer WHERE id=:id");
    $setting->execute( ["id" => 1, "title_navbar" => $title_navbar, "description_about" => $description_about, "title_footer" => $title_footer]);
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
                <h1 class="fs-3 fw-bold "> تنظیمات </h1>
            </div>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="fs-5 fw-bold "> موضوع </h1>
            </div>
            <!-- Posts -->
            <div class="mt-4">
                <?php
                $settings = $db->prepare('SELECT * FROM settings WHERE id = :id');
                $settings->execute(["id" => "1"]);
                foreach ($settings as $setting) :
                ?>
                    <form method="post" class="row g-4">
                        <div class="col-12 col-sm-6 col-md-12">
                            <label class="form-label"> مطلب ( اول سایت نام ) </label>
                            <input type="text" name="title_navbar" class="form-control" value="<?= $setting['title_navbar'] ?>" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-12">
                            <label class="form-label"> مطلب ( توضیحات درباره ما ) </label>
                            <textarea type="text" name="description_about" class="form-control" rows="4"><?= $setting['description_about'] ?></textarea>
                        </div>
                        <div class="col-12 col-sm-6 col-md-12">
                            <label class="form-label"> مطلب ( توضیحات اخر سایت ) </label>
                            <input type="text" name="title_footer" class="form-control" value="<?= $setting['title_footer'] ?>" />
                        </div>

                        <div class="col-12">
                            <button name="edit_settings" type="submit" class="btn <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>">
                                ویرایش
                            </button>
                            <a href="../../index.php" class="btn <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>">
                                بازگشت
                            </a>
                        </div>
                    </form>
                <?php endforeach ?>
            </div>
    </div>
    </main>
</div>
</div>

<?php
include "../../include/layout/footer.php"
?>