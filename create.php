<?php
include 'components/header.php';
require __DIR__ . '/cities/cities.php';

$city = [
    'id' => '',
    'name' => '',
    'temperature' => '',
    'humidity' => '',
    'wind' => '',
    'description' => '',
];

$errors = [
    'name' => '',
    'temperature' => '',
    'humidity' => '',
    'wind' => '',
    'description' => '',
];
$isValid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = array_merge($city, $_POST);

    $isValid = validateCity($city, $errors);

    if ($isValid) {
        $city = createCity($_POST);

        header("Location: index.php");
    }
}

?>

<?php include '_form.php'?>

