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

<div class="container">
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
                    <img style="width: 60px" src="<?php echo "http://openweathermap.org/img/wn/" . $city['icon'] . "@2x.png" ?>" alt="pogoda">
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
<form method="POST">
    <button name="logout">Wyloguj</button>
  </form>
</body>
</html>