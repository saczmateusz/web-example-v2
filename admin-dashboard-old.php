<?php
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
<html>
<head>
  <title>Dashboard</title>
</head>
<body>
  Niezły daszbord byku
  <form method="POST">
    <button name="logout">Wyloguj</button>
  </form>
</body>
</html>
