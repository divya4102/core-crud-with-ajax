<?php
require '../config.php';
extract($_POST);

$query = "INSERT INTO employees (firstname, lastname, email) values('" . $firstname . "', '" . $lastname . "', '" . $email . "')";

$result = $connect->query($query);

$sql = "SELECT * FROM employees Order by id desc LIMIT 1";

$result = $connect->query($sql);

$data = $result->fetch_assoc();

echo json_encode($data);
