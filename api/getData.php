<?php
require '../config.php';

$num_rec_per_page = 5;

if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $num_rec_per_page;

$sqlTotal = "SELECT * FROM employees";
$sql = "SELECT * FROM employees Order By id desc LIMIT $start_from, $num_rec_per_page";

$result = $connect->query($sql);
while ($row = $result->fetch_assoc()) {
    $json[] = $row;
}
$data['data'] = $json;

$result =  mysqli_query($connect, $sqlTotal);

$data['total'] = mysqli_num_rows($result);

echo json_encode($data);
