<?php
require '../cities/cities.php';

$cities = getCities();

include '../crud/components/header.php';

session_start();

if (!isset($_SESSION['admin'])) {
    die("<h1>Brak uprawnień</h1>");
}

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: admin-login.php');
    die();
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
    <p>
      <a class="btn btn-success" href="../crud/create.php">Dodaj nowe miasto</a>
    </p>

    <table class="table">
      <thead>
        <tr>
          <th>Nazwa</th>
          <th>Temperatura</th>
          <th>Wilgotność</th>
          <th>Wiatr</th>
          <th>Opis</th>
          <th>Ikona</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cities as $city): ?>
        <tr>
          <td><?php echo $city['name'] ?></td>
          <td><?php echo $city['temperature'] ?>°C</td>
          <td><?php echo $city['humidity'] ?>%</td>
          <td><?php echo $city['wind'] ?> m/s</td>
          <td><?php echo $city['description'] ?></td>
          <td>
            <img style="width: 60px" src="<?php echo "http://openweathermap.org/img/wn/" . $city['icon'] . "@2x.png" ?>"
              alt="pogoda">
          </td>
          <td>
            <a href="../crud/view.php?id=<?php echo $city['id'] ?>" class="btn btn-sm btn-outline-info">Zobacz</a>
            <a href="../crud/update.php?id=<?php echo $city['id'] ?>"
              class="btn btn-sm btn-outline-secondary">Edytuj</a>
            <form method="POST" action="../crud/delete.php">
              <input type="hidden" name="id" value="<?php echo $city['id'] ?>">
              <button class="btn btn-sm btn-outline-danger">Usuń</button>
            </form>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>

  <footer>
    <p>
      © 2020 Mateusz Sączawa. All rights reserved.
    </p>
  </footer>

</body>

</html>