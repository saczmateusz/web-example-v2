<?php
require '../cities/cities.php';

$city = [
    'id' => '',
    'name' => '',
    'temperature' => '',
    'humidity' => '',
    'wind' => '',
    'description' => '',
    'icon' => '',
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