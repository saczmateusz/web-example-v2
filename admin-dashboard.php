<?php
session_start();

if (!isset($_SESSION['admin'])) {
    die("You don't have permission to access this.");
}

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: admin-login.php');
    die();
    // die("Wylogowano");

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
