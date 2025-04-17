<?php
$conn = mysqli_connect("localhost", "root", "", "php_course_blog");

$query = "SELECT id,fname,lname,username,email,password,time FROM registers";
$result = mysqli_query($conn, $query);

$num_column = mysqli_num_fields($result);

$csv_header = '';
for ($i = 0; $i < $num_column; $i++) {
    $csv_header .= '"' . mysqli_fetch_field_direct($result, $i)->name . '",';
}
$csv_header .= "\n";

$csv_row = '';
while ($row = mysqli_fetch_row($result)) {
    for ($i = 0; $i < $num_column; $i++) {
        $csv_row .= '"' . $row[$i] . '",';
    }
    $csv_row .= "\n";
}

/* Download as CSV File */
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=registers.csv');
echo $csv_header . $csv_row;
exit;
