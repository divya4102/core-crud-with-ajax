<?php

require '../config.php';

$id = $_POST['id'];
$query = "DELETE FROM employees WHERE id=$id";
$result = mysqli_query($connect, $query);

echo json_encode([$id]);