<?php
include "../../include/config.php";
include "../../include/db.php";

if (!isset($_SESSION["email"])) {
    header("location:" . URL . "");

}

if (isset($_POST["ex_comments"])) {

    $conn = new mysqli('localhost', 'root', '', 'php_course_blog');
    $conn->set_charset("utf8");

    $setSql = "SELECT id,name,comment,status,time FROM comments";
    $setRec = mysqli_query($conn, $setSql);

    $columnHeader = '';
    $columnHeader = " id " . "\t" . " نام " . "\t" . " متن کامنت " . "\t" . " وضعیت " . "\t" . " 0 = نشده " . "\t" . " 1 = شده " . "\t" . " تاریخ " . "\t";

    $setData = '';

    while ($rec = mysqli_fetch_row($setRec)) {
        $rowData = '';
        foreach ($rec as $value) {
            $value = '"' . $value . '"' . "\t";
            $rowData .= $value;
        }
        $setData .= trim($rowData) . "\n";
    }


    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=comments.xls");
    header('Content-Transfer-Encoding: binary');
    header("Pragma: no-cache");
    header("Expires: 0");
    echo chr(255) . chr(254) . iconv("UTF-8", "UTF-16LE//IGNORE", $columnHeader . "\n" . $setData . "\n");

    exit();
}
die;
