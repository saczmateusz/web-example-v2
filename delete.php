<?php
include 'components/header.php';
require __DIR__ . '/cities/cities.php';

if (!isset($_POST['id'])) {
    include "components/not_found.php";
    exit;
}
$cityId = $_POST['id'];
deleteCity($cityId);

header("Location: index.php");
