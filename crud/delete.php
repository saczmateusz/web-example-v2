<?php
require '../cities/cities.php';

if (!isset($_POST['id'])) {
    echo "<a href='../admin/admin-dashboard.php' class='button view'>Wróć</a><br>";
    die("Błędne ID miasta");
}
$cityId = $_POST['id'];
deleteCity($cityId);

header("Location: ../admin/admin-dashboard.php");
