<?php

include "../../include/layout/header.php";
try {
    if (isset($_POST["warning"])) {
        $_SESSION["warning"] = $_POST["warning"];
        header("location:../../index.php");
    }

    if (isset($_POST["danger"])) {
        $_SESSION["danger"] = $_POST["danger"];
        header("location:../../index.php");
    }

    if (isset($_POST["primary"])) {
        $_SESSION["primary"] = $_POST["primary"];
        header("location:../../index.php");
    }

    if (isset($_POST["success"])) {
        $_SESSION["success"] = $_POST["success"];
        header("location:../../index.php");
    }

    if (isset($_POST["delete_clr"])) {
        unset($_SESSION["warning"]);
        unset($_SESSION["danger"]);
        unset($_SESSION["primary"]);
        unset($_SESSION["success"]);
        header("location:./index.php");
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
                <h1 class="fs-3 fw-bold <?= $secondary ?> <?= $warning ?> <?= $danger ?> <?= $primary ?> <?= $success ?>"> رنگ ها </h1>
            </div>
            <?php if (isset($_SESSION["warning"]) || isset($_SESSION["danger"]) || isset($_SESSION["primary"]) || isset($_SESSION["success"])) : ?>
                <div style="    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: center;
    justify-content: space-around;
    align-items: center;">
                    <!-- Recently yellow -->
                    <div class="mt-4 m-5">
                        <h4 class="text fw-bold"> حذف رنگ </h4>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <form method="post">
                                    <button class="btn <?= $btn_secondary ?> <?= $btn_warning ?> <?= $btn_danger ?> <?= $btn_primary ?> <?= $btn_success ?>" name="delete_clr" type="submit"> تائید </button>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div style="    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: center;
    justify-content: space-around;
    align-items: center;">
                    <!-- Recently yellow -->
                    <div class="mt-4 m-5">
                        <h4 class="text-warning fw-bold"> رنگ زرد </h4>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <form method="post">
                                    <button class="btn btn-warning text-white" name="warning" type="submit"> تائید </button>
                                </form>
                            </table>
                        </div>
                    </div>

                    <!-- Recently red -->
                    <div class="mt-4 m-5">
                        <h4 class="text-danger fw-bold"> رنگ قرمز </h4>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <form method="post">
                                    <button class="btn btn-danger" name="danger" type="submit"> تائید </button>
                                </form>
                            </table>
                        </div>
                    </div>

                    <!-- Recently blue -->
                    <div class="mt-4 m-5">
                        <h4 class="text-primary fw-bold"> رنگ آبی </h4>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <form method="post">
                                    <button class="btn btn-primary" name="primary" type="submit"> تائید </button>
                                </form>
                            </table>
                        </div>
                    </div>

                    <!-- Recently green -->
                    <div class="mt-4 m-5">
                        <h4 class="text-success fw-bold"> رنگ سبز </h4>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <form method="post">
                                    <button class="btn btn-success" name="success" type="submit"> تائید </button>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php
include "../../include/layout/footer.php";
?>