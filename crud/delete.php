<?php
include 'components/header.php';
require '../cities/cities.php';

if (!isset($_POST['id'])) {
    include "components/not_found.php";
    exit;
}
$cityId = $_POST['id'];
deleteCity($cityId);

header("Location: ../admin/admin-dashboard.php");
