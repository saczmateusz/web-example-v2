<?php
include 'components/header.php';
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
<div class="container">
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
                <img style="width: 60px" src="<?php echo "http://openweathermap.org/img/wn/" . $city['icon'] . "@2x.png" ?>" alt="pogoda">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
