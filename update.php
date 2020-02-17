<?php
include 'components/header.php';
require __DIR__ . '/cities/cities.php';

if (!isset($_GET['id'])) {
    include "components/not_found.php";
    exit;
}
$cityId = $_GET['id'];

$city = getCityById($cityId);
if (!$city) {
    include "components/not_found.php";
    exit;
}

$errors = [
    'name' => "",
    'temperature' => "",
    'humidity' => "",
    'wind' => "",
    'description' => "",
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = array_merge($city, $_POST);

    $isValid = validateCity($city, $errors);

    if ($isValid) {
        $city = updateCity($_POST, $cityId);
        header("Location: index.php");
    }
}

?>

<?php include '_form.php'?>
