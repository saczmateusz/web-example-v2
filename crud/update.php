<?php
require '../cities/cities.php';

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
        header("Location: ../admin/admin-dashboard.php");
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
  <title>Pogoda</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
</head>

<body>
  <header>
    <div class="header-title">
      <h1 class="animate-left">Panel administratora</h1>
    </div>
  </header>

  <?php include '_form.php'?>