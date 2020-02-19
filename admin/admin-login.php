<?php
session_start();

$msg = '';

if (isset($_SESSION['admin'])) {
    header('Location: admin-dashboard.php');
    die();
    // die("Administrator jest już zalogowany");
}

if (isset($_POST['submit'])) {
    if ($_POST['login'] == 'admin' && $_POST['password'] == 'admin') {
        $_SESSION['admin'] = true;
        header('Location: admin-dashboard.php');
        die();
    } else {
        $msg = "Złe dane logowania";
    }
}

?>
<html>

<head>
  <title>Admin Login</title>
  <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.css" />
</head>

<body>
  <header>
    <div class="header-title">
      <h1 class="animate-left">Admin Login</h1>
    </div>
    <div class="header-form animate-right">
      <form class="searchbar" id="cityform">
        <input class="form-input" type="text" id="city" placeholder="Wyszukaj miasto" />
        <button class="form-submit button" type="submit">
          DODAJ
        </button>
      </form>
    </div>
  </header>

  <div class="content" id="panels">
    <div class="panel" id="template">
      <form method="POST">
        <div class="login-form">
          <label for="login">Login</label>
          <input type="text" name="login">
          <label for="password">Hasło</label>
          <input type="password" name="password">
          <button name="submit">Zaloguj</button>
          <?php if ($msg): ?>
          <p> <?php echo $msg; ?> </p>
          <?php endif;?>
        </div>
      </form>
    </div>
  </div>

  <footer>
    <p>
      © 2020 Mateusz Sączawa. All rights reserved.
    </p>
    <div class="clear">
      <button class="button red-button" onclick="clearLocalStorage()">
        WYCZYŚĆ
      </button>
    </div>
  </footer>

  <div class="loading">
    <img src="../assets/img/planet.svg" />
  </div>

  <script src="../assets/js/script.js"></script>
</body>

</html>