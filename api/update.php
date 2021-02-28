<?php
require '../config.php';

extract($_POST);
$query = "UPDATE employees SET firstname = '" . $firstname . "', lastname = '" . $lastname . "', email = '" . $email . "' WHERE id = " . $id;

$result = mysqli_query($connect, $query);

$sql = "SELECT * FROM employees WHERE id = '" . $id . "'";

$result = $connect->query($sql);

$data = $result->fetch_assoc();

echo json_encode($data);
