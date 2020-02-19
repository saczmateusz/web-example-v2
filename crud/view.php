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

?>

<!DOCTYPE html>
<html lang="pl">

<head>
  <title>Pogoda</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
</head>

<body>
  <header>
    <div class="header-title">
      <h1 class="animate-left">Panel administratora</h1>
    </div>
    <div class="header-form animate-right">
      <form class="searchbar" id="cityform" method="POST">
        <button name="logout" class="button red-button">Wyloguj</button>
      </form>
    </div>
  </header>

  <div class="content container">
    <div class="card">
      <div class="card-header">
        <h3>Zobacz miasto: <b><?php echo $city['name'] ?></b></h3>
      </div>
      <div class="card-body">
        <a class="btn btn-secondary" href="update.php?id=<?php echo $city['id'] ?>">Edytuj</a>
        <form style="display: inline-block" method="POST" action="delete.php">
          <input type="hidden" name="id" value="<?php echo $city['id'] ?>">
          <button class="btn btn-danger">Usuń</button>
        </form>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <th>Nazwa:</th>
            <td><?php echo $city['name'] ?></td>
          </tr>
          <tr>
            <th>Temperatura:</th>
            <td><?php echo $city['temperature'] ?></td>
          </tr>
          <tr>
            <th>Wilgotność:</th>
            <td><?php echo $city['humidity'] ?></td>
          </tr>
          <tr>
            <th>Wiatr:</th>
            <td><?php echo $city['wind'] ?></td>
          </tr>
          <tr>
            <th>Opis:</th>
            <td><?php echo $city['description'] ?></td>
          </tr>
          <tr>
            <th>Ikona:</th>
            <td>
              <img style="width: 60px"
                src="<?php echo "http://openweathermap.org/img/wn/" . $city['icon'] . "@2x.png" ?>" alt="pogoda">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <footer>
    <p>
      © 2020 Mateusz Sączawa. All rights reserved.
    </p>
  </footer>

</body>

</html>